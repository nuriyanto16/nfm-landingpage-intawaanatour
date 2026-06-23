<article class="card reveal">
  <a href="<?= base_url('articles/' . $a['slug']) ?>" class="card__media post__media">
    <img src="<?= img_url($a['cover_image']) ?>" alt="<?= esc(tr($a, 'title')) ?>" loading="lazy" width="1200" height="800">
  </a>
  <div class="card__body">
    <span class="post__date"><?= date('d M Y', strtotime($a['published_at'] ?? $a['created_at'])) ?></span>
    <h3 style="margin-top:.4rem"><a href="<?= base_url('articles/' . $a['slug']) ?>"><?= esc(tr($a, 'title')) ?></a></h3>
    <p class="muted"><?= esc(character_limiter(tr($a, 'excerpt'), 110, '…')) ?></p>
    <div class="card__foot">
      <a href="<?= base_url('articles/' . $a['slug']) ?>" class="btn btn--outline btn--sm"><?= t('Baca Selengkapnya', 'Read More') ?> →</a>
    </div>
  </div>
</article>
