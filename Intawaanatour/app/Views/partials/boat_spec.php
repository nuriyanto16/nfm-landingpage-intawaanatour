<?php
// Spesifikasi resmi Speedboat "INTA WAANA" (sumber: dokumen KSOP Kelas III Labuan
// Bajo + brosur resmi). Galeri foto: FOTO SPEEDBOAT (materi GUEST INFORMATION).
$photos = [
    ['about-1.jpg', t('Tampak udara Speedboat Inta Waana', 'Aerial view of Inta Waana Speedboat')],
    ['about-2.jpg', t('Speedboat Inta Waana di perairan Komodo', 'Inta Waana Speedboat in Komodo waters')],
    ['about-4.jpg', t('Speedboat Inta Waana bersandar di pulau', 'Inta Waana Speedboat anchored by an island')],
    ['about-5.jpg', t('Perjalanan bersama Inta Waana', 'Cruising with Inta Waana')],
    ['about-6.jpg', t('Momen trip Inta Waana', 'Inta Waana trip moments')],
    ['about-8.jpg', t('Speedboat Inta Waana', 'Inta Waana Speedboat')],
    ['about-3.jpg', t('Detail Speedboat Inta Waana', 'Inta Waana Speedboat detail')],
    ['about-7.jpg', t('Speedboat Inta Waana siap berlayar', 'Inta Waana Speedboat ready to sail')],
];

$overall = [
    [t('Nama Kapal', 'Ship Name'), 'INTA WAANA'],
    [t('Tanda Pas Kecil', 'Registration Mark'), 'NTT 10 No. 2191'],
    [t('Jenis', 'Type'), t('Kapal Penumpang Wisata', 'Recreational Passenger Boat')],
    [t('Bahan Lambung', 'Hull Material'), t('Fiberglass', 'Fiberglass')],
    [t('Dimensi (P × L × D)', 'Dimensions (L × W × D)'), '8,31 × 2,55 × 1,10 m'],
    [t('Tonase', 'Tonnage'), 'GT 6 / NT 2'],
    [t('Mesin', 'Engine'), t('Mesin tempel ganda · 2 unit', 'Twin outboard engines · 2 units')],
    [t('Kapasitas', 'Capacity'), t('Hingga 9 tamu + kru', 'Up to 9 guests + crew')],
    [t('Dibangun', 'Built'), t('Labuan Bajo, 2025–2026', 'Labuan Bajo, 2025–2026')],
];

$nav = t(
    'Life jacket untuk seluruh tamu, perlengkapan keselamatan standar pelayaran, serta kapten & kru profesional bersertifikat yang mengutamakan keselamatan Anda di setiap perjalanan.',
    'Life jackets for all guests, standard maritime safety equipment, and a certified professional captain & crew who put your safety first on every trip.'
);

$facil = t(
    'Kabin ber-AC, area kemudi, geladak haluan untuk berjemur, geladak buritan untuk bersantai, toilet, perlengkapan snorkeling (mask, snorkel, fin), dan dokumentasi perjalanan.',
    'Air-conditioned cabin, helm area, bow deck for sunbathing, aft lounge deck, toilet, snorkeling gear (mask, snorkel, fins), and trip documentation.'
);
?>
<div class="boat-spec reveal">
  <div class="boat-spec__head">
    <span class="eyebrow"><?= t('Armada Kami', 'Our Fleet') ?></span>
    <h2><?= t('Spesifikasi Speedboat Inta Waana', 'Inta Waana Speedboat Specifications') ?></h2>
    <p class="muted"><?= t(
        'Terdaftar resmi pada KSOP Kelas III Labuan Bajo dan berhak mengibarkan bendera Indonesia. Dirancang untuk perjalanan yang cepat, aman, dan nyaman menjelajahi Taman Nasional Komodo.',
        'Officially registered with KSOP Class III Labuan Bajo and entitled to fly the Indonesian flag. Built for fast, safe, and comfortable journeys across Komodo National Park.'
    ) ?></p>
  </div>

  <!-- Galeri foto speedboat (slider) -->
  <div class="boat-slider" data-carousel data-interval="5000">
    <div class="boat-slider__track">
      <?php foreach ($photos as $idx => $p): ?>
        <figure class="boat-slider__slide<?= $idx === 0 ? ' is-active' : '' ?>">
          <img src="<?= base_url('assets/img/' . $p[0]) ?>" alt="<?= esc($p[1]) ?>" loading="lazy" width="1280" height="800">
        </figure>
      <?php endforeach ?>
    </div>
    <button class="boat-slider__nav boat-slider__nav--prev" type="button" data-carousel-prev aria-label="<?= t('Sebelumnya', 'Previous') ?>">‹</button>
    <button class="boat-slider__nav boat-slider__nav--next" type="button" data-carousel-next aria-label="<?= t('Berikutnya', 'Next') ?>">›</button>
    <div class="boat-slider__dots" data-carousel-dots></div>
  </div>

  <!-- Spesifikasi -->
  <div class="spec-blocks">
    <div class="spec-block">
      <h3><?= t('Spesifikasi Kapal', 'Boat Specifications') ?></h3>
      <table class="spec-table">
        <tbody>
          <?php foreach ($overall as $row): ?>
            <tr><th scope="row"><?= esc($row[0]) ?></th><td><?= esc($row[1]) ?></td></tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <div class="spec-block">
      <div class="spec-info">
        <h3><?= t('Navigasi & Keselamatan', 'Navigation & Safety') ?></h3>
        <p class="muted"><?= esc($nav) ?></p>
      </div>
      <div class="spec-info">
        <h3><?= t('Fasilitas', 'Facilities') ?></h3>
        <p class="muted"><?= esc($facil) ?></p>
      </div>
    </div>
  </div>
</div>
