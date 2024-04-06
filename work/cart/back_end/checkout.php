<?php
require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "Cart.php";
require_once('../TCPDF-main/tcpdf.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">

    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="checkout.js" defer></script>
</head>
<body>

<div class="container">
    <h2>Purchases</h2>

    <?php
    // Start session
    session_start();

    // Check if the cart exists in the session
    if (isset($_SESSION['cart'])) {
        // Get cart items
        $cart = $_SESSION['cart'];
        $items = $cart->getItems();

        // Display cart items
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

        // Display total to pay
        echo '<div class="total">';
        echo 'Total to Pay: $' . $cart->getTotalSum();
        echo '</div>';

        // Display a medium-sized centered "Payer" button
        echo '<div class="text-center">';
        echo '<a href="payer.php" class="btn btn-primary btn-md" id="checkoutBtn">Payer</a>';
        echo '</div>';
    } else {
        echo "Your cart is empty.";
    }

    // Add a button to generate the PDF
    echo '<form action="generate_pdf.php" method="post">';
    echo '<input type="hidden" name="total_to_pay" value="' . $cart->getTotalSum() . '">';
    echo '<button type="submit" name="generate_pdf" class="btn btn-success">Generate PDF</button>';
    echo '</form>';
    ?>

</div>

</body>
</html>
