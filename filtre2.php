<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styledisplay.css">
</head>
<body>
  
<?php


require_once('ArticleManager.php');
require_once('DatabaseConnection.php');
require_once('Article.php');
require_once('displayArticleGrid.php');

$db = new DatabaseConnection('localhost', 'root', '', 'girlhood');

$articleManager = new ArticleManager($db);

// Traitement du formulaire de filtre par catégorie

if(isset($_POST['order'])) {
    $order = $_POST['order'];
    if ($order === "Nouveautés") {
        $sql = "SELECT * FROM article WHERE date_ajout >= DATE_SUB(NOW(), INTERVAL 3 MONTH)";
    } elseif ($order === "Soldes") {
        $sql = "SELECT * FROM article WHERE reduction != 0";
    } elseif ($order === "Adultes") {
        $sql = "SELECT * FROM article WHERE age = 'adulte'";
    } elseif ($order === "Enfants") {
        $sql = "SELECT * FROM article WHERE age = 'enfant'";
    }

    $articles = $articleManager->getArticles($sql);
    if (!empty($articles )) {
        displayArticleGrid($articles);
    } else {
      echo '<script>alert("Aucun résultat trouvé dans ce filtre") </script>';
    }
    }

// Traitement du formulaire de filtre par prix
if(isset($_POST['action']) && $_POST['action'] === 'price_filter') {
    $min_price = $_POST['min'];
    $max_price = $_POST['max'];
    // Requête SQL pour récupérer les articles dans la plage de prix spécifiée
    $sql = "SELECT * FROM article WHERE price >= '$min_price' AND price <= '$max_price'";
  
    $articles = $articleManager->getArticles($sql);
    if (!empty($articles )) {
    displayArticleGrid($articles);
} else {
    echo '<script>alert("Aucun résultat trouvé dans cette plage de prix")</script>';
}
}
$db->close();
?>
</body>
</html>


