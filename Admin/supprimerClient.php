<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un client</title>
</head>
<body>
<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $client_id = $_POST['id'];

    require_once 'autoloader.php';
    $pdo = ConnexionBD::getInstance();

    $req = $pdo->prepare("DELETE FROM user WHERE id = ?");
    if ($req->execute([$client_id])) {
        http_response_code(200);
        echo "Le client a été supprimé avec succès.";
    } else {
        http_response_code(500);
        echo "Erreur lors de la suppression du client.";
    }
} else {
    http_response_code(400);
    echo "ID du client non spécifié.";
}
?>
</body>
</html>