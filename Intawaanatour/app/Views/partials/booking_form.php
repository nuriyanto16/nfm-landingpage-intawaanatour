<?php $selTrip = $trip['id'] ?? null; ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert--success">
    <?= esc(session()->getFlashdata('success')) ?>
    <?php if (session()->getFlashdata('wa')): ?>
      <div style="margin-top:.6rem"><a class="btn btn--sm" style="background:#25d366;color:#fff" href="<?= esc(session()->getFlashdata('wa')) ?>" target="_blank" rel="noopener"><?= t('Lanjut chat WhatsApp', 'Continue on WhatsApp') ?></a></div>
    <?php endif ?>
  </div>
<?php endif ?>

<?php if (session()->getFlashdata('errors')): ?>
  <div class="alert alert--error">
    <strong><?= t('Mohon periksa kembali:', 'Please check:') ?></strong>
    <ul>
      <?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach ?>
    </ul>
  </div>
<?php endif ?>

<form action="<?= base_url('booking') ?>" method="post">
  <?= csrf_field() ?>
  <div class="field">
    <label><?= t('Nama Lengkap', 'Full Name') ?> *</label>
    <input type="text" name="name" value="<?= esc(old('name')) ?>" required placeholder="<?= t('Nama Anda', 'Your name') ?>">
  </div>
  <div class="field">
    <label><?= t('No. WhatsApp', 'WhatsApp No.') ?> *</label>
    <input type="text" name="phone" value="<?= esc(old('phone')) ?>" required placeholder="08xxxxxxxxxx">
  </div>
  <div class="field">
    <label>Email</label>
    <input type="email" name="email" value="<?= esc(old('email')) ?>" placeholder="email@contoh.com">
  </div>
  <div class="field">
    <label><?= t('Pilih Paket', 'Select Package') ?></label>
    <select name="trip_id">
      <option value=""><?= t('— Pilih paket —', '— Select package —') ?></option>
      <?php foreach (($allTrips ?? []) as $tp): ?>
        <option value="<?= $tp['id'] ?>" <?= (int) $selTrip === (int) $tp['id'] ? 'selected' : '' ?>><?= esc(tr($tp, 'title')) ?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="form-row">
    <div class="field">
      <label><?= t('Tanggal', 'Date') ?></label>
      <input type="date" name="trip_date" value="<?= esc(old('trip_date')) ?>">
    </div>
    <div class="field">
      <label><?= t('Jml Tamu', 'Guests') ?></label>
      <input type="number" name="pax" min="1" value="<?= esc(old('pax')) ?>" placeholder="2">
    </div>
  </div>
  <div class="field">
    <label><?= t('Pesan', 'Message') ?></label>
    <textarea name="message" placeholder="<?= t('Pertanyaan atau permintaan khusus...', 'Questions or special requests...') ?>"><?= esc(old('message')) ?></textarea>
  </div>
  <button type="submit" class="btn btn--primary btn--block"><?= t('Kirim Permintaan', 'Send Request') ?></button>
</form>
