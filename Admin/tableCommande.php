<?php
require_once 'autoloader.php';
$pdo = ConnexionBD::getInstance();

$req = $pdo->prepare("SELECT * FROM commande");
$req->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard d'administration_Tableau des Commandes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-3 mb-4">Tableau des Commandes</h2>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>Commande ID</th>
                    <th>Date Commande</th>
                    <th>User ID</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td> 
                        <td><?php echo $row['date_commande']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>

                        <td>
                            <a href="viewDetails.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View_Details</a>
                            <button class="btn btn-danger deleteButton" data-id="<?php echo $row['id']; ?>">Supprimer</button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="buttonsCommande.js"></script>
</body>
</html>
