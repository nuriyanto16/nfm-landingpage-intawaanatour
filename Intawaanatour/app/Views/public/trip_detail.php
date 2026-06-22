<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?= partial('partials/page_hero', [
    'title' => tr($trip, 'title'),
    'bg'    => 'trip-padar.jpg',
]) ?>

<section class="section">
  <div class="container detail-grid">
    <div>
      <!-- Galeri -->
      <div class="detail-gallery">
        <?php foreach (array_slice($images, 0, 5) as $img): ?>
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

      <h3 style="margin-top:2rem"><?= t('Fasilitas Termasuk', 'What\'s Included') ?></h3>
      <ul class="checklist">
        <li><?= t('Speedboat private/charter + BBM', 'Speedboat charter + fuel') ?></li>
        <li><?= t('Kapten & kru profesional', 'Professional captain & crew') ?></li>
        <li><?= t('Alat snorkeling & life jacket', 'Snorkeling gear & life jacket') ?></li>
        <li><?= t('Air mineral & dokumentasi', 'Mineral water & documentation') ?></li>
        <li><?= t('Tiket masuk (sesuai paket)', 'Entrance tickets (as per package)') ?></li>
      </ul>
    </div>

    <!-- Booking box -->
    <aside>
      <div class="booking-box">
        <div class="price-tag"><?= rupiah($trip['price']) ?>
          <?php if ((float) $trip['price'] > 0): ?><small style="font-size:.8rem;color:var(--muted);font-family:var(--font)"><?= $trip['type'] === 'shared' ? t('/ orang', '/ person') : t('/ trip', '/ trip') ?></small><?php endif ?>
        </div>
        <p class="muted" style="font-size:.88rem"><?= t('Isi formulir, tim kami akan menghubungi Anda.', 'Fill in the form and our team will contact you.') ?></p>

        <?= partial('partials/booking_form', ['trip' => $trip, 'allTrips' => $allTrips]) ?>

        <a href="<?= wa_link(t('Halo, saya ingin memesan ', 'Hi, I would like to book ') . tr($trip, 'title')) ?>" class="btn btn--block" style="background:#25d366;color:#fff;margin-top:.8rem" target="_blank" rel="noopener"><?= t('Pesan via WhatsApp', 'Book via WhatsApp') ?></a>
      </div>
    </aside>
  </div>
</section>

<?= $this->endSection() ?>
