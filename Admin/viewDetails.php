<?php
require_once 'autoloader.php';
$pdo = ConnexionBD::getInstance();

// Check if the command ID is provided in the URL parameter
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $commande_id = $_GET['id'];

    // Prepare and execute a query to fetch details from the details_commande table
    $details_req = $pdo->prepare("SELECT * FROM details_commande WHERE commande_id = ?");
    $details_req->execute([$commande_id]);

    // Check if details are found
    if($details_req->rowCount() > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Details de la Commande</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
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
                                // Fetch and display details for the current command
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
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "Aucun détail trouvé pour cette commande.";
    }
} else {
    echo "ID de commande non spécifié.";
}
?>
