<?php
require_once "../../commun/autoload.php";
require_once "ConnexionBD.php";
require_once "Product.php";
require_once "cart_manager.php"; // Assurez-vous que le nom du fichier est correctement orthographié

session_start();
// Vérifie si le formulaire est soumis pour ajouter un produit au panier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Supposons que vous avez une fonction pour obtenir les détails du produit par ID
    $product = getProductById($productId);

    if ($product) {
        // Vérifie si la variable de session 'cart' existe, sinon la crée
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = new Cart(1);
        }

        // Ajoute le produit au panier en session
        $_SESSION['cart']->addProduct($product, $quantity);

        // Ajoute également le produit à la table panier dans la base de données
        // Assuming $product and $quantity are already set
$userId = 1; // Replace with the actual user ID
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
}


?>
