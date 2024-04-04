
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styledisplay.css">
<style>body{background-color: #FFC0CB;}</style>
</head>
<body>
<?php
require_once 'DatabaseConnection.php';
require_once 'ArticleManager.php';
require_once 'Article.php';
require_once 'displayArticleGrid.php';

$dbConnection = new DatabaseConnection("localhost", "root","", "girlhood");
  $articleManager = new ArticleManager($dbConnection);

// Récupérer la valeur de l'input du formulaire
$search = $_POST['search'];

// Requête SQL pour rechercher dans la base de données
$query= "SELECT * FROM article WHERE description LIKE '%${search}%' OR  name LIKE '%${search}%'";

$articles = $articleManager->getArticles($query);
displayArticleGrid($articles);

$dbConnection->close();
?>
</body>
</html>
