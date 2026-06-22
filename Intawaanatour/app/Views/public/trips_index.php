<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?= partial('partials/page_hero', [
    'title'    => t('Paket Trip Labuan Bajo', 'Labuan Bajo Trip Packages'),
    'subtitle' => t('Temukan paket terbaik untuk menjelajahi Taman Nasional Komodo.', 'Find the best package to explore Komodo National Park.'),
    'bg'       => 'trip-padar.jpg',
]) ?>

<section class="section">
  <div class="container">
    <div class="pills">
      <button class="pill active" data-filter="all"><?= t('Semua', 'All') ?></button>
      <button class="pill" data-filter="private"><?= t('Private Trip', 'Private Trip') ?></button>
      <button class="pill" data-filter="shared"><?= t('Shared Trip', 'Shared Trip') ?></button>
      <button class="pill" data-filter="sunset"><?= t('Sunset Trip', 'Sunset Trip') ?></button>
    </div>

    <div class="grid grid--3">
      <?php foreach ($trips as $trip): ?>
        <?= partial('partials/trip_card', ['trip' => $trip]) ?>
      <?php endforeach ?>
    </div>

    <?php if (empty($trips)): ?>
      <p class="center muted"><?= t('Belum ada paket trip.', 'No trip packages yet.') ?></p>
    <?php endif ?>
  </div>
</section>

<?= $this->endSection() ?>
