<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="<?= base_url('/') ?>" class="brand">
          <img class="brand__logo" src="<?= base_url('assets/img/logo-mark.png') ?>" alt="<?= esc(setting('site_name', 'Inta Waana Tour')) ?>" width="44" height="44">
          <span class="brand__name"><?= esc(setting('site_name', 'Inta Waana Tour')) ?></span>
        </a>
        <p><?= t(
            'Sewa speedboat private &amp; shared trip Labuan Bajo untuk menjelajahi keindahan Taman Nasional Komodo dengan nyaman dan berkelas.',
            'Private &amp; shared speedboat trips in Labuan Bajo to explore the beauty of Komodo National Park in comfort and style.'
        ) ?></p>
        <div class="socials">
          <?php if (setting('instagram')): ?>
            <a href="<?= esc(setting('instagram')) ?>" target="_blank" rel="noopener" aria-label="Instagram">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5.5"/><circle cx="12" cy="12" r="4.3"/><circle cx="17.6" cy="6.4" r="1.2" fill="currentColor" stroke="none"/></svg>
            </a>
          <?php endif ?>
          <?php if (setting('facebook')): ?>
            <a href="<?= esc(setting('facebook')) ?>" target="_blank" rel="noopener" aria-label="Facebook">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5 3.66 9.15 8.44 9.94v-7.03H7.9v-2.9h2.54V9.85c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46H15.2c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.9h-2.34V22c4.78-.79 8.43-4.94 8.43-9.94z"/></svg>
            </a>
          <?php endif ?>
          <a href="<?= wa_link() ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
            <svg viewBox="0 0 32 32" fill="currentColor"><path d="M16 .5C7.4.5.5 7.4.5 16c0 2.8.8 5.5 2.1 7.9L.5 31.5l7.8-2c2.3 1.2 4.9 1.9 7.7 1.9 8.6 0 15.5-6.9 15.5-15.5S24.6.5 16 .5zm0 28.2c-2.5 0-4.9-.7-7-1.9l-.5-.3-4.6 1.2 1.2-4.5-.3-.5c-1.4-2.2-2.1-4.7-2.1-7.2C2.6 8.6 8.6 2.7 16 2.7c7.3 0 13.3 6 13.3 13.3S23.3 28.7 16 28.7zm7.3-9.9c-.4-.2-2.4-1.2-2.7-1.3-.4-.1-.6-.2-.9.2-.3.4-1 1.3-1.3 1.6-.2.2-.5.3-.9.1-2.4-1.2-3.9-2.1-5.5-4.8-.4-.7.4-.6 1.2-2.2.1-.3.1-.5 0-.7-.1-.2-.9-2.1-1.2-2.9-.3-.8-.6-.7-.9-.7h-.8c-.3 0-.7.1-1.1.5-.4.4-1.4 1.4-1.4 3.4s1.5 3.9 1.7 4.2c.2.3 2.9 4.5 7.1 6.3 2.6 1.1 3.7 1.2 5 1 .8-.1 2.4-1 2.7-1.9.3-.9.3-1.8.2-1.9-.1-.2-.4-.3-.8-.5z"/></svg>
          </a>
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
          <li><a href="<?= base_url('trips/private-full-day-sailing') ?>">Private Full Day Sailing</a></li>
          <li><a href="<?= base_url('trips/private-sunset-trip') ?>">Private Sunset Trip</a></li>
          <li><a href="<?= base_url('trips/open-trip-full-day-sailing') ?>">Open Trip Full Day</a></li>
          <li><a href="<?= base_url('trips/open-trip-sunset') ?>">Open Trip Sunset</a></li>
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
      <span>&copy; <?= date('Y') ?> <?= esc(setting('site_name', 'Inta Waana Tour')) ?>. <?= t('Hak cipta dilindungi.', 'All rights reserved.') ?></span>
      <span><?= t('Dibuat dengan ❤️ untuk Labuan Bajo', 'Made with ❤️ for Labuan Bajo') ?></span>
    </div>
  </div>
</footer>
