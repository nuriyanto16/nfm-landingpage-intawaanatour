<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?php
$unit     = $trip['type'] === 'shared' ? t('/ orang', '/ person') : t('/ trip', '/ trip');
$hasPromo = isset($trip['promo_price']) && (float) $trip['promo_price'] > 0 && (float) $trip['promo_price'] < (float) $trip['price'];
$isSunset = $trip['type'] === 'sunset' || str_contains($trip['slug'], 'sunset');
?>
<?= partial('partials/page_hero', [
    'title' => tr($trip, 'title'),
    'bg'    => ltrim(str_replace('assets/img/', '', (string) $trip['cover_image']), '/') ?: 'trip-private-fullday.jpg',
]) ?>

<section class="section">
  <div class="container detail-grid">
    <div>
      <!-- Galeri -->
      <div class="detail-gallery">
        <?php foreach (array_slice($images, 0, 6) as $img): ?>
          <a href="<?= img_url($img['image_path']) ?>" data-lightbox>
            <img src="<?= img_url($img['image_path']) ?>" alt="<?= esc(tr($trip, 'title')) ?>" loading="lazy">
          </a>
        <?php endforeach ?>
      </div>

      <span class="eyebrow"><?= ucfirst($trip['type']) ?> Trip</span>
      <h2><?= esc(tr($trip, 'title')) ?></h2>
      <div class="card__meta" style="margin-bottom:1.2rem">
        <span>🕒 <?= esc(tr($trip, 'duration')) ?></span>
        <span>👥 <?= esc($trip['capacity']) ?></span>
        <span>📍 Labuan Bajo</span>
      </div>

      <p><?= nl2br(esc(tr($trip, 'description'))) ?></p>

      <?php if (tr($trip, 'itinerary')): ?>
        <h3 style="margin-top:2rem"><?= t('Rencana Perjalanan', 'Itinerary') ?></h3>
        <ul class="itinerary">
          <?php foreach (preg_split('/\r\n|\r|\n/', tr($trip, 'itinerary')) as $line): if (trim($line) === '') continue; ?>
            <li><?= esc($line) ?></li>
          <?php endforeach ?>
        </ul>
      <?php endif ?>

      <div class="incexc">
        <div>
          <h3 style="margin-top:2rem"><?= t('Termasuk (Included)', 'Included') ?></h3>
          <ul class="checklist">
            <li><?= t('Speedboat ber-AC + BBM', 'Air-conditioned speedboat + fuel') ?></li>
            <li><?= t('Antar-jemput hotel – pelabuhan – hotel', 'Shuttle hotel – harbor – hotel') ?></li>
            <li><?= t('Pemandu profesional & dokumentasi foto', 'Professional guide & photography') ?></li>
            <li><?= t('Air mineral, soft drink & snack', 'Mineral water, soft drink & snacks') ?></li>
            <li><?= t('Lunch box & buah', 'Lunch box & fruits') ?></li>
            <li><?= t('Life jacket, alat snorkeling & handuk', 'Life jacket, snorkeling gear & towel') ?></li>
          </ul>
        </div>
        <div>
          <h3 style="margin-top:2rem"><?= t('Tidak Termasuk (Excluded)', 'Excluded') ?></h3>
          <ul class="checklist checklist--x">
            <li><?= $isSunset ? t('Tiket masuk taman nasional (Rinca)', 'National park entrance fee (Rinca)') : t('Tiket masuk taman nasional', 'National park entrance fee') ?></li>
            <li><?= t('Hotel & tiket pesawat', 'Hotel & airplane ticket') ?></li>
            <li><?= t('Tips/gratitude untuk kru', 'Gratuity / crew tipping') ?></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Booking box -->
    <aside>
      <div class="booking-box">
        <?php if ($hasPromo): ?>
          <span class="promo-flag"><?= esc(tr($trip, 'promo_label', t('Penawaran Spesial', 'Special Offer'))) ?></span>
          <div class="price-tag">
            <span class="price-was"><?= rupiah($trip['price']) ?></span>
            <?= rupiah($trip['promo_price']) ?><small style="font-size:.8rem;color:var(--muted);font-family:var(--font)"><?= $unit ?></small>
          </div>
        <?php else: ?>
          <div class="price-tag"><?= rupiah($trip['price']) ?>
            <?php if ((float) $trip['price'] > 0): ?><small style="font-size:.8rem;color:var(--muted);font-family:var(--font)"><?= $unit ?></small><?php endif ?>
          </div>
        <?php endif ?>
        <?php if (tr($trip, 'price_note')): ?><p class="price-note muted" style="font-size:.82rem"><?= esc(tr($trip, 'price_note')) ?></p><?php endif ?>
        <p class="muted" style="font-size:.88rem"><?= t('Isi formulir, tim kami akan menghubungi Anda.', 'Fill in the form and our team will contact you.') ?></p>

        <?= partial('partials/booking_form', ['trip' => $trip, 'allTrips' => $allTrips]) ?>

        <a href="<?= wa_link(t('Halo, saya ingin memesan ', 'Hi, I would like to book ') . tr($trip, 'title')) ?>" class="btn btn--block" style="background:#25d366;color:#fff;margin-top:.8rem" target="_blank" rel="noopener"><?= t('Pesan via WhatsApp', 'Book via WhatsApp') ?></a>
      </div>
    </aside>
  </div>
</section>

<?php $destKeys = $isSunset
    ? ['kelor', 'menjerite', 'rinca', 'kalong']
    : ['padar', 'pink-beach', 'komodo', 'taka-makasar', 'manta-point', 'siaba']; ?>
<section class="section">
  <div class="container">
    <?= partial('partials/destinations', ['keys' => $destKeys]) ?>
  </div>
</section>

<section class="section section--sand">
  <div class="container">
    <?= partial('partials/boat_spec') ?>
  </div>
</section>

<?= $this->endSection() ?>
