<?php
require_once 'autoloader.php';
$pdo = ConnexionBD::getInstance();
$req = $pdo->prepare("SELECT * FROM article");
$req->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard d'administration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-3 mb-4">Tableau de bord d'administration</h2>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>reduction</th>
                    <th>date_ajout</th>
                    <th>Catégorie</th>
                    <th>age</th>
                    <th>Quantité</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['reduction']; ?></td>
                        <td><?php echo $row['date_ajout']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <button class="btn btn-primary mr-2" id="ajouter">Ajouter</button>
            <button class="btn btn-warning mr-2" id="modifier">Modifier</button>
            <button class="btn btn-danger" id="supprimer">Supprimer</button>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
