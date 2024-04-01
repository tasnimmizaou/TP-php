<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard d'administration_Ajouter un client</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Ajouter un client</h2>
    <form action="" method="post" enctype="multipart/form-data"> <!-- Ajout de enctype pour gérer les fichiers -->
        <div class="form-group">
            <label>Username:</label>
            <input class="editable form-control" type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input class="editable form-control" type="text" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input class="editable form-control" type="text" name="address" id="address" required>
        </div>
        <div class="form-group">
            <label>Email :</label>
            <input class="editable form-control" type="email" name="email" id="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a href="tableClient.php" class="btn btn-secondary">Retour à la page Tableau des Clients</a>
    </form>
</div>
<?php
// Traitement du formulaire lorsqu'il est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['address']) && !empty($_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();
        $req = $pdo->prepare("INSERT INTO user (username, password, address, email) VALUES (?, ?, ?, ?)");
        if ($req->execute([$username, $password, $address, $email])) {
            echo "<div class='alert alert-success mt-3' role='alert'>Le client a été ajouté avec succès.</div>";
        } else {
            echo "<div class='alert alert-danger mt-3' role='alert'>Erreur lors de l'ajout du client.</div>";
        }
    } else {
        echo "<div class='alert alert-warning mt-3' role='alert'>Veuillez fournir toutes les données nécessaires.</div>";
    }
}
?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
