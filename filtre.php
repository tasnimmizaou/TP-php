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