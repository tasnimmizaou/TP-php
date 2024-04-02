<?php

function displayArticleGrid($articles) {
  $articleCount = 0;
  ?>
  <div class="container">
    <?php foreach ($articles as $article): ?>
      <?php if ($articleCount % 3 === 0): ?>
        <div class="row">
      <?php endif; ?>
      <div class="column">
        <h2><?= $article->name ?></h2>
        <img src="<?= $article->getImageDataUrl() ?>" alt="<?= $article->name ?>" class="img-responsive" />
        <p>Prix : <?= $article->getFormattedPrice() ?></p>
        <a href="<?= $article->getDetailsUrl() ?>">Voir les détails</a>
      </div>
      <?php $articleCount++; ?>
      <?php if ($articleCount % 3 === 0): ?>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php

};
?>
