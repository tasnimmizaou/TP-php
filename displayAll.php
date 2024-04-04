<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styledisplay.css">
</head>
<body>
<?php

require_once('DatabaseConnection.php');
require_once('Article.php');
require_once('ArticleManager.php');
require('displayArticleGrid.php');
// Create an instance of ArticleManager
$articleManager = new ArticleManager();

// Define your SQL query
$sql = "SELECT * FROM article";

// Fetch articles using the query and ArticleManager
$articles = $articleManager->getArticles($sql);

// Display articles using displayArticleGrid function
displayArticleGrid($articles);
?>
</body>
</html>

