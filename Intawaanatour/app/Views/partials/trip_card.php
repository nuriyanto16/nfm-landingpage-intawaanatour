<?php
$typeLabel = [
    'private' => t('Private', 'Private'),
    'shared'  => t('Open Trip', 'Open Trip'),
    'sunset'  => t('Sunset', 'Sunset'),
][$trip['type']] ?? ucfirst($trip['type']);

$unit     = $trip['type'] === 'shared' ? t('/ orang', '/ person') : t('/ trip', '/ trip');
$hasPromo = isset($trip['promo_price']) && (float) $trip['promo_price'] > 0 && (float) $trip['promo_price'] < (float) $trip['price'];
?>
<article class="card reveal" data-type="<?= esc($trip['type']) ?>">
  <a href="<?= base_url('trips/' . $trip['slug']) ?>" class="card__media">
    <img src="<?= img_url($trip['cover_image']) ?>" alt="<?= esc(tr($trip, 'title')) ?>" loading="lazy" width="1200" height="800">
    <span class="card__tag"><?= esc($typeLabel) ?></span>
    <?php if ($hasPromo): ?><span class="card__promo"><?= esc(tr($trip, 'promo_label', t('Penawaran Spesial', 'Special Offer'))) ?></span><?php endif ?>
  </a>
  <div class="card__body">
    <h3><a href="<?= base_url('trips/' . $trip['slug']) ?>"><?= esc(tr($trip, 'title')) ?></a></h3>
    <div class="card__meta">
      <span>🕒 <?= esc(tr($trip, 'duration')) ?></span>
      <span>👥 <?= esc($trip['capacity']) ?></span>
    </div>
    <p class="muted"><?= esc(character_limiter(tr($trip, 'summary'), 90, '…')) ?></p>
    <div class="card__price">
      <?php if ($hasPromo): ?>
        <span class="price-was"><?= rupiah($trip['price']) ?></span>
        <span class="price-now"><?= rupiah($trip['promo_price']) ?><small><?= $unit ?></small></span>
      <?php else: ?>
        <?= rupiah($trip['price']) ?>
        <?php if ((float) $trip['price'] > 0): ?><small><?= $unit ?></small><?php endif ?>
      <?php endif ?>
    </div>
    <?php if (tr($trip, 'price_note')): ?><p class="price-note muted"><?= esc(tr($trip, 'price_note')) ?></p><?php endif ?>
    <div class="card__foot">
      <a href="<?= base_url('trips/' . $trip['slug']) ?>" class="btn btn--outline btn--sm btn--block"><?= t('Lihat Detail', 'View Details') ?></a>
    </div>
  </div>
</article>
