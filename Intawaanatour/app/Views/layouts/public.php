<!DOCTYPE html>
<html lang="<?= locale() ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->include('partials/seo_head') ?>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <link rel="icon" href="<?= base_url('assets/img/favicon.ico') ?>" sizes="any">
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon-32.png') ?>" sizes="32x32">
  <link rel="apple-touch-icon" href="<?= base_url('assets/img/apple-touch-icon.png') ?>">
</head>
<body>
  <?= $this->include('partials/nav') ?>

  <main>
    <?= $this->renderSection('content') ?>
  </main>

  <?= $this->include('partials/footer') ?>

  <a class="wa-float" href="<?= wa_link(t('Halo Intawaanatour, saya ingin bertanya tentang trip Labuan Bajo.', 'Hi Intawaanatour, I would like to ask about Labuan Bajo trips.')) ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
    <svg viewBox="0 0 32 32" fill="currentColor"><path d="M16 .5C7.4.5.5 7.4.5 16c0 2.8.8 5.5 2.1 7.9L.5 31.5l7.8-2c2.3 1.2 4.9 1.9 7.7 1.9 8.6 0 15.5-6.9 15.5-15.5S24.6.5 16 .5zm0 28.2c-2.5 0-4.9-.7-7-1.9l-.5-.3-4.6 1.2 1.2-4.5-.3-.5c-1.4-2.2-2.1-4.7-2.1-7.2C2.6 8.6 8.6 2.7 16 2.7c7.3 0 13.3 6 13.3 13.3S23.3 28.7 16 28.7zm7.3-9.9c-.4-.2-2.4-1.2-2.7-1.3-.4-.1-.6-.2-.9.2-.3.4-1 1.3-1.3 1.6-.2.2-.5.3-.9.1-2.4-1.2-3.9-2.1-5.5-4.8-.4-.7.4-.6 1.2-2.2.1-.3.1-.5 0-.7-.1-.2-.9-2.1-1.2-2.9-.3-.8-.6-.7-.9-.7h-.8c-.3 0-.7.1-1.1.5-.4.4-1.4 1.4-1.4 3.4s1.5 3.9 1.7 4.2c.2.3 2.9 4.5 7.1 6.3 2.6 1.1 3.7 1.2 5 1 .8-.1 2.4-1 2.7-1.9.3-.9.3-1.8.2-1.9-.1-.2-.4-.3-.8-.5z"/></svg>
  </a>

  <script src="<?= base_url('assets/js/main.js') ?>" defer></script>
</body>
</html>
