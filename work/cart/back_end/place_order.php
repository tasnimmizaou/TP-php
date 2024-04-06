<?php
require_once "cart_manager.php";

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the place order form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Retrieve the user's ID (you'll need a way to identify the logged-in user)
    $userId = 1; // You'll need to replace this with the actual user ID

    // Create a new instance of CartManager
    $cartManager = new CartManager();

    // Place the order and get the order ID
    $orderId = $cartManager->placeOrder($userId);

    if ($orderId) {
        // Order placed successfully, redirect or display a success message
        header("Location: place_order.php?order_id=$orderId");
        exit;
    } else {
        // Handle error if order placement fails
        echo "Failed to place order."; // This is a basic error message, consider logging errors as well
    }
}
?>

