<?php
require_once 'autoloader.php';
$pdo = ConnexionBD::getInstance();

$req = $pdo->prepare("SELECT * FROM user");
$req->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard d'administration_Tableau des Clients</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-3 mb-4">Tableau des Clients</h2>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Address</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="modifierClient.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Modifier</a>
                            <button class="btn btn-danger deleteButton" data-id="<?php echo $row['id']; ?>">Supprimer</button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <button class="btn btn-primary mr-2 edit addButton" >Ajouter</button>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="buttonsClient.js"></script>
</body>
</html>