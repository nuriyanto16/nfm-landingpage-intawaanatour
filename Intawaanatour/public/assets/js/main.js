(function () {
  'use strict';

  // Sticky header
  var header = document.querySelector('.site-header');
  function onScroll() {
    if (!header) return;
    header.classList.toggle('scrolled', window.scrollY > 40);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Mobile nav toggle
  var toggle = document.querySelector('.nav-toggle');
  var menu = document.querySelector('.nav-menu');
  if (toggle && menu) {
    toggle.addEventListener('click', function () {
      menu.classList.toggle('open');
      toggle.classList.toggle('open');
    });
    menu.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        menu.classList.remove('open');
        toggle.classList.remove('open');
      });
    });
  }

  // Reveal on scroll — exposed so konten async bisa ikut diobservasi
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) {
        e.target.classList.add('in');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  // Mode capture: ?cap=1 menampilkan semua elemen reveal seketika (untuk screenshot)
  var CAP = window.location.search.indexOf('cap=1') > -1;
  function observeReveal(scope) {
    (scope || document).querySelectorAll('.reveal').forEach(function (el) {
      if (el.classList.contains('in')) return;
      if (CAP) { el.classList.add('in'); } else { io.observe(el); }
    });
  }
  observeReveal(document);

  // Trip filter pills
  var pills = document.querySelectorAll('[data-filter]');
  var items = document.querySelectorAll('[data-type]');
  pills.forEach(function (p) {
    p.addEventListener('click', function () {
      pills.forEach(function (x) { x.classList.remove('active'); });
      p.classList.add('active');
      var f = p.getAttribute('data-filter');
      items.forEach(function (it) {
        it.style.display = (f === 'all' || it.getAttribute('data-type') === f) ? '' : 'none';
      });
    });
  });

  // Lightbox via event delegation (otomatis berlaku untuk konten async)
  var lb = document.createElement('div');
  lb.style.cssText = 'position:fixed;inset:0;background:rgba(11,42,58,.92);display:none;align-items:center;justify-content:center;z-index:200;padding:24px;cursor:zoom-out';
  lb.innerHTML = '<img style="max-width:92%;max-height:92%;border-radius:12px;box-shadow:0 30px 80px rgba(0,0,0,.5)">';
  document.body.appendChild(lb);
  var lbImg = lb.querySelector('img');
  document.addEventListener('click', function (ev) {
    var a = ev.target.closest ? ev.target.closest('[data-lightbox]') : null;
    if (!a) return;
    ev.preventDefault();
    lbImg.src = a.getAttribute('href');
    lb.style.display = 'flex';
  });
  lb.addEventListener('click', function () { lb.style.display = 'none'; });

  // ------------------------------------------------------------------
  // Pemuatan bagian halaman secara asinkron (skeleton -> konten)
  // ------------------------------------------------------------------
  function loadAsyncSection(box) {
    var url = box.getAttribute('data-async');
    box.classList.add('is-loading');

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(function (res) {
        if (!res.ok) throw new Error('HTTP ' + res.status);
        return res.text();
      })
      .then(function (html) {
        var trimmed = html.trim();

        // Tidak ada data: sembunyikan bagian bila diminta.
        if (trimmed === '') {
          if (box.hasAttribute('data-hide-empty')) {
            var section = box.closest('[data-async-section]') || box.closest('section');
            if (section) section.remove(); else box.remove();
          } else {
            box.classList.remove('is-loading');
          }
          return;
        }

        box.innerHTML = trimmed;
        box.classList.remove('is-loading');
        box.classList.add('is-loaded');
        observeReveal(box);
      })
      .catch(function () {
        box.classList.remove('is-loading');
        box.classList.add('is-error');
        box.innerHTML = '<p class="muted" style="grid-column:1/-1;text-align:center">' +
          'Gagal memuat konten. <a href="#" data-async-retry>Coba lagi</a></p>';
      });
  }

  document.querySelectorAll('[data-async]').forEach(loadAsyncSection);

  // ------------------------------------------------------------------
  // Reels video: klik untuk memutar (dengan suara), jeda yang lain
  // ------------------------------------------------------------------
  var reels = document.querySelectorAll('.reel');
  reels.forEach(function (reel) {
    reel.addEventListener('click', function () {
      var v = reel.querySelector('video');
      if (!v) return;
      if (reel.classList.contains('playing')) return;
      // hentikan reel lain
      reels.forEach(function (other) {
        if (other !== reel) {
          other.classList.remove('playing');
          var ov = other.querySelector('video');
          if (ov) { ov.pause(); ov.removeAttribute('controls'); }
        }
      });
      reel.classList.add('playing');
      v.muted = false;
      v.setAttribute('controls', '');
      v.play();
    });
  });

  // Tombol "Coba lagi" pada bagian yang gagal dimuat
  document.addEventListener('click', function (ev) {
    var retry = ev.target.closest ? ev.target.closest('[data-async-retry]') : null;
    if (!retry) return;
    ev.preventDefault();
    var box = retry.closest('[data-async]');
    if (box) loadAsyncSection(box);
  });
})();

/* ===== Hero slider (slide 1 = video, sisanya gambar) ===== */
(function () {
  var slider = document.querySelector('.hero__slider');
  if (!slider) return;
  var slides = Array.prototype.slice.call(slider.querySelectorAll('.hero__slide'));
  if (slides.length < 2) return;
  var dotsWrap = document.querySelector('.hero__dots');
  var i = 0, timer = null;
  var dots = slides.map(function (_, idx) {
    if (!dotsWrap) return null;
    var b = document.createElement('button');
    b.type = 'button';
    b.setAttribute('aria-label', 'Slide ' + (idx + 1));
    if (idx === 0) b.className = 'is-active';
    b.addEventListener('click', function () { go(idx); });
    dotsWrap.appendChild(b);
    return b;
  });
  function syncVideo() {
    slides.forEach(function (s) {
      var v = s.querySelector('video');
      if (!v) return;
      if (s.classList.contains('is-active')) { var p = v.play(); if (p && p.catch) p.catch(function(){}); }
      else { v.pause(); }
    });
  }
  function go(n) {
    slides[i].classList.remove('is-active');
    if (dots[i]) dots[i].classList.remove('is-active');
    i = (n + slides.length) % slides.length;
    slides[i].classList.add('is-active');
    if (dots[i]) dots[i].classList.add('is-active');
    syncVideo();
    schedule();
  }
  function schedule() {
    clearTimeout(timer);
    var hasVideo = !!slides[i].querySelector('video');
    timer = setTimeout(function () { go(i + 1); }, hasVideo ? 9000 : 6000);
  }
  if (!window.matchMedia || !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    syncVideo();
    schedule();
  }
})();
