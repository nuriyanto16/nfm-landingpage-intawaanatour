(function () {
  'use strict';

  // ------------------------------------------------------------------
  // Sidebar mobile: toggle + scrim
  // ------------------------------------------------------------------
  var body = document.body;
  function openNav() { body.classList.add('nav-open'); }
  function closeNav() { body.classList.remove('nav-open'); }

  document.addEventListener('click', function (ev) {
    if (ev.target.closest('[data-nav-toggle]')) { ev.preventDefault(); body.classList.toggle('nav-open'); }
    else if (ev.target.closest('[data-nav-close]')) { closeNav(); }
  });
  document.addEventListener('keydown', function (ev) {
    if (ev.key === 'Escape') closeNav();
  });

  // ------------------------------------------------------------------
  // Skeleton saat memuat data: ketika berpindah halaman admin,
  // tampilkan kerangka shimmer di area konten selama request berjalan
  // sehingga halaman tidak terasa "membeku" menunggu query DB.
  // ------------------------------------------------------------------
  var content = document.getElementById('adminContent');

  function bar(w, h) {
    return '<span class="sk sk-line" style="width:' + w + ';height:' + (h || 12) + 'px"></span>';
  }

  function skeletonTable(rows) {
    var head = '<div class="card"><div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">' +
      bar('180px', 18) + '<span class="sk" style="width:120px;height:34px"></span></div>';
    var body = '';
    for (var i = 0; i < (rows || 6); i++) {
      body += '<div style="display:flex;align-items:center;gap:16px;padding:12px 0;border-bottom:1px solid #eef1f6">' +
        '<span class="sk" style="width:56px;height:42px"></span>' +
        '<div style="flex:1">' + bar('45%', 13) + bar('25%', 10) + '</div>' +
        '<span class="sk" style="width:70px;height:22px;border-radius:999px"></span>' +
        '<span class="sk" style="width:90px;height:30px"></span>' +
      '</div>';
    }
    return head + body + '</div>';
  }

  function skeletonStats() {
    var cells = '';
    for (var i = 0; i < 5; i++) {
      cells += '<div class="stat"><span class="sk" style="width:38px;height:38px;border-radius:10px;margin-bottom:12px"></span>' +
        bar('50%', 26) + bar('70%', 12) + '</div>';
    }
    return '<div class="grid stats" style="margin-bottom:26px">' + cells + '</div>';
  }

  function renderSkeleton(kind) {
    if (!content) return;
    var head = '<div class="page-head">' + bar('200px', 24) + '<span class="sk" style="width:130px;height:38px"></span></div>';
    var pane = '<div class="skeleton-pane">' + head +
      (kind === 'dashboard' ? skeletonStats() + skeletonTable(5) : skeletonTable(7)) +
      '</div>';
    content.innerHTML = pane;
  }

  // Tentukan apakah sebuah link memicu navigasi data yang layak diberi skeleton.
  function isDataLink(a) {
    if (!a) return false;
    if (a.hasAttribute('data-no-skeleton')) return false;
    if (a.target && a.target === '_blank') return false;
    if (a.hasAttribute('download')) return false;
    if (a.hasAttribute('onclick')) return false; // mis. konfirmasi hapus
    var href = a.getAttribute('href') || '';
    if (!href || href.charAt(0) === '#' || href.indexOf('javascript:') === 0) return false;
    // hanya tautan ke area /admin pada origin yang sama
    var url;
    try { url = new URL(a.href, window.location.href); } catch (e) { return false; }
    if (url.origin !== window.location.origin) return false;
    if (url.pathname.indexOf('/admin') === -1) return false;
    if (url.pathname.indexOf('/admin/logout') !== -1) return false;
    if (url.href === window.location.href) return false; // halaman yang sama
    return true;
  }

  document.addEventListener('click', function (ev) {
    if (ev.defaultPrevented || ev.button !== 0 || ev.metaKey || ev.ctrlKey || ev.shiftKey || ev.altKey) return;
    var a = ev.target.closest('a[href]');
    if (!isDataLink(a)) return;
    closeNav();
    var kind = a.href.replace(/[#?].*$/, '').replace(/\/+$/, '');
    kind = /\/admin$/.test(kind) ? 'dashboard' : 'list';
    // beri jeda satu frame agar browser sempat memproses navigasi
    requestAnimationFrame(function () { renderSkeleton(kind); });
  });

  // Jika pengguna kembali via tombol "back", konten cache dipulihkan,
  // jadi tidak perlu menampilkan skeleton lagi.
  window.addEventListener('pageshow', function (e) { if (e.persisted) closeNav(); });
})();
