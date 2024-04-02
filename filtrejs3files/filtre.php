<?php

require_once 'DatabaseConnection.php';
require_once 'ArticleManager.php';
require_once 'Article.php';
// Récupérer les données JSON envoyées via la méthode POST
$data = json_decode(file_get_contents('php://input'), true);

// Vérifier si les données ont été reçues correctement
if (isset($data['query'])) {
  $dbConnection = new DatabaseConnection("localhost", "root","", "girlhood");
  $articleManager = new ArticleManager($dbConnection);
    
  // Exécuter la requête SQL

    $query = $data['query'];
    $articles = $articleManager->getArticles($query);

    // Vérifier si la requête a été exécutée avec succès
    if (!empty($articles)) {
      // Convertir les articles en JSON pour l'envoi au client
      echo json_encode($articles);
  } else {
      // En cas d'erreur ou de résultats vides
      echo "Aucun article trouvé.";
  }
    // Fermer la connexion
    $dbConnection->close();
} else {
    // En cas de données manquantes ou incorrectes
    echo "Données manquantes ou incorrectes";
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styleaffic.css">
</head>
<body>
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

require_once('ArticleManager.php');
require_once('DatabaseConnection.php');
require_once('Article.php');

$db = new DatabaseConnection('localhost', 'root', '', 'girlhood');

$articleManager = new ArticleManager( $db);

// Traitement du formulaire de filtre par catégorie
if(isset($_POST['order'])) {
    $order = $_POST['order'];
    if ($order=== "Nouveautés") {$sql = "SELECT * FROM article WHERE date_ajout >= DATE_SUB(NOW(), INTERVAL 3 MONTH)";}
    else if  ($order=== "Soldes") { $sql = "SELECT * FROM article WHERE reduction != 0";}
    else if  ($order=== "Adultes") { $sql = "SELECT * FROM article WHERE age = 'adulte'";}
    else if  ($order=== "Enfants") { $sql = "SELECT * FROM article WHERE age = 'enfant'";}


$articles = $articleManager->getArticles($sql);
displayArticleGrid($articles);

$db->close();}
?>
</body>
</html>
