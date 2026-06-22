<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="page-head">
  <h2>Ubah Password</h2>
</div>

<form method="post" action="<?= site_url('admin/account/password') ?>" autocomplete="off">
  <?= csrf_field() ?>

  <div class="card" style="max-width:520px">
    <h2>Akun: <?= esc(session('admin_name') ?? 'Admin') ?></h2>

    <div class="field">
      <label>Password Saat Ini</label>
      <input type="password" name="current_password" autocomplete="current-password" required>
    </div>

    <div class="field">
      <label>
        Password Baru
        <span class="hint">Minimal 8 karakter</span>
      </label>
      <input type="password" name="new_password" autocomplete="new-password" required>
    </div>

    <div class="field">
      <label>Ulangi Password Baru</label>
      <input type="password" name="new_password_confirm" autocomplete="new-password" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
  </div>
</form>

<?= $this->endSection() ?>
