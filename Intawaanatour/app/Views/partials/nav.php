<?php $loc = locale(); ?>
<header class="site-header">
  <div class="container nav">
    <a href="<?= base_url('/') ?>" class="brand">
      <img class="brand__logo" src="<?= base_url('assets/img/logo-mark.png') ?>" alt="<?= esc(setting('site_name', 'Inta Waana Tour')) ?>" width="44" height="44">
      <span class="brand__name"><?= esc(setting('site_name', 'Inta Waana Tour')) ?>
        <small><?= t('Speedboat Labuan Bajo · Komodo', 'Labuan Bajo · Komodo Speedboat') ?></small>
      </span>
    </a>

    <ul class="nav-menu">
      <li><a class="<?= active_menu('/') ?>" href="<?= base_url('/') ?>"><?= t('Beranda', 'Home') ?></a></li>
      <li><a class="<?= active_menu('trips') ?>" href="<?= base_url('trips') ?>"><?= t('Paket Trip', 'Trips') ?></a></li>
      <li><a class="<?= active_menu('gallery') ?>" href="<?= base_url('gallery') ?>"><?= t('Galeri', 'Gallery') ?></a></li>
      <li><a class="<?= active_menu('articles') ?>" href="<?= base_url('articles') ?>"><?= t('Artikel', 'Articles') ?></a></li>
      <li><a class="<?= active_menu('about') ?>" href="<?= base_url('about') ?>"><?= t('Tentang', 'About') ?></a></li>
      <li><a class="<?= active_menu('contact') ?>" href="<?= base_url('contact') ?>"><?= t('Kontak', 'Contact') ?></a></li>
      <li class="lang-switch">
        <a class="<?= $loc === 'id' ? 'on' : '' ?>" href="<?= base_url('lang/id') ?>">ID</a>
        <a class="<?= $loc === 'en' ? 'on' : '' ?>" href="<?= base_url('lang/en') ?>">EN</a>
      </li>
      <li class="nav-cta"><a href="<?= base_url('trips') ?>" class="btn btn--primary btn--sm"><?= t('Pesan Sekarang', 'Book Now') ?></a></li>
    </ul>

    <div class="nav-actions">
      <a href="<?= base_url('trips') ?>" class="btn btn--primary btn--sm"><?= t('Pesan Sekarang', 'Book Now') ?></a>
      <button class="nav-toggle" aria-label="Menu"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>
