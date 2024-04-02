<?php include('header.php'); include('navbar.php'); ?>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<div class="container-fluid">
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['userpassword'], $_POST['email'])) {
        $username = $_POST['username'];
        $userpassword = $_POST['userpassword'];
        $email = $_POST['email'];
        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();

        $req = $pdo->prepare("INSERT INTO admins (username,userpassword, email) VALUES (?, ?, ?)");

        if ($req->execute([$username, $userpassword, $email])) {
            $_SESSION['success']="Admin ajoute avec succes";
            header('location: tableAdmin.php');
        } else {
            $_SESSION['status']="Admin non ajouté";
        }
    } else {
        $_SESSION['status']="Veuillez fournir toutes les données nécessaires";

    }
}
?>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
</body>
<?php include("footer.php"); include("scripts.php");?>
</html>
