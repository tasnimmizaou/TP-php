<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un client</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea, select {
            margin-bottom: 10px;
        }
        .editable {
            cursor: pointer;
        }
        .editable:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $client_id = $_GET['id'];
        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();
        $req = $pdo->prepare("SELECT * FROM user WHERE id = ?");
        $req->execute([$client_id]);
        if ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <h2 class="mt-5 mb-4">Modifier le client</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label>Username:</label>
                    <input class="editable form-control" type="text" name="username" id="username" pattern="[A-Za-z0-9\s]+" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input class="editable form-control" type="text" name="password" id="password" pattern="[A-Za-z0-9\s]+" value="<?php echo $row['password']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <input class="editable form-control" type="text" name="address" id="address" pattern="[A-Za-z0-9\s]+" value="<?php echo $row['address']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email :</label>
                    <input class="editable form-control" type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="tableClient.php" class="btn btn-secondary">Retour à la page Tableau des Clients</a>
            </form>
            <?php
        } else {
            echo "Le client avec l'ID $client_id n'existe pas.";
        }
    } else {
        echo "ID du client non spécifié.";
    }
    ?>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'], $_POST['username'], $_POST['password'], $_POST['address'] , $_POST['email'])) {
        $client_id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();
        $req = $pdo->prepare("UPDATE user SET username = ?, password = ?, address = ? , email = ? WHERE id = ?");
        if ($req->execute([$username, $password,$address, $email, $client_id])) {
            echo "<div class='alert alert-success mt-3' role='alert'>Les modifications ont été enregistrées avec succès.</div>";
        } else {
            echo "<div class='alert alert-danger mt-3' role='alert'>Erreur lors de l'enregistrement des modifications.</div>";
        }
    } else {
        echo "<div class='alert alert-warning mt-3' role='alert'>Veuillez fournir toutes les données nécessaires.</div>";
    }
}
?>

</body>
</html>