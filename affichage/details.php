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
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    color: #FFFFFF;
    text-align: center;
}

h2 {
    color: #fff; /* Texte lumineux */
    background-color: #45a049; /* Fond foncé pour contraste */
    padding: 10px;
    border-radius: 5px;
    width: 200px;
    text-align: center;
}

img {
    display: block;
    margin: 0 auto; /* Centrer l'image */
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
}
h4 {
    color: #FFFFFF;
    line-height: 1.5;
    text-align: center; /* Centrer le paragraphe */
    font-size: 1.2em; /* Taille de police plus grande */
}

p {
    color: #666;
    line-height: 1.5;
    text-align: center; /* Centrer le paragraphe */
    font-size: 1.2em; /* Taille de police plus grande */
}

form {
    
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="number"] {
    width: 100px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
<div class="container">
<h1><?= $article->getName() ?></h1>
    <img src="<?= $article->getImageDataUrl() ?>" alt="<?= $article->getName() ?>" />
    <p><?= $article->getDescription() ?></p>
    <h4>Prix: <?= $article->getFormattedPrice() ?></h4>


    <h2>Ajouter au panier</h2>
  <form action="add_to_cart.php?article_id=<?= $article->id ?>" method="post"> 
        <label for="quantity">Quantité:</label>
        <input type="number" id="quantity" name="quantity" min="1" max="<?= $article->stock ?>" value="1" required>
        <input type="hidden" name="article_id" value="<?= $article->id ?>">
        <button type="submit" action ="add_to_cart.php">Ajouter au panier</button>
    </form>

    </div>

</body>
</html>
