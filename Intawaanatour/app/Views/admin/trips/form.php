<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  $isEdit = ! empty($trip);
  $action = $isEdit ? site_url('admin/trips/' . $trip['id']) : site_url('admin/trips');
  $v      = static fn(string $k, $def = '') => esc(old($k, $trip[$k] ?? $def));
?>

<div class="page-head">
  <h2><?= esc($title) ?></h2>
  <a class="btn" href="<?= site_url('admin/trips') ?>">&larr; Kembali</a>
</div>

<form method="post" action="<?= $action ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <div class="card">
    <h2>Informasi Dasar</h2>
    <div class="form-row">
      <div class="field">
        <label>Judul (ID) <span class="hint">wajib</span></label>
        <input type="text" name="title_id" value="<?= $v('title_id') ?>" required>
      </div>
      <div class="field">
        <label>Judul (EN)</label>
        <input type="text" name="title_en" value="<?= $v('title_en') ?>">
      </div>
    </div>
    <div class="form-row">
      <div class="field">
        <label>Slug <span class="hint">kosongkan untuk otomatis</span></label>
        <input type="text" name="slug" value="<?= $v('slug') ?>">
      </div>
      <div class="field">
        <label>Tipe Trip</label>
        <?php $type = old('type', $trip['type'] ?? 'private'); ?>
        <select name="type">
          <option value="private" <?= $type === 'private' ? 'selected' : '' ?>>Private Trip</option>
          <option value="open" <?= $type === 'open' ? 'selected' : '' ?>>Open Trip</option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="field">
        <label>Harga (Rp)</label>
        <input type="number" name="price" step="1000" min="0" value="<?= $v('price', '0') ?>">
      </div>
      <div class="field">
        <label>Kapasitas</label>
        <input type="text" name="capacity" value="<?= $v('capacity') ?>" placeholder="cth: 4-12 orang">
      </div>
    </div>
    <div class="form-row">
      <div class="field">
        <label>Durasi (ID)</label>
        <input type="text" name="duration_id" value="<?= $v('duration_id') ?>" placeholder="cth: 3 Hari 2 Malam">
      </div>
      <div class="field">
        <label>Durasi (EN)</label>
        <input type="text" name="duration_en" value="<?= $v('duration_en') ?>" placeholder="e.g. 3 Days 2 Nights">
      </div>
    </div>
  </div>

  <div class="card">
    <h2>Deskripsi</h2>
    <div class="form-row">
      <div class="field">
        <label>Ringkasan (ID)</label>
        <textarea name="summary_id"><?= $v('summary_id') ?></textarea>
      </div>
      <div class="field">
        <label>Ringkasan (EN)</label>
        <textarea name="summary_en"><?= $v('summary_en') ?></textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="field">
        <label>Deskripsi Lengkap (ID)</label>
        <textarea name="description_id" style="min-height:140px"><?= $v('description_id') ?></textarea>
      </div>
      <div class="field">
        <label>Deskripsi Lengkap (EN)</label>
        <textarea name="description_en" style="min-height:140px"><?= $v('description_en') ?></textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="field">
        <label>Itinerary (ID)</label>
        <textarea name="itinerary_id" style="min-height:140px"><?= $v('itinerary_id') ?></textarea>
      </div>
      <div class="field">
        <label>Itinerary (EN)</label>
        <textarea name="itinerary_en" style="min-height:140px"><?= $v('itinerary_en') ?></textarea>
      </div>
    </div>
  </div>

  <div class="card">
    <h2>Gambar</h2>
    <div class="form-row">
      <div class="field">
        <label>Cover Image</label>
        <?php if ($isEdit && ! empty($trip['cover_image'])): ?>
          <img class="thumb" style="width:120px;height:80px;margin-bottom:8px" src="<?= img_url($trip['cover_image']) ?>" alt="">
        <?php endif; ?>
        <input type="file" name="cover_image" accept="image/*">
      </div>
      <div class="field">
        <label>Tambah Foto Galeri <span class="hint">bisa pilih beberapa</span></label>
        <input type="file" name="gallery[]" accept="image/*" multiple>
      </div>
    </div>

    <?php if ($isEdit && ! empty($images)): ?>
      <label>Galeri Saat Ini</label>
      <div class="img-grid">
        <?php foreach ($images as $img): ?>
          <figure>
            <img src="<?= img_url($img['image_path']) ?>" alt="">
            <a class="del" href="<?= site_url('admin/trips/image/' . $img['id'] . '/delete') ?>"
               onclick="return confirm('Hapus gambar ini?')">Hapus</a>
          </figure>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="card">
    <h2>Publikasi</h2>
    <div class="form-row">
      <div class="field">
        <label class="check">
          <input type="checkbox" name="is_active" value="1" <?= old('is_active', $trip['is_active'] ?? 1) ? 'checked' : '' ?>>
          Tampilkan di situs (aktif)
        </label>
        <label class="check" style="margin-top:12px">
          <input type="checkbox" name="is_featured" value="1" <?= old('is_featured', $trip['is_featured'] ?? 0) ? 'checked' : '' ?>>
          Jadikan trip unggulan
        </label>
      </div>
      <div class="field">
        <label>Urutan Tampil</label>
        <input type="number" name="sort_order" min="0" value="<?= $v('sort_order', '0') ?>">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Trip</button>
  </div>
</form>

<?= $this->endSection() ?>
