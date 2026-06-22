<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin &middot; Intawaanatour</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <link rel="icon" href="<?= base_url('assets/img/favicon.svg') ?>" type="image/svg+xml">
  <style>
    *{box-sizing:border-box}
    body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;
      font-family:'Inter',system-ui,sans-serif;background:radial-gradient(120% 120% at 0% 0%,#13bdbb 0%,#0c8a89 35%,#0b1220 100%);padding:20px}
    .box{background:#fff;border-radius:18px;padding:40px 34px 34px;width:100%;max-width:392px;box-shadow:0 30px 60px -12px rgba(0,0,0,.45)}
    .logo{width:54px;height:54px;border-radius:14px;background:linear-gradient(135deg,#0ea5a4,#22d3d1);display:grid;place-items:center;
      color:#04201f;font-weight:800;font-size:24px;margin:0 auto 16px;box-shadow:0 8px 20px rgba(14,165,164,.4)}
    .box h1{margin:0 0 4px;font-size:22px;text-align:center;color:#0f172a;font-weight:800;letter-spacing:-.02em}
    .box h1 span{color:#0ea5a4}
    .box p{margin:0 0 26px;text-align:center;color:#64748b;font-size:14px}
    label{display:block;font-weight:600;margin-bottom:6px;color:#1e293b;font-size:14px}
    .field{margin-bottom:18px}
    input{width:100%;padding:11px 13px;border:1px solid #e2e8f0;border-radius:10px;font:inherit;transition:border-color .12s,box-shadow .12s}
    input:focus{outline:none;border-color:#0ea5a4;box-shadow:0 0 0 3px rgba(14,165,164,.18)}
    button{width:100%;padding:13px;border:0;border-radius:10px;background:#0ea5a4;color:#fff;font-weight:700;font-size:15px;cursor:pointer;transition:background .12s}
    button:hover{background:#0c8a89}
    .alert{background:#fef2f2;color:#991b1b;padding:11px 14px;border-radius:10px;margin-bottom:18px;font-size:14px;font-weight:500;border:1px solid #fecaca}
    .captcha-row{display:flex;align-items:center;gap:10px}
    .captcha-row img{border:1px solid #e2e8f0;border-radius:8px;height:50px;width:150px;background:#f5f7fa}
    .captcha-row button{width:auto;padding:0 12px;height:50px;background:#f1f5f9;color:#0f172a;font-size:13px;border:1px solid #e2e8f0}
    .captcha-row button:hover{background:#e2e8f0}
    .captcha-field input{text-transform:uppercase;letter-spacing:.18em;font-weight:600}
  </style>
</head>
<body>
  <form class="box" method="post" action="<?= site_url('admin/login') ?>">
    <?= csrf_field() ?>
    <div class="logo">I</div>
    <h1>Intawaana<span>tour</span></h1>
    <p>Masuk ke panel administrator</p>

    <?php if (session('error')): ?>
      <div class="alert"><?= esc(session('error')) ?></div>
    <?php endif; ?>

    <div class="field">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= esc(old('email')) ?>" required autofocus>
    </div>
    <div class="field">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>
    <div class="field captcha-field">
      <label for="captcha">Kode Captcha</label>
      <div class="captcha-row">
        <img id="captchaImg" src="<?= site_url('admin/captcha') ?>" alt="Kode captcha">
        <button type="button" id="captchaReload" title="Muat ulang kode">&#8635;</button>
      </div>
      <input type="text" id="captcha" name="captcha" maxlength="5" required autocomplete="off"
             inputmode="latin" placeholder="Masukkan 5 karakter di atas" style="margin-top:10px">
    </div>
    <button type="submit">Masuk</button>
    <script>
      document.getElementById('captchaReload').addEventListener('click', function () {
        document.getElementById('captchaImg').src = '<?= site_url('admin/captcha') ?>?t=' + Date.now();
        document.getElementById('captcha').value = '';
      });
    </script>
  </form>
</body>
</html>
