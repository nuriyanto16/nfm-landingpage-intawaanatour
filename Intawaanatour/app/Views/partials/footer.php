<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="<?= base_url('/') ?>" class="brand">
          <img class="brand__logo" src="<?= base_url('assets/img/logo-mark.png') ?>" alt="<?= esc(setting('site_name', 'Intawaanatour')) ?>" width="44" height="44">
          <span class="brand__name"><?= esc(setting('site_name', 'Intawaanatour')) ?></span>
        </a>
        <p><?= t(
            'Sewa speedboat private &amp; shared trip Labuan Bajo untuk menjelajahi keindahan Taman Nasional Komodo dengan nyaman dan berkelas.',
            'Private &amp; shared speedboat trips in Labuan Bajo to explore the beauty of Komodo National Park in comfort and style.'
        ) ?></p>
        <div class="socials">
          <?php if (setting('instagram')): ?><a href="<?= esc(setting('instagram')) ?>" target="_blank" rel="noopener" aria-label="Instagram">IG</a><?php endif ?>
          <?php if (setting('facebook')): ?><a href="<?= esc(setting('facebook')) ?>" target="_blank" rel="noopener" aria-label="Facebook">FB</a><?php endif ?>
          <a href="<?= wa_link() ?>" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>
        </div>
      </div>

      <div>
        <h4><?= t('Jelajahi', 'Explore') ?></h4>
        <ul class="footer-links">
          <li><a href="<?= base_url('trips') ?>"><?= t('Paket Trip', 'Trips') ?></a></li>
          <li><a href="<?= base_url('gallery') ?>"><?= t('Galeri', 'Gallery') ?></a></li>
          <li><a href="<?= base_url('articles') ?>"><?= t('Artikel', 'Articles') ?></a></li>
          <li><a href="<?= base_url('about') ?>"><?= t('Tentang Kami', 'About Us') ?></a></li>
        </ul>
      </div>

      <div>
        <h4><?= t('Paket Populer', 'Popular') ?></h4>
        <ul class="footer-links">
          <li><a href="<?= base_url('trips/private-day-trip-komodo') ?>">Private Day Trip</a></li>
          <li><a href="<?= base_url('trips/shared-trip-komodo') ?>">Shared Trip</a></li>
          <li><a href="<?= base_url('trips/sunset-trip-labuan-bajo') ?>">Sunset Trip</a></li>
          <li><a href="<?= base_url('contact') ?>"><?= t('Custom Trip', 'Custom Trip') ?></a></li>
        </ul>
      </div>

      <div>
        <h4><?= t('Kontak', 'Contact') ?></h4>
        <ul class="footer-links">
          <li>📍 <?= esc(setting('address')) ?></li>
          <li>📞 <a href="tel:<?= esc(preg_replace('/[^0-9+]/', '', setting('phone'))) ?>"><?= esc(setting('phone')) ?></a></li>
          <li>✉️ <a href="mailto:<?= esc(setting('email')) ?>"><?= esc(setting('email')) ?></a></li>
          <li>🕒 <?= esc(setting('operating_hours')) ?></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <span>&copy; <?= date('Y') ?> <?= esc(setting('site_name', 'Intawaanatour')) ?>. <?= t('Hak cipta dilindungi.', 'All rights reserved.') ?></span>
      <span><?= t('Dibuat dengan ❤️ untuk Labuan Bajo', 'Made with ❤️ for Labuan Bajo') ?></span>
    </div>
  </div>
</footer>
