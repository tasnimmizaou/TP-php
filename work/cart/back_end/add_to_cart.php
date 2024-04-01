<?php
require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "cart_operations.php";
require_once "cart_manager.php";
//require_once "retrieveprbyID.php";

// Vérifier si le formulaire d'ajout au panier est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Récupérer l'ID du produit à ajouter au panier depuis le formulaire
    $productId = $_POST['product_id'];

    // Récupérer le produit depuis la base de données en utilisant l'ID
    $product = getProductById($productId);

    // Vérifier si le produit existe
    if ($product) {
        // Ajouter le produit au panier avec une quantité de 1
        $cartManager = new CartManager();
        $cartManager->addProductToCart($product, 1, 1); // Le dernier paramètre est l'ID de l'utilisateur, ici 1
        
        // Définir un cookie pour stocker l'ID du produit ajouté au panier
        setcookie("cart_product_id", $productId, time() + (86400 * 30), "/"); // Cookie valide pendant 30 jours
    }
}
?>

