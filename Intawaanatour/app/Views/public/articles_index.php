<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?= partial('partials/page_hero', [
    'title'    => t('Artikel & Tips', 'Articles & Tips'),
    'subtitle' => t('Panduan, itinerary, dan tips menjelajahi Labuan Bajo & Komodo.', 'Guides, itineraries and tips for exploring Labuan Bajo & Komodo.'),
    'bg'       => 'art-hero.jpg',
]) ?>

<section class="section">
  <div class="container">
    <div class="grid grid--3">
      <?php foreach ($articles as $a): ?>
        <?= partial('partials/article_card', ['a' => $a]) ?>
      <?php endforeach ?>
    </div>
    <?php if (empty($articles)): ?>
      <p class="center muted"><?= t('Belum ada artikel.', 'No articles yet.') ?></p>
    <?php endif ?>
  </div>
</section>

<?= $this->endSection() ?>
