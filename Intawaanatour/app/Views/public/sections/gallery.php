<?php foreach ($gallery as $g): ?>
  <a href="<?= img_url($g['image_path']) ?>" data-lightbox data-title="<?= esc($g['title']) ?>">
    <img src="<?= img_url($g['image_path']) ?>" alt="<?= esc($g['title']) ?>" loading="lazy">
  </a>
<?php endforeach ?>
