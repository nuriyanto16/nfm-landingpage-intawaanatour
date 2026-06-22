<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  $labels = [
    'site_name'        => ['Nama Situs', 'text'],
    'site_tagline_id'  => ['Tagline (ID)', 'text'],
    'site_tagline_en'  => ['Tagline (EN)', 'text'],
    'meta_description' => ['Meta Description (SEO)', 'textarea'],
    'phone'            => ['Telepon', 'text'],
    'whatsapp'         => ['Nomor WhatsApp', 'text'],
    'email'            => ['Email', 'email'],
    'address'          => ['Alamat', 'textarea'],
    'operating_hours'  => ['Jam Operasional', 'text'],
    'instagram'        => ['URL Instagram', 'url'],
    'facebook'         => ['URL Facebook', 'url'],
    'maps_embed'       => ['Kode Embed Google Maps', 'textarea'],
  ];
  $hints = [
    'whatsapp'   => 'Format internasional tanpa tanda +, mis. 6281234567890',
    'maps_embed' => 'Tempel seluruh kode &lt;iframe&gt; dari Google Maps &rarr; Bagikan &rarr; Sematkan peta',
  ];
?>

<div class="page-head">
  <h2>Pengaturan Situs</h2>
</div>

<form method="post" action="<?= site_url('admin/settings') ?>">
  <?= csrf_field() ?>

  <div class="card">
    <h2>Identitas &amp; Kontak</h2>
    <?php foreach ($keys as $key): ?>
      <?php [$label, $type] = $labels[$key] ?? [ucfirst(str_replace('_', ' ', $key)), 'text']; ?>
      <div class="field">
        <label>
          <?= esc($label) ?>
          <?php if (isset($hints[$key])): ?><span class="hint"><?= $hints[$key] ?></span><?php endif; ?>
        </label>
        <?php $val = old($key, $settings[$key] ?? ''); ?>
        <?php if ($type === 'textarea'): ?>
          <textarea name="<?= esc($key) ?>"><?= esc($val) ?></textarea>
        <?php else: ?>
          <input type="<?= esc($type) ?>" name="<?= esc($key) ?>" value="<?= esc($val) ?>">
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
  </div>
</form>

<?= $this->endSection() ?>
