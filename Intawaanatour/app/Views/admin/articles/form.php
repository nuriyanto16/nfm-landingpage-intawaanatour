<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  $isEdit = ! empty($article);
  $action = $isEdit ? site_url('admin/articles/' . $article['id']) : site_url('admin/articles');
  $v      = static fn(string $k, $def = '') => esc(old($k, $article[$k] ?? $def));
?>

<div class="page-head">
  <h2><?= esc($title) ?></h2>
  <a class="btn" href="<?= site_url('admin/articles') ?>">&larr; Kembali</a>
</div>

<form method="post" action="<?= $action ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <div class="card">
    <h2>Konten</h2>
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
    <div class="field">
      <label>Slug <span class="hint">kosongkan untuk otomatis</span></label>
      <input type="text" name="slug" value="<?= $v('slug') ?>">
    </div>
    <div class="form-row">
      <div class="field">
        <label>Ringkasan (ID)</label>
        <textarea name="excerpt_id"><?= $v('excerpt_id') ?></textarea>
      </div>
      <div class="field">
        <label>Ringkasan (EN)</label>
        <textarea name="excerpt_en"><?= $v('excerpt_en') ?></textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="field">
        <label>Isi Artikel (ID)</label>
        <textarea name="content_id" style="min-height:240px"><?= $v('content_id') ?></textarea>
      </div>
      <div class="field">
        <label>Isi Artikel (EN)</label>
        <textarea name="content_en" style="min-height:240px"><?= $v('content_en') ?></textarea>
      </div>
    </div>
  </div>

  <div class="card">
    <h2>Meta &amp; Publikasi</h2>
    <div class="form-row">
      <div class="field">
        <label>Cover Image</label>
        <?php if ($isEdit && ! empty($article['cover_image'])): ?>
          <img class="thumb" style="width:120px;height:80px;margin-bottom:8px" src="<?= img_url($article['cover_image']) ?>" alt="">
        <?php endif; ?>
        <input type="file" name="cover_image" accept="image/*">
      </div>
      <div class="field">
        <label>Penulis</label>
        <input type="text" name="author" value="<?= $v('author', 'Tim Intawaanatour') ?>">
      </div>
    </div>
    <div class="field">
      <label>Meta Description <span class="hint">untuk SEO, maks ~160 karakter</span></label>
      <input type="text" name="meta_description" value="<?= $v('meta_description') ?>" maxlength="255">
    </div>
    <div class="form-row">
      <div class="field">
        <label>Tanggal Terbit</label>
        <?php
          $pub = old('published_at', $article['published_at'] ?? '');
          $pub = $pub ? date('Y-m-d\TH:i', strtotime($pub)) : '';
        ?>
        <input type="datetime-local" name="published_at" value="<?= esc($pub) ?>">
      </div>
      <div class="field">
        <label>&nbsp;</label>
        <label class="check">
          <input type="checkbox" name="is_published" value="1" <?= old('is_published', $article['is_published'] ?? 1) ? 'checked' : '' ?>>
          Terbitkan artikel
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Artikel</button>
  </div>
</form>

<?= $this->endSection() ?>
