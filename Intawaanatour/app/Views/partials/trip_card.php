<?php
$typeLabel = [
    'private' => t('Private', 'Private'),
    'shared'  => t('Shared', 'Shared'),
    'sunset'  => t('Sunset', 'Sunset'),
][$trip['type']] ?? ucfirst($trip['type']);
?>
<article class="card reveal" data-type="<?= esc($trip['type']) ?>">
  <a href="<?= base_url('trips/' . $trip['slug']) ?>" class="card__media">
    <img src="<?= img_url($trip['cover_image']) ?>" alt="<?= esc(tr($trip, 'title')) ?>" loading="lazy" width="1200" height="800">
    <span class="card__tag"><?= esc($typeLabel) ?></span>
  </a>
  <div class="card__body">
    <h3><a href="<?= base_url('trips/' . $trip['slug']) ?>"><?= esc(tr($trip, 'title')) ?></a></h3>
    <div class="card__meta">
      <span>🕒 <?= esc(tr($trip, 'duration')) ?></span>
      <span>👥 <?= esc($trip['capacity']) ?></span>
    </div>
    <p class="muted"><?= esc(character_limiter(tr($trip, 'summary'), 90)) ?></p>
    <div class="card__price">
      <?= rupiah($trip['price']) ?>
      <?php if ((float) $trip['price'] > 0): ?><small><?= $trip['type'] === 'shared' ? t('/ orang', '/ person') : t('/ trip', '/ trip') ?></small><?php endif ?>
    </div>
    <div class="card__foot">
      <a href="<?= base_url('trips/' . $trip['slug']) ?>" class="btn btn--outline btn--sm btn--block"><?= t('Lihat Detail', 'View Details') ?></a>
    </div>
  </div>
</article>
