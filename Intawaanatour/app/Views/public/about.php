<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?= partial('partials/page_hero', [
    'title'    => t('Tentang Inta Waana Tour', 'About Inta Waana Tour'),
    'subtitle' => t('Partner perjalanan laut Anda di Labuan Bajo.', 'Your sea travel partner in Labuan Bajo.'),
    'bg'       => 'about.jpg',
]) ?>

<section class="section">
  <div class="container split">
    <div class="split__media reveal">
      <img src="<?= base_url('assets/img/gal-boat.jpg') ?>" alt="<?= t('Armada Inta Waana Tour', 'Inta Waana Tour fleet') ?>" loading="lazy">
      <div class="badge">100%<small><?= t('Private', 'Private') ?></small></div>
    </div>
    <div class="reveal">
      <span class="eyebrow"><?= t('Cerita Kami', 'Our Story') ?></span>
      <h2><?= t('Menghadirkan Pengalaman Laut Terbaik Komodo', 'Bringing the Best Komodo Sea Experience') ?></h2>
      <p><?= t(
          'Inta Waana Tour lahir dari kecintaan terhadap keindahan Labuan Bajo dan Taman Nasional Komodo. Kami percaya setiap tamu berhak mendapatkan perjalanan yang aman, nyaman, dan penuh kenangan.',
          'Inta Waana Tour was born from a love of the beauty of Labuan Bajo and Komodo National Park. We believe every guest deserves a safe, comfortable and memorable journey.'
      ) ?></p>
      <p><?= t(
          'Dengan armada speedboat modern dan tim profesional, kami siap mengantar Anda ke spot-spot terbaik — dari trekking Pulau Padar hingga berenang bersama manta.',
          'With a modern speedboat fleet and a professional team, we are ready to take you to the best spots — from trekking Padar Island to swimming with mantas.'
      ) ?></p>
    </div>
  </div>
</section>

<section class="section section--sand">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?= t('Nilai Kami', 'Our Values') ?></span>
      <h2><?= t('Komitmen Kami untuk Anda', 'Our Commitment to You') ?></h2>
    </div>
    <div class="grid grid--3">
      <div class="feature reveal"><div class="feature__icon">🛟</div><h3><?= t('Keselamatan Utama', 'Safety First') ?></h3><p class="muted"><?= t('Perlengkapan keselamatan lengkap & kru tersertifikasi di setiap perjalanan.', 'Complete safety equipment & certified crew on every trip.') ?></p></div>
      <div class="feature reveal"><div class="feature__icon">⭐</div><h3><?= t('Pelayanan Berkelas', 'Premium Service') ?></h3><p class="muted"><?= t('Layanan personal yang ramah dan memperhatikan setiap detail kebutuhan tamu.', 'Friendly, personal service attentive to every guest need.') ?></p></div>
      <div class="feature reveal"><div class="feature__icon">🌊</div><h3><?= t('Cinta Lingkungan', 'Eco-Conscious') ?></h3><p class="muted"><?= t('Kami menjaga kelestarian laut Komodo untuk generasi mendatang.', 'We protect Komodo\'s seas for future generations.') ?></p></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <?= partial('partials/boat_spec') ?>
  </div>
</section>

<section class="cta-band section">
  <div class="cta-band__bg"><img src="<?= base_url('assets/img/gal-sunset.jpg') ?>" alt="Sunset"></div>
  <div class="container">
    <h2><?= t('Mari Berlayar Bersama', 'Let\'s Set Sail Together') ?></h2>
    <p><?= t('Wujudkan liburan impian Anda di Labuan Bajo sekarang.', 'Make your dream Labuan Bajo holiday happen now.') ?></p>
    <a href="<?= base_url('contact') ?>" class="btn btn--primary"><?= t('Hubungi Kami', 'Contact Us') ?></a>
  </div>
</section>

<?= $this->endSection() ?>
