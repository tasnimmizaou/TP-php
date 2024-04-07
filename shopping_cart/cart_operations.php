<?php
require_once ("../commun/autoload.php");
require_once ("../commun/ConnexionBD.php");
require_once ("../commun/Product.php");// Include Product class if not already included
require_once "cart.php";
require_once "cart_manager.php";

// Assurez-vous que $user_id est défini avant de l'utiliser
$user_id = 1; // Vous devrez remplacer ceci par votre méthode pour obtenir l'ID de l'utilisateur connecté

// Place order
if (isset($_POST['place_order'])) {
    // Clear the cart after placing the order
    //$_SESSION['cart']->clear();
    // Unset the $_SESSION['cart'] variable
    unset($_SESSION['cart']);
    // Create a new empty Cart instance and assign it to $_SESSION['cart']
    $_SESSION['cart'] = new Cart($user_id); // Pass the user_id to the Cart constructor

    // Create a new CartManager instance
    $cartManager = new CartManager();
    // Place the order using the user_id
    $orderId = $cartManager->placeOrder($user_id);

    if ($orderId) {
        //Order placed successfully, redirect or display a success message
       header("Location: checkout.php?order_id=$orderId");
        exit;
    } else {
        // Handle error if order placement fails
        echo "Failed to place order.";
   // }
}}
?>
