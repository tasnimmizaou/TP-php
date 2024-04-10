<?php
if (isset($_POST['id']) && isset($_POST['table'])) {
    $recordId = $_POST['id'];
    $tableName = $_POST['table'];

    require_once 'commun/autoloader.php';
    $pdo = ConnexionBD::getInstance();
    if ($tableName == 'article') {
        $updateQuery = "UPDATE details_commande SET article_id = NULL WHERE article_id = ?";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([$recordId]);
        $updateQuery2 = "UPDATE panier SET article_id = NULL WHERE article_id = ?";
        $stmt2 = $pdo->prepare($updateQuery2);
        $stmt2->execute([$recordId]);
    }
    if ($tableName == 'user') {
        $updateQuery = "UPDATE commande SET user_id = NULL WHERE user_id = ?";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([$recordId]);
        $updateQuery2 = "UPDATE panier SET user_id = NULL WHERE user_id = ?";
        $stmt2 = $pdo->prepare($updateQuery2);
        $stmt2->execute([$recordId]);
    }
    $query = "DELETE FROM $tableName WHERE id = ?";

    $stmt = $pdo->prepare($query);
    if ($stmt->execute([$recordId])) {
        http_response_code(200);
        echo "L'enregistrement a été supprimé avec succès.";
    } else {
        http_response_code(500);
        echo "Erreur lors de la suppression de l'enregistrement.";
    }
} else {
    http_response_code(400);
    echo "ID de l'enregistrement ou nom de la table non spécifié.";
}

?>
