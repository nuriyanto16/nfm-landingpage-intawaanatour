<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="page-head">
  <h2>Galeri Foto</h2>
</div>

<div class="card">
  <h2>Unggah Foto Baru</h2>
  <form method="post" action="<?= site_url('admin/gallery') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="form-row">
      <div class="field">
        <label>Judul / Keterangan</label>
        <input type="text" name="title" value="<?= esc(old('title')) ?>" placeholder="cth: Pulau Padar">
      </div>
      <div class="field">
        <label>Kategori</label>
        <input type="text" name="category" value="<?= esc(old('category')) ?>" placeholder="cth: Landscape">
      </div>
    </div>
    <div class="field">
      <label>Foto <span class="hint">bisa pilih beberapa sekaligus</span></label>
      <input type="file" name="images[]" accept="image/*" multiple required>
    </div>
    <button type="submit" class="btn btn-primary">Unggah</button>
  </form>
</div>

<div class="card">
  <h2>Semua Foto (<?= count($items) ?>)</h2>
  <?php if (empty($items)): ?>
    <div class="empty">Belum ada foto di galeri.</div>
  <?php else: ?>
    <div class="img-grid">
      <?php foreach ($items as $g): ?>
        <figure>
          <img src="<?= img_url($g['image_path']) ?>" alt="<?= esc($g['title']) ?>">
          <a class="del" href="<?= site_url('admin/gallery/' . $g['id'] . '/delete') ?>"
             onclick="return confirm('Hapus foto ini?')">Hapus</a>
          <figcaption style="padding:8px 10px;font-size:12px">
            <strong><?= esc($g['title'] ?: 'Tanpa judul') ?></strong><br>
            <span class="hint"><?= esc($g['category'] ?: 'Umum') ?></span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
