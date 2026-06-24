<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- ============ HERO ============ -->
<section class="hero">
  <div class="hero__slider">
    <div class="hero__slide is-active">
      <video class="hero__video" autoplay muted loop playsinline preload="auto" poster="<?= base_url('assets/img/hero-poster.jpg') ?>">
        <source src="<?= base_url('assets/video/hero.mp4') ?>" type="video/mp4">
      </video>
    </div>
    <div class="hero__slide"><img src="<?= base_url('assets/img/trip-private-fullday.jpg') ?>" alt="<?= t('Pulau Padar, Taman Nasional Komodo', 'Padar Island, Komodo National Park') ?>" loading="lazy"></div>
    <div class="hero__slide"><img src="<?= base_url('assets/img/about-1.jpg') ?>" alt="<?= t('Tampak udara speedboat Inta Waana', 'Aerial view of Inta Waana speedboat') ?>" loading="lazy"></div>
  </div>
  <button class="hero__arrow hero__arrow--prev" type="button" aria-label="<?= t('Slide sebelumnya', 'Previous slide') ?>">‹</button>
  <button class="hero__arrow hero__arrow--next" type="button" aria-label="<?= t('Slide berikutnya', 'Next slide') ?>">›</button>
  <div class="hero__dots" aria-label="<?= t('Navigasi slider', 'Slider navigation') ?>"></div>
  <div class="container">
    <div class="hero__inner">
      <span class="eyebrow" style="color:var(--gold)"><?= t('Sewa Speedboat • Labuan Bajo • Komodo', 'Speedboat Charter • Labuan Bajo • Komodo') ?></span>
      <h1><?= t('Jelajahi Surga Komodo Bersama Inta Waana Tour', 'Explore the Paradise of Komodo with Inta Waana Tour') ?></h1>
      <p class="lead"><?= t(
          'Nikmati perjalanan cepat, nyaman, dan berkelas menuju Pulau Padar, Pink Beach, Manta Point, dan destinasi terbaik Taman Nasional Komodo.',
          'Enjoy a fast, comfortable and elegant journey to Padar Island, Pink Beach, Manta Point and the best destinations of Komodo National Park.'
      ) ?></p>
      <div class="hero__actions">
        <a href="<?= base_url('trips') ?>" class="btn btn--primary"><?= t('Lihat Paket Trip', 'View Trip Packages') ?></a>
        <a href="<?= wa_link(t('Halo Inta Waana Tour, saya tertarik dengan trip Labuan Bajo.', 'Hi Inta Waana Tour, I am interested in a Labuan Bajo trip.')) ?>" class="btn btn--ghost" target="_blank" rel="noopener"><?= t('Chat WhatsApp', 'Chat on WhatsApp') ?></a>
      </div>
    </div>
  </div>
  <span class="scroll-cue"><?= t('Gulir', 'Scroll') ?> ↓</span>
</section>

<!-- ============ INTRO / ABOUT ============ -->
<section class="section">
  <div class="container split">
    <div class="split__media reveal">
      <img src="<?= base_url('assets/img/about.jpg') ?>" alt="<?= t('Armada speedboat Inta Waana Tour', 'Inta Waana Tour speedboat fleet') ?>" loading="lazy">
    </div>
    <div class="reveal">
      <span class="eyebrow"><?= t('Tentang Kami', 'About Us') ?></span>
      <h2><?= t('Petualangan Laut yang Cepat, Aman, dan Berkesan', 'Sea Adventures that are Fast, Safe and Memorable') ?></h2>
      <p><?= t(
          'Inta Waana Tour adalah penyedia jasa sewa speedboat di Labuan Bajo yang mengutamakan kecepatan, kenyamanan, dan keselamatan. Armada modern kami dirancang untuk membawa Anda menjelajahi Taman Nasional Komodo tanpa kompromi.',
          'Inta Waana Tour is a speedboat charter provider in Labuan Bajo that prioritizes speed, comfort and safety. Our modern fleet is designed to take you across Komodo National Park without compromise.'
      ) ?></p>
      <ul class="checklist">
        <li><?= t('Speedboat cepat dengan kabin nyaman ber-AC', 'Fast speedboat with comfortable air-conditioned cabin') ?></li>
        <li><?= t('Kapten & kru berpengalaman serta tersertifikasi', 'Experienced and certified captain & crew') ?></li>
        <li><?= t('Perlengkapan keselamatan & snorkeling lengkap', 'Complete safety & snorkeling equipment') ?></li>
      </ul>
      <a href="<?= base_url('about') ?>" class="btn btn--outline"><?= t('Selengkapnya', 'Learn More') ?></a>
    </div>
  </div>
