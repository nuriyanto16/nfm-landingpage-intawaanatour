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

/* ===== Carousel crossfade generik (hero + galeri speedboat) ===== */
(function () {
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function buildCarousel(cfg) {
    var slides = cfg.slides, i = 0, timer = null, dots = [];

    if (cfg.dotsWrap) {
      slides.forEach(function (_, idx) {
        var b = document.createElement('button');
        b.type = 'button';
        b.setAttribute('aria-label', 'Slide ' + (idx + 1));
        if (idx === 0) b.className = 'is-active';
        b.addEventListener('click', function () { go(idx); });
        cfg.dotsWrap.appendChild(b);
        dots.push(b);
      });
    }

    function schedule() {
      if (reduce) return;
      clearTimeout(timer);
      var ms = cfg.intervalFor ? cfg.intervalFor(i) : cfg.interval;
      timer = setTimeout(function () { go(i + 1); }, ms);
    }
    function go(n) {
      slides[i].classList.remove('is-active');
      if (dots[i]) dots[i].classList.remove('is-active');
      i = (n + slides.length) % slides.length;
      slides[i].classList.add('is-active');
      if (dots[i]) dots[i].classList.add('is-active');
      if (cfg.onChange) cfg.onChange(i);
      schedule();
    }

    if (cfg.prevBtn) cfg.prevBtn.addEventListener('click', function () { go(i - 1); });
    if (cfg.nextBtn) cfg.nextBtn.addEventListener('click', function () { go(i + 1); });

    // Geser (swipe) sentuh kiri/kanan
    var area = cfg.swipeArea || cfg.root, x0 = null, y0 = null;
    if (area) {
      area.addEventListener('touchstart', function (e) {
        x0 = e.touches[0].clientX; y0 = e.touches[0].clientY;
      }, { passive: true });
      area.addEventListener('touchend', function (e) {
        if (x0 === null) return;
        var dx = e.changedTouches[0].clientX - x0;
        var dy = e.changedTouches[0].clientY - y0;
        if (Math.abs(dx) > 45 && Math.abs(dx) > Math.abs(dy)) go(i + (dx < 0 ? 1 : -1));
        x0 = y0 = null;
      }, { passive: true });
    }

    if (cfg.onChange) cfg.onChange(0);
    schedule();
  }

  // --- Hero (slide 1 = video) ---
  var heroSlider = document.querySelector('.hero__slider');
  if (heroSlider) {
    var hSlides = Array.prototype.slice.call(heroSlider.querySelectorAll('.hero__slide'));
    if (hSlides.length >= 2) {
      buildCarousel({
        root: heroSlider,
        slides: hSlides,
        dotsWrap: document.querySelector('.hero__dots'),
        prevBtn: document.querySelector('.hero__arrow--prev'),
        nextBtn: document.querySelector('.hero__arrow--next'),
        swipeArea: document.querySelector('.hero'),
        interval: 6000,
        intervalFor: function (idx) { return hSlides[idx].querySelector('video') ? 9000 : 6000; },
        onChange: function (idx) {
          hSlides.forEach(function (s, k) {
            var v = s.querySelector('video');
            if (!v) return;
            if (k === idx) { var p = v.play(); if (p && p.catch) p.catch(function () {}); }
            else { v.pause(); }
          });
        }
      });
    }
  }

  // --- Galeri foto speedboat & slider lain ---
  document.querySelectorAll('[data-carousel]').forEach(function (root) {
    var slides = Array.prototype.slice.call(root.querySelectorAll('.boat-slider__slide'));
    if (slides.length < 2) return;
    buildCarousel({
      root: root,
      slides: slides,
      dotsWrap: root.querySelector('[data-carousel-dots]'),
      prevBtn: root.querySelector('[data-carousel-prev]'),
      nextBtn: root.querySelector('[data-carousel-next]'),
      swipeArea: root,
      interval: parseInt(root.getAttribute('data-interval'), 10) || 5000
    });
  });
})();
