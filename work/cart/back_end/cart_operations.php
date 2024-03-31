<?php

require_once "autoload.php";
require_once "ConnexionBD.php"; // Include the database connection file
require_once "retrieveprbyID.php";

session_start(); // Start the session after including necessary files

// Check if the cart session variable exists, otherwise create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}



// Actions to perform when a form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add product to cart
    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $product = getProductById($productId);

        // Check if product exists before adding to cart
        if ($product) {
            $cart = $_SESSION['cart'];
            $itemFound = false;

            // Check if the product already exists in the cart
            foreach ($cart->getItems() as $item) {
                if ($item->getProduct()->getId() == $productId) {
                    $itemFound = true;
                    $item->setQuantity($item->getQuantity() + $quantity);
                    break;
                }
            }

            if (!$itemFound) {
                // If the product is not in the cart, add it as a new item
                $_SESSION['cart']->addProduct($product, $quantity);
            }

            // Update product stock in the database
            ConnexionBD::updateProductStock($productId, $product->getStock() - $quantity);
        } else {
            // Handle error (e.g., product not found)
            echo "Product not found.";
        }
    }

    // Remove item from cart
    if (isset($_POST['remove_from_cart'])) {
        $productId = $_POST['product_id'];
        $_SESSION['cart']->removeProductById($productId);
        header("Location: index.php"); // Redirect back to the same page after removing the product
        exit();
    }

    // Place order
    if (isset($_POST['place_order'])) {
        // Clear the cart after placing the order
        $_SESSION['cart']->clear();
        // Redirect to place_order.php or display a message
        // header("Location: place_order.php");
        // exit();
        $orderPlacedMessage = "Your order has been placed. Thank you!";
    }
}
?>