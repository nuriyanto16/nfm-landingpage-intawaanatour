<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?= partial('partials/page_hero', [
    'title'    => t('Hubungi Kami', 'Contact Us'),
    'subtitle' => t('Kami siap membantu merencanakan perjalanan Anda.', 'We are ready to help plan your journey.'),
    'bg'       => 'contact.jpg',
]) ?>

<section class="section">
  <div class="container contact-grid">
    <div>
      <span class="eyebrow"><?= t('Kontak', 'Get in Touch') ?></span>
      <h2><?= t('Mari Bicara', 'Let\'s Talk') ?></h2>
      <p class="muted"><?= t('Hubungi kami melalui kanal di bawah ini, atau isi formulir dan tim kami akan segera membalas.', 'Reach us through the channels below, or fill in the form and our team will reply soon.') ?></p>

      <ul class="contact-list">
        <li><span class="ic">📍</span><div><b><?= t('Alamat', 'Address') ?></b><?= esc(setting('address')) ?></div></li>
        <li><span class="ic">📞</span><div><b><?= t('Telepon', 'Phone') ?></b><a href="tel:<?= esc(preg_replace('/[^0-9+]/', '', setting('phone'))) ?>"><?= esc(setting('phone')) ?></a></div></li>
        <li><span class="ic">💬</span><div><b>WhatsApp</b><a href="<?= wa_link() ?>" target="_blank" rel="noopener"><?= esc(setting('whatsapp')) ?></a></div></li>
        <li><span class="ic">✉️</span><div><b>Email</b><a href="mailto:<?= esc(setting('email')) ?>"><?= esc(setting('email')) ?></a></div></li>
        <li><span class="ic">🕒</span><div><b><?= t('Jam Operasional', 'Operating Hours') ?></b><?= esc(setting('operating_hours')) ?></div></li>
      </ul>

      <?php if (setting('maps_embed')): ?>
        <div class="map-wrap" style="margin-top:1.5rem">
          <iframe src="<?= esc(setting('maps_embed')) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Map"></iframe>
        </div>
      <?php endif ?>
    </div>

    <div>
      <div class="booking-box" style="position:static">
        <h3><?= t('Formulir Reservasi', 'Reservation Form') ?></h3>
        <?= partial('partials/booking_form', ['allTrips' => $allTrips]) ?>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
