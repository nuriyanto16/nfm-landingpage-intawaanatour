<?php foreach ($featured as $trip): ?>
  <?= partial('partials/trip_card', ['trip' => $trip]) ?>
<?php endforeach ?>
