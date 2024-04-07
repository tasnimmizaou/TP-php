
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../affichage/styledisplay.css">
<style>body{background-color: #FFC0CB;}</style>
</head>
<body>
<?php
require_once '../commun/connexionBD.php';
require_once '../commun/ArticleManager.php';
require_once '../commun/Product.php';
require_once '../affichage/displayArticleGrid.php';

//$dbConnection = new connexionBD("localhost", "root","", "girlhood");
 // $articleManager = new ArticleManager($dbConnection);
 $articleManager=new ArticleManager();

// Récupérer la valeur de l'input du formulaire
$search = $_POST['search'];

// Requête SQL pour rechercher dans la base de données
$query = "SELECT * FROM article WHERE description LIKE :search OR name LIKE :search";
$params = array(':search' => "%$search%");

$articles = $articleManager->getArticles($query, $params);
displayArticleGrid($articles);

//$dbConnection->close();
?>
</body>
</html>
