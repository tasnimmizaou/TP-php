<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un admin</title>
</head>
<body>
<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $admin_id = $_POST['id'];

    require_once 'autoloader.php';
    $pdo = ConnexionBD::getInstance();

    $req = $pdo->prepare("DELETE FROM admins WHERE id = ?");
    if ($req->execute([$admin_id])) {
        http_response_code(200);
        echo "L'admin a été supprimé avec succès.";
    } else {
        http_response_code(500);
        echo "Erreur lors de la suppression de l'admin.";
    }
} else {
    http_response_code(400);
    echo "ID de l'admin non spécifié.";
}
?>
</body>
</html>