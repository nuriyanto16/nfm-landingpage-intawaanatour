<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title><?= esc($title ?? 'Admin') ?> &middot; Inta Waana Tour</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
  <link rel="icon" href="<?= base_url('assets/img/favicon-32.png') ?>" type="image/png">
  <style>
    :root{
      --bg:#0b1220;--bg2:#16213a;--bg3:#1e2a47;--card:#fff;--line:#e6eaf0;--line2:#eef1f6;
      --txt:#16233b;--muted:#64748b;--brand:#0ea5a4;--brand-d:#0c8a89;--brand-l:#e7faf9;
      --danger:#dc2626;--ok:#16a34a;--warn:#d97706;--shadow:0 1px 2px rgba(16,24,40,.06),0 1px 3px rgba(16,24,40,.08);
      --radius:14px;
    }
    *{box-sizing:border-box}
    html{-webkit-text-size-adjust:100%}
    body{margin:0;font-family:'Inter',system-ui,-apple-system,sans-serif;background:#f4f6fb;color:var(--txt);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
    a{color:inherit;text-decoration:none}
    svg.ic{width:18px;height:18px;flex:0 0 18px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .layout{display:flex;min-height:100vh}

    /* ---------- Sidebar ---------- */
    .sidebar{width:248px;background:linear-gradient(185deg,#0b1220,#111c33);color:#aab6c8;display:flex;flex-direction:column;
      position:fixed;inset:0 auto 0 0;height:100vh;z-index:40;transition:transform .25s ease}
    .sidebar .brand{display:flex;align-items:center;gap:10px;padding:20px 22px;font-size:18px;font-weight:800;color:#fff;letter-spacing:-.01em}
    .sidebar .brand .logo{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,var(--brand),#22d3d1);display:grid;place-items:center;color:#04201f;font-weight:800;font-size:16px}
    .sidebar .brand span{color:var(--brand)}
    .sidebar nav{padding:10px 12px;flex:1;overflow-y:auto}
    .sidebar nav .grp{padding:16px 12px 7px;font-size:10.5px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:#5b6b85}
    .sidebar nav a{display:flex;align-items:center;gap:11px;padding:10px 12px;color:#aeb9cb;font-weight:500;border-radius:10px;margin-bottom:2px;transition:background .15s,color .15s}
    .sidebar nav a:hover{background:rgba(255,255,255,.06);color:#fff}
    .sidebar nav a.active{background:linear-gradient(90deg,rgba(14,165,164,.22),rgba(14,165,164,.05));color:#fff;box-shadow:inset 2px 0 0 var(--brand)}
    .sidebar nav a.active svg.ic{stroke:var(--brand)}
    .sidebar nav a .badge{margin-left:auto;background:var(--brand);color:#042a29;border-radius:999px;padding:1px 8px;font-size:11px;font-weight:800}
    .sidebar .foot{padding:14px 22px;border-top:1px solid rgba(255,255,255,.07);font-size:12px;color:#5b6b85}
    .scrim{display:none;position:fixed;inset:0;background:rgba(8,14,26,.55);z-index:35;backdrop-filter:blur(1px)}

    /* ---------- Main ---------- */
    .main{margin-left:248px;flex:1;display:flex;flex-direction:column;min-width:0}
    .topbar{background:rgba(255,255,255,.85);backdrop-filter:saturate(180%) blur(8px);border-bottom:1px solid var(--line);
      padding:13px 28px;display:flex;align-items:center;gap:14px;position:sticky;top:0;z-index:20}
    .topbar h1{margin:0;font-size:17px;font-weight:700;letter-spacing:-.01em}
    .topbar .crumb{font-size:12px;color:var(--muted);margin-top:1px}
    .topbar .user{margin-left:auto;display:flex;align-items:center;gap:12px;color:var(--muted)}
    .topbar .user .av{width:34px;height:34px;border-radius:50%;background:var(--brand-l);color:var(--brand-d);display:grid;place-items:center;font-weight:800;font-size:14px}
    .topbar .user .nm{font-size:13px}
    .topbar .user .nm strong{color:var(--txt);display:block;font-size:13px;line-height:1.2}
    .logout{display:inline-flex;align-items:center;gap:6px;color:var(--danger);font-weight:600;padding:7px 12px;border:1px solid #fecaca;border-radius:9px}
    .logout:hover{background:#fef2f2}
    .menu-btn{display:none;background:#fff;border:1px solid var(--line);border-radius:9px;padding:8px;cursor:pointer;color:var(--txt)}
    .content{padding:26px 28px 40px;flex:1;max-width:1200px;width:100%}

    /* ---------- Components ---------- */
    .alert{display:flex;gap:10px;padding:13px 16px;border-radius:11px;margin-bottom:20px;font-weight:500;border:1px solid transparent}
    .alert svg.ic{margin-top:1px}
    .alert-success{background:#ecfdf5;color:#166534;border-color:#bbf7d0}
    .alert-error{background:#fef2f2;color:#991b1b;border-color:#fecaca}
    .alert ul{margin:6px 0 0;padding-left:18px}
    .card{background:var(--card);border:1px solid var(--line);border-radius:var(--radius);padding:22px;margin-bottom:22px;box-shadow:var(--shadow)}
    .card>h2{margin:0 0 16px;font-size:15px;font-weight:700}
    .grid{display:grid;gap:16px}
    .stats{grid-template-columns:repeat(auto-fit,minmax(176px,1fr))}
    .stat{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:18px 20px;box-shadow:var(--shadow);position:relative;overflow:hidden}
    .stat .ico{width:38px;height:38px;border-radius:10px;display:grid;place-items:center;background:var(--brand-l);color:var(--brand-d);margin-bottom:12px}
    .stat .num{font-size:28px;font-weight:800;letter-spacing:-.02em;line-height:1}
    .stat .lbl{color:var(--muted);margin-top:5px;font-size:13px}
    .stat.brand{background:linear-gradient(135deg,var(--brand),#13bdbb);color:#fff;border-color:transparent}
    .stat.brand .ico{background:rgba(255,255,255,.2);color:#fff}
    .stat.brand .lbl{color:#d1fae5}
    table{width:100%;border-collapse:collapse}
    th,td{text-align:left;padding:12px 14px;border-bottom:1px solid var(--line2);vertical-align:middle}
    thead th{font-size:11px;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);background:#fafbfd}
    tbody tr{transition:background .12s}
    tbody tr:hover{background:#f8fafc}
    tbody tr:last-child td{border-bottom:0}
    .thumb{width:56px;height:42px;object-fit:cover;border-radius:8px;background:#e9edf3}
    .table-wrap{overflow-x:auto;margin:0 -22px -22px;padding:0 0 0}
    .table-wrap table{min-width:560px}
    .table-wrap th:first-child,.table-wrap td:first-child{padding-left:22px}
    .table-wrap th:last-child,.table-wrap td:last-child{padding-right:22px}
    .btn{display:inline-flex;align-items:center;gap:6px;padding:9px 15px;border-radius:9px;border:1px solid var(--line);background:#fff;font-weight:600;cursor:pointer;font-size:13px;transition:background .12s,border-color .12s,box-shadow .12s;color:var(--txt)}
    .btn:hover{background:#f8fafc;border-color:#d6dce5}
    .btn-primary{background:var(--brand);border-color:var(--brand);color:#fff;box-shadow:0 1px 2px rgba(14,165,164,.4)}
    .btn-primary:hover{background:var(--brand-d);border-color:var(--brand-d)}
    .btn-danger{color:var(--danger);border-color:#fecaca}
    .btn-danger:hover{background:#fef2f2;border-color:#fca5a5}
    .btn-sm{padding:6px 11px;font-size:12px}
    .actions{display:flex;gap:6px;flex-wrap:wrap}
    .page-head{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-bottom:22px;flex-wrap:wrap}
    .page-head h2{margin:0;font-size:21px;font-weight:800;letter-spacing:-.02em}
    .page-head .sub{color:var(--muted);font-size:13px;margin-top:2px}
    label{display:block;font-weight:600;margin-bottom:6px}
    .field{margin-bottom:18px}
    .hint{color:var(--muted);font-weight:400;font-size:12px}
    input[type=text],input[type=email],input[type=password],input[type=number],input[type=date],input[type=url],input[type=file],select,textarea{
      width:100%;padding:10px 12px;border:1px solid var(--line);border-radius:9px;font:inherit;background:#fff;transition:border-color .12s,box-shadow .12s}
    input:focus,select:focus,textarea:focus{outline:none;border-color:var(--brand);box-shadow:0 0 0 3px rgba(14,165,164,.15)}
    textarea{min-height:90px;resize:vertical}
    .form-row{display:grid;grid-template-columns:1fr 1fr;gap:18px}
    .check{display:flex;align-items:center;gap:8px;font-weight:500}
    .check input{width:auto}
    .badge-st{display:inline-block;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:600;text-transform:capitalize}
    .st-new{background:#dbeafe;color:#1e40af}
    .st-confirmed{background:#dcfce7;color:#166534}
    .st-cancelled{background:#fee2e2;color:#991b1b}
    .st-done{background:#e2e8f0;color:#334155}
    .empty{text-align:center;padding:46px 20px;color:var(--muted)}
    .empty svg.ic{width:34px;height:34px;stroke-width:1.4;opacity:.5;margin-bottom:10px}
    .img-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:14px}
    .img-grid figure{margin:0;position:relative;border:1px solid var(--line);border-radius:11px;overflow:hidden;background:#fff}
    .img-grid img{width:100%;height:118px;object-fit:cover;display:block}
    .img-grid .del{position:absolute;top:6px;right:6px;background:rgba(220,38,38,.92);color:#fff;border-radius:7px;padding:3px 9px;font-size:12px;font-weight:600}

    /* ---------- Skeleton (pemuatan data) ---------- */
    @keyframes sk-shimmer{0%{background-position:-468px 0}100%{background-position:468px 0}}
    .sk{background:#eef1f6;background-image:linear-gradient(90deg,#eef1f6 0,#f7f9fc 40px,#eef1f6 80px);background-size:600px 100%;
      animation:sk-shimmer 1.2s linear infinite;border-radius:7px;display:block}
    .sk-line{height:12px;margin:8px 0}
    .skeleton-pane{animation:fade .2s ease}
    @keyframes fade{from{opacity:0}to{opacity:1}}
    @media (prefers-reduced-motion:reduce){.sk{animation:none}}

    /* ---------- Responsive ---------- */
    @media(max-width:980px){
      .sidebar{transform:translateX(-100%)}
      body.nav-open .sidebar{transform:none;box-shadow:0 0 60px rgba(0,0,0,.5)}
      body.nav-open .scrim{display:block}
      .main{margin-left:0}
      .menu-btn{display:inline-flex}
      .content{padding:20px 16px 36px}
      .topbar{padding:11px 16px}
      .form-row{grid-template-columns:1fr}
      .topbar .user .nm{display:none}
    }
  </style>
</head>
<body>
<div class="layout">
  <div class="scrim" data-nav-close></div>
  <aside class="sidebar">
    <div class="brand"><span class="logo">I</span>Intawaana<span>tour</span></div>
    <nav>
      <?php
        $uri  = service('uri');
        $seg2 = $uri->getSegment(2);
        $on   = static fn(string $s) => $seg2 === $s ? 'active' : '';
      ?>
      <div class="grp">Utama</div>
      <a class="<?= $seg2 === '' ? 'active' : '' ?>" href="<?= site_url('admin') ?>">
        <svg class="ic" viewBox="0 0 24 24"><path d="M3 12 12 3l9 9"/><path d="M5 10v10h14V10"/></svg> Dashboard</a>

      <div class="grp">Konten</div>
      <a class="<?= $on('trips') ?>" href="<?= site_url('admin/trips') ?>">
        <svg class="ic" viewBox="0 0 24 24"><path d="M3 18 21 6"/><path d="M3 14h4l2 4"/><path d="M21 6v6"/><circle cx="6" cy="18" r="1.6"/></svg> Paket Trip</a>
      <a class="<?= $on('gallery') ?>" href="<?= site_url('admin/gallery') ?>">
        <svg class="ic" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2.5"/><circle cx="9" cy="9" r="2"/><path d="m21 16-5-5L5 21"/></svg> Galeri</a>
      <a class="<?= $on('articles') ?>" href="<?= site_url('admin/articles') ?>">
        <svg class="ic" viewBox="0 0 24 24"><path d="M5 3h11l3 3v15H5z"/><path d="M9 8h6M9 12h6M9 16h4"/></svg> Artikel</a>

      <div class="grp">Aktivitas</div>
      <a class="<?= $on('bookings') ?>" href="<?= site_url('admin/bookings') ?>">
        <svg class="ic" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="17" rx="2.5"/><path d="M3 9h18M8 2v4M16 2v4"/></svg> Pemesanan
        <?php $nb = (new \App\Models\BookingModel())->countNew(); ?>
        <?php if ($nb > 0): ?><span class="badge"><?= $nb ?></span><?php endif; ?>
      </a>

      <div class="grp">Sistem</div>
      <a class="<?= $on('settings') ?>" href="<?= site_url('admin/settings') ?>">
        <svg class="ic" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.6 1.6 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.6 1.6 0 0 0-2.7 1.1V21a2 2 0 1 1-4 0v-.1A1.6 1.6 0 0 0 7 19.4a1.6 1.6 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1A1.6 1.6 0 0 0 2.6 14H2a2 2 0 1 1 0-4h.1A1.6 1.6 0 0 0 4 7.6l-.4-.4a2 2 0 1 1 2.8-2.8l.1.1A1.6 1.6 0 0 0 9 4.6V4a2 2 0 1 1 4 0v.1A1.6 1.6 0 0 0 17 5.4l-.1-.1a2 2 0 1 1 2.8 2.8"/></svg> Pengaturan</a>
      <a class="<?= $on('account') ?>" href="<?= site_url('admin/account') ?>">
        <svg class="ic" viewBox="0 0 24 24"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg> Ubah Password</a>
      <a href="<?= site_url('/') ?>" target="_blank" rel="noopener" data-no-skeleton>
        <svg class="ic" viewBox="0 0 24 24"><path d="M14 4h6v6"/><path d="M10 14 20 4"/><path d="M20 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h5"/></svg> Lihat Situs</a>
    </nav>
    <div class="foot">&copy; <?= date('Y') ?> Inta Waana Tour</div>
  </aside>

  <div class="main">
    <header class="topbar">
      <button class="menu-btn" type="button" data-nav-toggle aria-label="Menu">
        <svg class="ic" viewBox="0 0 24 24"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
      </button>
      <div>
        <h1><?= esc($title ?? 'Dashboard') ?></h1>
        <div class="crumb">Panel Admin &rsaquo; <?= esc($title ?? 'Dashboard') ?></div>
      </div>
      <div class="user">
        <div class="nm">Halo,<strong><?= esc(session('admin_name') ?? 'Admin') ?></strong></div>
        <div class="av"><?= esc(strtoupper(substr(session('admin_name') ?? 'A', 0, 1))) ?></div>
        <a class="logout" href="<?= site_url('admin/logout') ?>" data-no-skeleton>
          <svg class="ic" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5M21 12H9"/></svg>
          Logout
        </a>
      </div>
    </header>

    <main class="content" id="adminContent">
      <?php if (session('success')): ?>
        <div class="alert alert-success">
          <svg class="ic" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
          <div><?= esc(session('success')) ?></div>
        </div>
      <?php endif; ?>
      <?php if (session('error')): ?>
        <div class="alert alert-error">
          <svg class="ic" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16h.01"/></svg>
          <div><?= esc(session('error')) ?></div>
        </div>
      <?php endif; ?>
      <?php if (session('errors')): ?>
        <div class="alert alert-error">
          <svg class="ic" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16h.01"/></svg>
          <div>Periksa kembali isian berikut:
          <ul><?php foreach ((array) session('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
        </div>
      <?php endif; ?>

      <?= $this->renderSection('content') ?>
    </main>
  </div>
</div>
<script src="<?= base_url('assets/js/admin.js') ?>" defer></script>
</body>
</html>
