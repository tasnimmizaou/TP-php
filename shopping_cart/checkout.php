<?php
// Inclure les fichiers requis
require_once ("../commun/autoload.php");

require_once ("../commun/ConnexionBD.php");
require_once "Cart.php";
require_once "add_to_cart.php";
require_once('../TCPDF-main/tcpdf.php');





// Initialiser le total à payer
$totalToPay = 0;

// Vérifier si le panier existe dans la session
if (isset($_SESSION['cart'])) {
    // Obtenir les éléments du panier
    $cart = $_SESSION['cart'];
    $items = $cart->getItems();

    // Calculer le total à payer
    $totalToPay = $cart->getTotalPriceAfterReduction();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
    <!-- Inclure Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="checkout.js" defer></script>
</head>
<body>
    <div class="container">
        <h2>Purchases</h2>
        <?php
        // Vérifier si le panier existe dans la session
        if (isset($_SESSION['cart'])) {
            echo '<div class="cart-items">';
            foreach ($items as $item) {
                $product = $item->getProduct();
                $quantity = $item->getQuantity();
                echo '<div class="cart-item">';
                echo '<span class="item-name">' . $product->getName() . '</span>';
                echo '<span class="item-quantity">' . $quantity . '</span>';
                echo '</div>';
            }
            echo '</div>';

            // Afficher le total à payer
            echo '<div class="total">';
            echo 'Total to Pay: $' . $totalToPay;
            echo '</div>';

            // Afficher un bouton "Payer"
            echo '<div class="text-center">';
            echo '<a href="payer.php" class="btn btn-primary btn-md" id="checkoutBtn">Payer</a>';
            echo '</div>';
        } else {
            echo "Your cart is empty.";
        }

        // Ajouter un bouton pour générer le PDF
        echo '<form action="generate_pdf.php" method="post">';
        echo '<input type="hidden" name="total_to_pay" value="' . $totalToPay . '">';
        echo '<button type="submit" name="generate_pdf" class="btn btn-success">Generate PDF</button>';
        echo '</form>';
        ?>
    </div>
</body>
</html>