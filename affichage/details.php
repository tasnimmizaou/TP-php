<?php

require_once('../commun/ArticleManager.php');
require_once('../commun/Product.php');
require_once('../cart/back_end/add_to_cart.php');
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


    <h2>Ajouter au panier</h2>
  <form action="../cart/back_end/add_to_cart.php?article_id=<?= $article->getId() ?>" method="post"> 
        <label for="quantity">Quantité:</label>
        <input type="number" id="quantity" name="quantity" min="1" max="<?= $article->getStock() ?>" value="1" required>
        <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
        <button type="submit">Ajouter au panier</button>

    </form>

    </div>

</body>
</html>
