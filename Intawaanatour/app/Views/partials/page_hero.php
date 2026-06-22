<section class="page-hero">
  <div class="page-hero__bg"><img src="<?= base_url('assets/img/' . ($bg ?? 'hero.jpg')) ?>" alt="<?= esc($title) ?>"></div>
  <div class="container">
    <nav class="breadcrumb">
      <a href="<?= base_url('/') ?>"><?= t('Beranda', 'Home') ?></a> / <span><?= esc($title) ?></span>
    </nav>
    <h1><?= esc($title) ?></h1>
    <?php if (! empty($subtitle)): ?><p class="muted" style="color:rgba(255,255,255,.85);max-width:620px;margin:0 auto"><?= esc($subtitle) ?></p><?php endif ?>
  </div>
</section>
