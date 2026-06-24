<?php
/**
 * Kartu dokumentasi destinasi per trip.
 * Pemanggilan: partial('partials/destinations', ['keys' => ['padar','pink-beach',...]])
 */
$catalog = [
    'padar' => [
        'Pulau Padar', 'assets/img/gal-padar.jpg',
        'Ikon Taman Nasional Komodo — dari puncak bukitnya terbentang panorama tiga teluk berpasir berbeda warna, spot foto paling legendaris di Labuan Bajo.',
        'The icon of Komodo National Park — its hilltop reveals a legendary panorama of three crescent bays with differently colored sand.',
    ],
    'pink-beach' => [
        'Pink Beach (Pantai Merah)', 'assets/img/gal-pinkbeach.jpg',
        'Pantai berpasir merah muda langka yang terbentuk dari serpihan koral, dengan air jernih kaya terumbu — surga untuk snorkeling dan berjemur.',
        'A rare pink-sand beach formed from red coral fragments, with crystal-clear, reef-rich water — a paradise for snorkeling and sunbathing.',
    ],
    'komodo' => [
        'Pulau Komodo', 'assets/img/gal-komodo.jpg',
        'Rumah bagi komodo, kadal raksasa purba terakhir di dunia, yang dapat Anda saksikan langsung ditemani ranger berpengalaman.',
        'Home to the Komodo dragon, the world\'s last giant ancient lizard, witnessed up close accompanied by experienced rangers.',
    ],
    'taka-makasar' => [
        'Taka Makasar', 'assets/img/gal-taka.jpg',
        'Gosong pasir putih berbentuk bulan sabit yang muncul di tengah laut toska — pemandangan magis untuk berenang dan berfoto.',
        'A crescent-shaped white sandbar emerging amid turquoise waters — a magical vista to swim and take photos.',
    ],
    'manta-point' => [
        'Manta Point', 'assets/img/gal-manta.jpg',
        'Spot snorkeling terbaik untuk berenang berdampingan dengan pari manta raksasa yang anggun di habitat aslinya.',
        'The premier snorkeling spot to swim alongside graceful giant manta rays in their natural habitat.',
    ],
    'siaba' => [
        'Pulau Siaba / Mawang', 'assets/img/gal-snorkel.jpg',
        'Perairan tenang dengan taman terumbu karang berwarna-warni dan penyu hijau — surga snorkeling untuk semua kalangan.',
        'Calm waters with colorful coral gardens and green turtles — a snorkeling paradise for everyone.',
    ],
    'kelor' => [
        'Pulau Kelor', 'assets/img/gal-kelor.jpg',
        'Pulau mungil berbukit hijau dengan pantai pasir putih dan air jernih, ideal untuk trekking ringan dan berenang.',
        'A small island with green hills, a white-sand beach and clear water, ideal for a light trek and a swim.',
    ],
    'menjerite' => [
        'Pantai Menjerite', 'assets/img/boat-island.jpg',
        'Teluk tersembunyi berair jernih dengan terumbu karang dangkal yang memesona untuk snorkeling santai.',
        'A hidden bay with clear water and stunning shallow reefs for relaxed snorkeling.',
    ],
    'rinca' => [
        'Pulau Rinca', 'assets/img/gal-komodo.jpg',
        'Lokasi alternatif melihat komodo di alam liar dengan lanskap savana dramatis dan satwa endemik.',
        'An alternative spot to see Komodo dragons in the wild amid dramatic savanna landscapes and endemic wildlife.',
    ],
    'kalong' => [
        'Pulau Kalong', 'assets/img/gal-sunset.jpg',
        'Saksikan ribuan kelelawar terbang keluar dari hutan bakau saat senja — penutup sempurna berlatar langit jingga.',
        'Watch thousands of flying foxes stream out of the mangroves at dusk — the perfect finale against an orange sky.',
    ],
];
$keys = array_filter($keys ?? [], static fn ($k) => isset($catalog[$k]));
if (! $keys) {
    return;
}
?>
<div class="dest-head reveal">
  <span class="eyebrow"><?= t('Destinasi', 'Destinations') ?></span>
  <h2><?= t('Tempat yang Akan Anda Kunjungi', 'Places You Will Visit') ?></h2>
</div>
<div class="dest-grid">
  <?php foreach ($keys as $k): [$name, $img, $dId, $dEn] = $catalog[$k]; ?>
    <article class="dest-card reveal">
      <div class="dest-card__media">
        <img src="<?= base_url($img) ?>" alt="<?= esc($name) ?>" loading="lazy" width="800" height="600">
      </div>
      <div class="dest-card__body">
        <h3><?= esc($name) ?></h3>
        <p class="muted"><?= esc(t($dId, $dEn)) ?></p>
      </div>
    </article>
  <?php endforeach ?>
</div>
