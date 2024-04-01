<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un admin</title>
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
        $admin_id = $_GET['id'];
        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();
        $req = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
        $req->execute([$admin_id]);
        if ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <h2 class="mt-5 mb-4">Modifier l'admin</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label>Username:</label>
                    <input class="editable form-control" type="text" name="username" id="username" pattern="[A-Za-z0-9\s]+" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Userpassword:</label>
                    <input class="editable form-control" type="text" name="userpassword" id="userpassword" pattern="[A-Za-z0-9\s]+" value="<?php echo $row['userpassword']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email :</label>
                    <input class="editable form-control" type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="tableAdmin.php" class="btn btn-secondary">Retour à la page de dashboard</a>
            </form>
            <?php
        } else {
            echo "L'admin avec l'ID $admin_id n'existe pas.";
        }
    } else {
        echo "ID de l'admin non spécifié.";
    }
    ?>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'], $_POST['username'], $_POST['userpassword'], $_POST['email'])) {
        $admin_id = $_POST['id'];
        $username = $_POST['username'];
        $userpassword = $_POST['userpassword'];
        $email = $_POST['email'];
        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();
        $req = $pdo->prepare("UPDATE admins SET username = ?, userpassword = ?, email = ? WHERE id = ?");
        if ($req->execute([$username, $userpassword, $email, $admin_id])) {
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