<?php
require_once "retrieveprbyID.php";
require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "cart_operations.php";
require_once "cart_manager.php";

// Check if the form for adding to cart is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Get the product ID from the form
    $productId = $_POST['product_id'];

    // Get the product from the database using the ID
    $product = getProductById($productId);

    // Check if the product exists
    if ($product) {
        // Create a cart manager instance
        $cartManager = new CartManager();
        
        // Add the product to the cart with a quantity of 1
        $cartManager->addProductToCart($product, 1, 1); // Assuming user ID is 1 for now
        
        // Set a cookie to store the ID of the product added to the cart
        setcookie("cart_product_id", $productId, time() + (86400 * 30), "/"); // Cookie valid for 30 days
    }
}
?>
