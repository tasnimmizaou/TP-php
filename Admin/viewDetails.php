<?php
require_once 'commun/autoloader.php';
$pdo = ConnexionBD::getInstance();

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $commande_id = $_GET['id'];

    $details_req = $pdo->prepare("SELECT * FROM details_commande WHERE commande_id = ?");
    $details_req->execute([$commande_id]);
    if($details_req->rowCount() > 0) {
        include('header.php');
        include ("navbar.php") ;?>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div id="content-wrapper" class="d-flex flex-column">
        <div class="container">
            <h2 class="mt-3 mb-4">Détails de la Commande</h2>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>Commande_ID</th>
                            <th>Article_ID</th>
                            <th>Quantity</th>
                            <th>Unit_price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($details_row = $details_req->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $details_row['commande_id']; ?></td>
                                <td><?php echo $details_row['article_id']; ?></td>
                                <td><?php echo $details_row['quantity']; ?></td>
                                <td><?php echo $details_row['prix_unitaire']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </div>
        <?php include("footer.php"); include("scripts.php");?>

        <?php
    } else {
        $_SESSION['status']="Aucun détail trouvé pour cette commande.";
    }
} else {
    $_SESSION['status']= "ID de commande non spécifié.";
}
?>