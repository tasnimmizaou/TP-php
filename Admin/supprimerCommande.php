<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer une commande</title>
</head>
<body>
<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $commande_id = $_POST['id'];

    require_once 'autoloader.php';
    $pdo = ConnexionBD::getInstance();

    try {
        $pdo->beginTransaction();

        // Delete details_commande first
        $req_details = $pdo->prepare("DELETE FROM details_commande WHERE commande_id = ?");
        $req_details->execute([$commande_id]);

        // Then delete the commande
        $req_commande = $pdo->prepare("DELETE FROM commande WHERE id = ?");
        $req_commande->execute([$commande_id]);

        $pdo->commit();

        http_response_code(200);
        echo "La commande et ses détails ont été supprimés avec succès.";
    } catch (Exception $e) {
        $pdo->rollBack();

        http_response_code(500);
        echo "Erreur lors de la suppression de la commande et de ses détails: " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "ID de la commande non spécifié.";
}
?>
</body>
</html>
