<?php
require_once ("../commun/autoload.php");
require_once ("../commun/ConnexionBD.php");
require_once "Cart.php";
require_once ("../commun/Product.php");
// Check if the cart session variable exists
//session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_from_cart'])) {
    if (isset($_SESSION['cart'])) {
        $productId = $_POST['product_id'];
        $userId = 1; // Set the user ID, replace with your logic to get the user ID

        try {
            // Remove product from the cart
            $_SESSION['cart']->removeProductById($productId);

            // Remove product from the database table 'panier'
            $pdo = ConnexionBD::getInstance();
            $stmt = $pdo->prepare("DELETE FROM panier WHERE user_id = :user_id AND article_id = :article_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':article_id', $productId);
            $stmt->execute();

            // Set cookie to remember the removed product
            $cookie_name = "removed_product";
            $cookie_value = $productId;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie expires in 30 days
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
