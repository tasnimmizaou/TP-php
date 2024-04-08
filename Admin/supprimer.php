<?php
if (isset($_POST['id']) && isset($_POST['table'])) {
    $recordId = $_POST['id'];
    $tableName = $_POST['table'];

    require_once 'autoloader.php';
    $pdo = ConnexionBD::getInstance();

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