</section>

<!-- ============ FEATURED TRIPS ============ -->
<section class="section section--sand">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?= t('Paket Unggulan', 'Featured Packages') ?></span>
      <h2><?= t('Pilih Petualangan Impian Anda', 'Choose Your Dream Adventure') ?></h2>
      <p><?= t('Dari private trip eksklusif hingga shared trip hemat — semua dirancang untuk pengalaman terbaik.', 'From exclusive private trips to budget-friendly shared trips — all designed for the best experience.') ?></p>
    </div>
    <div class="grid grid--3" data-async="<?= base_url('home/section/trips') ?>">
      <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="card sk-card" aria-hidden="true">
          <div class="sk sk-media"></div>
          <div class="card__body">
            <div class="sk sk-line sk-line--lg"></div>
            <div class="sk sk-line sk-line--sm"></div>
            <div class="sk sk-line"></div>
            <div class="sk sk-line sk-line--80"></div>
            <div class="sk sk-btn"></div>
          </div>
        </div>
      <?php endfor ?>
    </div>
    <div class="center" style="margin-top:2.5rem">
      <a href="<?= base_url('trips') ?>" class="btn btn--teal"><?= t('Lihat Semua Paket', 'View All Packages') ?></a>
    </div>
  </div>
</section>

<!-- ============ WHY CHOOSE US ============ -->
<section class="section">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?= t('Kenapa Inta Waana Tour', 'Why Inta Waana Tour') ?></span>
      <h2><?= t('Alasan Tamu Mempercayai Kami', 'Why Guests Trust Us') ?></h2>
    </div>
    <div class="grid grid--3">
      <div class="feature reveal">
        <div class="feature__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 13l9-9 9 9M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <h3><?= t('Speedboat Cepat & Nyaman', 'Fast & Comfortable Speedboat') ?></h3>
        <p class="muted"><?= t('Armada modern bertenaga besar memangkas waktu tempuh, sehingga Anda punya lebih banyak waktu menikmati destinasi.', 'A powerful modern fleet cuts travel time, giving you more time to enjoy each destination.') ?></p>
      </div>
      <div class="feature reveal">
        <div class="feature__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7z" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <h3><?= t('Kru Profesional', 'Professional Crew') ?></h3>
        <p class="muted"><?= t('Kapten dan pemandu berpengalaman yang ramah, paham rute terbaik, serta mengutamakan keselamatan Anda.', 'Experienced, friendly captains and guides who know the best routes and prioritize your safety.') ?></p>
      </div>
      <div class="feature reveal">
        <div class="feature__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <h3><?= t('Pengalaman Terbaik', 'Best Experience') ?></h3>
        <p class="muted"><?= t('Paduan armada premium, layanan personal, dan keindahan alam Komodo untuk kenangan tak terlupakan.', 'A blend of premium fleet, personal service and Komodo\'s natural beauty for unforgettable memories.') ?></p>
      </div>
    </div>
  </div>
</section>

<!-- ============ STATS BAND ============ -->
<section class="cta-band section">
  <div class="cta-band__bg"><img src="<?= base_url('assets/img/gal-padar.jpg') ?>" alt="Padar"></div>
  <div class="container">
    <div class="stats">
      <div class="stat reveal"><b>9</b><span><?= t('Kapasitas Tamu', 'Guest Capacity') ?></span></div>
      <div class="stat reveal"><b>10+</b><span><?= t('Destinasi Komodo', 'Komodo Destinations') ?></span></div>
      <div class="stat reveal"><b>8,31 m</b><span><?= t('Speedboat Fiberglass', 'Fiberglass Speedboat') ?></span></div>
      <div class="stat reveal"><b>4</b><span><?= t('Pilihan Trip', 'Trip Options') ?></span></div>
    </div>
  </div>
