<?php
require_once ("../commun/autoload.php");
require_once ("../commun/ConnexionBD.php");
require_once ("../commun/Product.php");
require_once ("cart_manager.php"); 

session_start();

// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Utilisez le user ID connecté
} /*else {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../user/login.php");
    exit; // Assurez-vous de terminer le script après la redirection
}*/

// Vérifie si le formulaire est soumis pour ajouter un produit au panier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Supposons que vous avez une fonction pour obtenir les détails du produit par ID
    $product = getProductById($productId);

    if ($product) {
        // Vérifie si la variable de session 'cart' existe, sinon la crée
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = new Cart($userId); // Utilisez le user ID connecté
        }

        // Ajoute le produit au panier en session
        $_SESSION['cart']->addProduct($product, $quantity);

        // Ajoute également le produit à la table panier dans la base de données
        $cartManager = new CartManager();
        $success = $cartManager->addProductToCart($product, $quantity, $userId);

        if ($success) {
            echo "Product added to cart and database successfully.";
        } else {
            echo "Failed to add product to cart or database.";
        }

        // Redirige vers la page index_cart.php pour afficher le panier mis à jour
        header("Location: index_cart.php");
        exit;
    } else {
        // Gère l'erreur (par exemple, produit non trouvé)
        echo "Product not found.";
    }

    header("Location: ../shopping_cart/index_cart.php");
}


?>