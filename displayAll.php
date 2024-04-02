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

$db = new DatabaseConnection('localhost', 'root', '', 'girlhood'); // Update credentials if needed
$articleManager = new ArticleManager($db);

$articles = $articleManager->getAllArticles();
displayArticleGrid($articles);

$db->close();
?>
</body>
</html>

