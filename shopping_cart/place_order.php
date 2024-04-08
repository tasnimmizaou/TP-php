<?php
require_once ("../commun/autoload.php");
require_once ("../commun/ConnexionBD.php");
require_once ("../commun/Product.php");
//require_once "cart.php";
require_once "cart_manager.php";




if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; 
} else {
    // Redirigez user  vers la page de connexion s'il n'est pas connecté
    header("Location: ../user/login.php");
    exit; 
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
   
    $cartManager = new CartManager();
   
    $orderId = $cartManager->placeOrder($user_id);//cette fonction est definie (cart_manager.php)

    if ($orderId) {
        //unset($_SESSION['cart']);
        header("Location: checkout.php?order_id=$orderId");
        exit;
    } else {
        //  l'erreur 
        echo "Failed to place order.";
    }
}
?>