</section>

<!-- ============ GALLERY PREVIEW ============ -->
<section class="section">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?= t('Galeri', 'Gallery') ?></span>
      <h2><?= t('Sekilas Keindahan Komodo', 'A Glimpse of Komodo\'s Beauty') ?></h2>
    </div>
    <div class="masonry" data-async="<?= base_url('home/section/gallery') ?>">
      <?php $heights = [180, 240, 200, 280, 210, 250, 190, 230]; ?>
      <?php foreach ($heights as $h): ?>
        <span class="sk sk-tile" style="height:<?= $h ?>px" aria-hidden="true"></span>
      <?php endforeach ?>
    </div>
    <div class="center" style="margin-top:1.5rem">
      <a href="<?= base_url('gallery') ?>" class="btn btn--outline"><?= t('Lihat Galeri Lengkap', 'View Full Gallery') ?></a>
    </div>
  </div>
</section>

<!-- ============ ARTICLES PREVIEW ============ -->
<section class="section section--sand" data-async-section>
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?= t('Artikel', 'Articles') ?></span>
      <h2><?= t('Tips & Panduan Wisata', 'Travel Tips & Guides') ?></h2>
    </div>
    <div class="grid grid--3" data-async="<?= base_url('home/section/articles') ?>" data-hide-empty>
      <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="card sk-card" aria-hidden="true">
          <div class="sk sk-media"></div>
          <div class="card__body">
            <div class="sk sk-line sk-line--sm"></div>
            <div class="sk sk-line sk-line--lg"></div>
            <div class="sk sk-line"></div>
            <div class="sk sk-line sk-line--80"></div>
            <div class="sk sk-btn"></div>
          </div>
        </div>
      <?php endfor ?>
    </div>
  </div>
</section>

<!-- ============ VIDEO / REELS ============ -->
<section class="section">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?= t('Video', 'Video') ?></span>
      <h2><?= t('Cuplikan Perjalanan Bersama Kami', 'Moments from Our Trips') ?></h2>
      <p><?= t('Intip keseruan trip Komodo langsung dari kamera kami.', 'A peek into the fun of our Komodo trips, straight from our camera.') ?></p>
    </div>
    <div class="reels">
      <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="reel reveal">
          <video class="reel__video" preload="metadata" playsinline loop muted>
            <source src="<?= base_url('assets/video/reel-' . $i . '.mp4') ?>#t=0.5" type="video/mp4">
          </video>
          <button class="reel__play" type="button" aria-label="<?= t('Putar video', 'Play video') ?>"></button>
        </div>
      <?php endfor ?>
    </div>
    <div class="center" style="margin-top:1.6rem">
      <a href="<?= esc(setting('instagram', 'https://instagram.com/intawaanatour')) ?>" target="_blank" rel="noopener" class="btn btn--outline"><?= t('Lihat Lebih Banyak di Instagram', 'See More on Instagram') ?></a>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="cta-band section">
  <div class="cta-band__bg"><img src="<?= base_url('assets/img/gal-sunset.jpg') ?>" alt="Sunset"></div>
  <div class="container">
    <h2><?= t('Siap Berlayar Bersama Kami?', 'Ready to Sail with Us?') ?></h2>
    <p><?= t('Hubungi tim kami sekarang untuk reservasi atau pertanyaan. Kami siap membantu mewujudkan liburan impian Anda.', 'Contact our team now for reservations or questions. We are ready to help make your dream holiday come true.') ?></p>
    <a href="<?= wa_link() ?>" class="btn btn--primary" target="_blank" rel="noopener"><?= t('Pesan via WhatsApp', 'Book via WhatsApp') ?></a>
  </div>
</section>

<?= $this->endSection() ?>
