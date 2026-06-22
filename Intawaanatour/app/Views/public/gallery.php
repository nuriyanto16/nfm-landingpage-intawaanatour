<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?= partial('partials/page_hero', [
    'title'    => t('Galeri', 'Gallery'),
    'subtitle' => t('Momen-momen indah perjalanan bersama Intawaanatour.', 'Beautiful moments from journeys with Intawaanatour.'),
    'bg'       => 'gal-padar.jpg',
]) ?>

<section class="section">
  <div class="container">
    <div class="masonry">
      <?php foreach ($items as $g): ?>
        <a href="<?= img_url($g['image_path']) ?>" data-lightbox data-title="<?= esc($g['title']) ?>">
          <img src="<?= img_url($g['image_path']) ?>" alt="<?= esc($g['title']) ?>" loading="lazy">
        </a>
      <?php endforeach ?>
    </div>
    <?php if (empty($items)): ?>
      <p class="center muted"><?= t('Belum ada foto.', 'No photos yet.') ?></p>
    <?php endif ?>
  </div>
</section>

<?= $this->endSection() ?>
