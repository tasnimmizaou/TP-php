<?php
require_once ("../commun/autoload.php");
require_once ("../commun/ConnexionBD.php");
require_once "Cart.php";
require_once "add_to_cart.php";
require_once('../TCPDF-main/tcpdf.php');

$totalToPay = 0;

// Vérifier si le panier existe dans la session
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $items = $cart->getItems();
    $totalToPay = $cart->getTotalPriceAfterReduction();
}

// Fonction pour afficher les articles du panier
function displayCartItems($items) {
    $output = '<div class="cart-items">';
    foreach ($items as $item) {
        $product = $item->getProduct();
        $quantity = $item->getQuantity();
        $output .= '<div class="cart-item">';
        $output .= '<span class="item-name">' . $product->getName() . '</span>';
        $output .= '<span class="item-quantity">' . $quantity . '</span>';
        $output .= '</div>';
    }
    $output .= '</div>';
    return $output;
}

// Fonction pour afficher le total à payer
function displayTotalToPay($totalToPay) {
    return '<div class="total">Total to Pay: $' . $totalToPay . '</div>';
}

// Fonction pour afficher le bouton de paiement
function displayCheckoutButton() {
    return '<div class="text-center"><a href="payer.php" class="btn btn-primary btn-md" id="checkoutBtn">Payer</a></div>';
}

// Fonction pour afficher le formulaire de génération de PDF
function displayGeneratePDFForm($totalToPay) {
    return '<form action="generate_pdf.php" method="post"><input type="hidden" name="total_to_pay" value="' . $totalToPay . '"><button type="submit" name="generate_pdf" class="btn btn-success">Generate PDF</button></form>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="checkout.js" defer></script>
</head>
<body>
    <div class="container">
        <h2>Purchases</h2>
        
        <?php
        if (isset($_SESSION['cart'])) {
            echo displayCartItems($items);
            echo displayTotalToPay($totalToPay);
            echo displayCheckoutButton();
        } else {
            echo "Your cart is empty.";
        }
        
        echo displayGeneratePDFForm($totalToPay);
        ?>
        
    </div>
</body>
</html>
