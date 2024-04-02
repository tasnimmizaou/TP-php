<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un article</title>
</head>
<body>
<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $article_id = $_POST['id'];

    require_once 'autoloader.php';
    $pdo = ConnexionBD::getInstance();

    $req = $pdo->prepare("DELETE FROM article WHERE id = ?");
    if ($req->execute([$article_id])) {
        http_response_code(200);
        echo "L'article a été supprimé avec succès.";
    } else {
        http_response_code(500);
        echo "Erreur lors de la suppression de l'article.";
    }
} else {
    http_response_code(400);
    echo "ID de l'article non spécifié.";
}
?>
</body>
</html>
