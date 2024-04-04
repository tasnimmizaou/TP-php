<?php
require_once "autoload.php";
require_once "ConnexionBD.php"; 
require_once "retrieveprbyID.php";
require_once "stock_product.php";
require_once "Cart.php"; 
require_once "add_to_cart.php";
require_once "remove_from_cart.php";



// Check if the cart session variable exists, otherwise create it
if (!isset($_SESSION['cart'])) {
    // Set the default user_id to 1
    $user_id = 1;
    //$user_id = determineUserId();
    $_SESSION['cart'] = new Cart($user_id);
}



//function determineUserId() {
    // Example: Retrieve user ID from session or user authentication
    //  let's assume the user ID is retrieved from the session
   // if (isset($_SESSION['user_id'])) {
       // return $_SESSION['user_id'];
   // } else {
        // If user ID is not available, you may return a default value or handle the scenario accordingly
       // return null; // Return null or any default value
   // }
//}


    // Place order
    if (isset($_POST['place_order'])) {
        // Clear the cart after placing the order
        $_SESSION['cart']->clear();
        // Redirect to place_order.php or display a message
        // header("Location: place_order.php");
        // exit();
        $orderPlacedMessage = "Your order has been placed. Thank you!";
    }

?>
