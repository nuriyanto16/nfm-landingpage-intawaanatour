<?php
// Spesifikasi resmi Speedboat "INTA WAANA" (sumber: dokumen KSOP Kelas III Labuan Bajo).
$specs = [
    [t('Nama Kapal', 'Ship Name'), 'INTA WAANA'],
    [t('Tanda Pas Kecil', 'Registration Mark'), 'NTT 10 No. 2191'],
    [t('Jenis', 'Type'), t('Kapal Penumpang Wisata', 'Recreational Passenger Boat')],
    [t('Bahan Lambung', 'Hull Material'), t('Fiberglass', 'Fiberglass')],
    [t('Dimensi (P × L × D)', 'Dimensions (L × W × D)'), '8,31 × 2,55 × 1,10 m'],
    [t('Tonase', 'Tonnage'), 'GT 6 / NT 2'],
    [t('Mesin', 'Engine'), 'Suzuki 2 × 100 HP'],
    [t('Kapasitas', 'Capacity'), t('Hingga 9 tamu', 'Up to 9 guests')],
    [t('Fasilitas', 'Facilities'), t('Kabin ber-AC, toilet, geladak bersantai', 'AC cabin, toilet, lounge deck')],
    [t('Dibangun di', 'Built in'), t('Labuan Bajo, 2025–2026', 'Labuan Bajo, 2025–2026')],
];
?>
<div class="boat-spec reveal">
  <div class="boat-spec__head">
    <span class="eyebrow"><?= t('Armada Kami', 'Our Fleet') ?></span>
    <h2><?= t('Spesifikasi Speedboat Inta Waana', 'Inta Waana Speedboat Specifications') ?></h2>
    <p class="muted"><?= t(
        'Terdaftar resmi pada KSOP Kelas III Labuan Bajo dan berhak mengibarkan bendera Indonesia. Dirancang untuk perjalanan yang cepat, aman, dan nyaman.',
        'Officially registered with KSOP Class III Labuan Bajo and entitled to fly the Indonesian flag. Built for fast, safe, and comfortable journeys.'
    ) ?></p>
  </div>
  <div class="boat-spec__grid">
    <div class="boat-spec__media">
      <img src="<?= base_url('assets/img/boat-profile.jpg') ?>" alt="<?= t('Speedboat Inta Waana', 'Inta Waana Speedboat') ?>" loading="lazy">
    </div>
    <table class="spec-table">
      <tbody>
        <?php foreach ($specs as $row): ?>
          <tr><th scope="row"><?= esc($row[0]) ?></th><td><?= esc($row[1]) ?></td></tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
