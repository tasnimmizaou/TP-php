<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="..\affichage\styledisplay.css">
</head>
<body>
<?php

require_once('..\commun\connexionBD.php');
require_once('..\commun\Product.php');
require_once('..\commun\ArticleManager.php');
require('..\affichage\displayArticleGrid.php');
// Create an instance of ArticleManager
$articleManager = new ArticleManager();

// Define your SQL query
$sql = "SELECT * FROM article";

// Fetch articles using the query and ArticleManager
$articles = $articleManager->getAllArticles();

// Display articles using displayArticleGrid function
displayArticleGrid($articles);

?>
</body>
</html>

