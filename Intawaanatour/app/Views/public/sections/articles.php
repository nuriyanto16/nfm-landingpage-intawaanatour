<?php foreach ($articles as $a): ?>
  <?= partial('partials/article_card', ['a' => $a]) ?>
<?php endforeach ?>
