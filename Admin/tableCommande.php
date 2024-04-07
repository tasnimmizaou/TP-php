<?php
require_once 'autoloader.php';
$pdo = ConnexionBD::getInstance();

$req = $pdo->prepare("SELECT * FROM commande");
$req->execute();
include('header.php');
 include ("navbar.php");include('logout model.php');
 ?>


<div id="content-wrapper" class="d-flex flex-column">
<div class="content">
    <?php include 'nav.php' ?>
    <div class="container-fluid">
     <h1 class="h3 mb-2 text-gray-800">Commands</h1>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>Commande ID</th>
                    <th>Date Commande</th>
                    <th>User ID</th>
                    <th>Total Price</th>
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
                        <td><?php echo $row['total_price']; ?></td>

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
</div>
</div>
<?php include("footer.php"); include("scripts.php");?>
