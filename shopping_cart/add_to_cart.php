<?php
require_once ("../commun/autoload.php");
require_once ("../commun/ConnexionBD.php");
require_once ("../commun/Product.php");
require_once ("cart_manager.php"); 
require_once ("retrieveprbyID.php"); 
require_once "Cart.php";



session_start();

// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; 
} else {
    
    header("Location: ../user/login.php");
    exit; 
}


$cartCookieName = 'cart_items';
$cartItems = isset($_COOKIE[$cartCookieName]) ? unserialize($_COOKIE[$cartCookieName]) : [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    //  une fonction pour obtenir les détails du produit par ID
    $product = getProductById($productId);

    if ($product) {
        $cartItems[$productId] = ['product' => $product, 'quantity' => $quantity];
        setcookie($cartCookieName, serialize($cartItems), time() + (86400 * 30), '/'); // Valide pour 30 jours
       
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = new Cart($userId); 
        }

        
        $_SESSION['cart']->addProduct($product, $quantity);

        
        $cartManager = new CartManager();
        $success = $cartManager->addProductToCart($product, $quantity, $userId);

        if ($success) {
            echo "Product added to cart and database successfully.";
        } else {
            echo "Failed to add product to cart or database.";
        }

        
        header("Location: index_cart.php");
        exit;
    } else {
       
        echo "Product not found.";
    }

    header("Location: index_cart.php");

}



?>