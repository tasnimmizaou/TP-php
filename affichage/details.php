<?php

require_once('../commun/ArticleManager.php');
require_once('../commun/Product.php');

$articleId = $_GET['id']; // Get article ID from URL parameter
$articleManager = new ArticleManager(); // Create ArticleManager instance
$articles = $articleManager->getarticlebyid($articleId); // Fetch article details

if (empty($articles)) {
    // Handle error if article not found
    die("Article not found");
}

$article = $articles[0]; // Get the first article from the array

?>

<!DOCTYPE html>
<html>
<head>
    <title>details</title>
    <link rel="stylesheet" href="styledetails.css" >
</head>
<body>
<div class="container">
<h1><?= $article->getName() ?></h1>
    <img src="<?= $article->getImageDataUrl() ?>" alt="<?= $article->getName() ?>" />
    <p><?= $article->getDescription() ?></p>
    <h4>Prix: <?= $article->getFormattedPrice() ?></h4>


    <h2>Acheter</h2>
  <form id="add_to_cart" action="../shopping_cart/add_to_cart.php?article_id=<?= $article->getId() ?>" method="post">
        <label for="quantity">Quantité:</label>
        <input type="number" id="quantity" name="quantity" min="1" max="<?= $article->getStock() ?>" value="1" required>
        <input type="hidden" name="product_id" value="<?= $article->getId() ?>">
        <button type="submit"><a href="../shopping_cart/index_cart.php">jouter au panier</a></button>
</form>

</div>

</body>
</html>
