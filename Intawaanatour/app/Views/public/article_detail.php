<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?= partial('partials/page_hero', [
    'title' => tr($article, 'title'),
    'bg'    => 'art-hero.jpg',
]) ?>

<section class="section">
  <div class="container" style="max-width:820px">
    <p class="post__date"><?= date('d F Y', strtotime($article['published_at'] ?? $article['created_at'])) ?> · <?= esc($article['author']) ?></p>
    <img src="<?= img_url($article['cover_image']) ?>" alt="<?= esc(tr($article, 'title')) ?>" style="border-radius:var(--radius);margin:1rem 0 2rem;width:100%;aspect-ratio:16/9;object-fit:cover">

    <div class="article-body">
      <?= tr($article, 'content') ?>
    </div>

    <div style="margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid var(--line)">
      <a href="<?= base_url('articles') ?>" class="btn btn--outline btn--sm">← <?= t('Kembali ke Artikel', 'Back to Articles') ?></a>
    </div>
  </div>
</section>

<?php if (! empty($related)): ?>
<section class="section section--sand">
  <div class="container">
    <div class="section-head center"><h2><?= t('Artikel Lainnya', 'More Articles') ?></h2></div>
    <div class="grid grid--2" style="max-width:820px;margin:0 auto">
      <?php foreach ($related as $a): ?>
        <?= partial('partials/article_card', ['a' => $a]) ?>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<?= $this->endSection() ?>
