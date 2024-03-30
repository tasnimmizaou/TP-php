<?php
require_once "Product.php";
require_once "Cart.php";
require_once "CartItem.php";
session_start(); // Déplacer la ligne session_start() ici

// Vérifier si la variable de session pour le panier existe, sinon la créer
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}

// Créer quelques produits de démonstration
$product1 = new Product(1, "iPhone 11", "Large", "Black", 1000.00, "Electronics", 10);
$product2 = new Product(2, "Samsung Galaxy S20", "Medium", "White", 900.00, "Electronics", 15);
$product3 = new Product(3, "Sony Headphones", "Small", "Red", 150.00, "Electronics", 20);

// Actions à effectuer lorsqu'un formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ajouter un produit au panier
    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $product = getProductById($productId);
        $_SESSION['cart']->addProduct($product, $quantity);
    }
}

// Fonction pour obtenir un produit par son ID (simule une récupération depuis une base de données)
function getProductById($productId)
{
    // Simulation d'une base de données ou d'une source de données externe
    $products = [
        1 => new Product(1, "iPhone 11", "Large", "Black", 1000.00, "Electronics", 10),
        2 => new Product(2, "Samsung Galaxy S20", "Medium", "White", 900.00, "Electronics", 15),
        3 => new Product(3, "Sony Headphones", "Small", "Red", 150.00, "Electronics", 20)
    ];

    return $products[$productId];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>

    <!-- Afficher les produits disponibles -->
    <h2>Products</h2>
    <ul>
        <?php foreach ([1, 2, 3] as $productId): ?>
            <?php $product = getProductById($productId); ?>
            <li>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                    <label><?php echo $product->getName(); ?> - $<?php echo $product->getPrice(); ?></label>
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Afficher le contenu du panier -->
    <h2>Shopping Cart</h2>
    <p>Number of items: <?php echo $_SESSION['cart']->getTotalQuantity(); ?></p>
    <p>Total price: $<?php echo $_SESSION['cart']->getTotalSum(); ?></p>
    <ul>
        <?php foreach ($_SESSION['cart']->getItems() as $cartItem): ?>
            <li>
                <?php echo $cartItem->getProduct()->getName(); ?> -
                Quantity: <?php echo $cartItem->getQuantity(); ?> -
                Price: $<?php echo $cartItem->getProduct()->getPrice(); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
