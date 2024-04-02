<?php
require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "Cart.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="checkout.js" defer></script>
</head>
<body>

<div class="container">
    <h2>Purchases</h2>

    <?php
    // Démarrer la session
    session_start();

    // Vérifier si le panier existe dans la session
    if (isset($_SESSION['cart'])) {
        // Obtenir les éléments du panier
        $cart = $_SESSION['cart'];
        $items = $cart->getItems();

        // Afficher les détails du panier
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
        echo 'Total to Pay: $' . $cart->getTotalSum();
        echo '</div>';

        // Afficher un bouton de paiement avec un événement onclick pour déclencher la déconnexion
        echo '<button class="checkout-btn" id="checkoutBtn">Checkout</button>';
    } else {
        echo "Your cart is empty.";
    }
    ?>

</div>

</body>
</html>
