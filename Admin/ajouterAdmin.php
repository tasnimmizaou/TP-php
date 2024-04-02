<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard d'administration_Ajouter un admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Ajouter un admin</h2>
    <form action="" method="post" enctype="multipart/form-data"> <!-- Ajout de enctype pour gérer les fichiers -->
        <div class="form-group">
            <label>Username:</label>
            <input class="editable form-control" type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label>Userpassword:</label>
            <input class="editable form-control" type="text" name="userpassword" id="userpassword" required>
        </div>
        <div class="form-group">
            <label>Email :</label>
            <input class="editable form-control" type="email" name="email" id="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a href="tableAdmin.php" class="btn btn-secondary">Retour à la page Tableau des Administrateurs</a>
    </form>
</div>
<?php
// Traitement du formulaire lorsqu'il est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['userpassword'], $_POST['email'])) {
        $username = $_POST['username'];
        $userpassword = $_POST['userpassword'];
        $email = $_POST['email'];
        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();

        $req = $pdo->prepare("INSERT INTO admins (username,userpassword, email) VALUES (?, ?, ?)");

        if ($req->execute([$username, $userpassword, $email])) {
            echo "<div class='alert alert-success mt-3' role='alert'>L'admin a été ajouté avec succès.</div>";
        } else {
            echo "<div class='alert alert-danger mt-3' role='alert'>Erreur lors de l'ajout de l'admin.</div>";
        }
    } else {
        echo "<div class='alert alert-warning mt-3' role='alert'>Veuillez fournir toutes les données nécessaires.</div>";
    }
}
?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
