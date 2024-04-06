<?php
require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "cart_operations.php";
require_once "cart_manager.php"; 
require_once "place_order.php";
require_once "cart.php";
require_once "retrieveprbyID.php";
require_once "add_to_cart.php";
require_once "remove_from_cart.php";
// Start la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si le formulaire est soumis pour ajouter un produit au panier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Supposons que vous avez une fonction pour obtenir les détails du produit par ID
    $product = getProductById($productId);

    if ($product) {
        // Vérifie si la variable de session 'cart' existe, sinon la crée
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = new Cart();
        }

        // Ajoute le produit au panier en session
        $_SESSION['cart']->addProduct($product, $quantity);

        // Ajoute également le produit à la table "panier" dans la base de données
        $cartManager = new CartManager();
        $userId = 1; // Remplacez ceci par l'ID de l'utilisateur réel
        $success = $cartManager->addProductToCartDB($product->getId(), $quantity, $userId);

        if ($success) {
            echo "Product added to cart successfully.";
        } else {
            echo "Failed to add product to cart.";
        }

        // Redirige vers la page index_cart.php pour afficher le panier mis à jour
        header("Location: index_cart.php");
        exit;
    } else {
        // Gère l'erreur (par exemple, produit non trouvé)
        echo "Product not found.";
    }
}

// Démarrer la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si le formulaire de commande est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Vous devez obtenir l'ID de l'utilisateur authentifié ici
    $userId = 1; // Remplacez ceci par l'ID de l'utilisateur authentifié

    // Créer une instance de CartManager
    $cartManager = new CartManager();

    // Appeler la méthode placeOrder pour placer la commande
    $orderId = $cartManager->placeOrder($userId);

    /*if ($orderId) {
        // Rediriger vers une page de confirmation de commande avec l'ID de commande
        header("Location: order_confirmation.php?order_id=$orderId");
        exit;
    } else {
        // Gérer l'échec de la commande
        echo "Failed to place order."; // Message d'erreur à afficher
    }*/
}

/*
// Vérifier si le formulaire de commande est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Récupérer l'ID de l'utilisateur (vous devez implémenter cette logique)
    $userId = 1; // Remplacez ceci par la logique pour obtenir l'ID de l'utilisateur

    // Placez la commande
    $orderId = $cartManager->placeOrder($userId);
    
    if ($orderId) {
        // Insérer les détails de la commande
        $cartItems = $_SESSION['cart']->getItems();
        foreach ($cartItems as $item) {
            $productId = $item->getProduct()->getId();
            $quantity = $item->getQuantity();
            $unitPrice = $item->getProduct()->getPrice(); // Vous devez obtenir le prix unitaire correctement

            // Insérez cet élément dans la table 'details_commande'
            $success = $cartManager->insertOrderDetail($orderId, $productId, $quantity, $unitPrice);

           /* if (!$success) {
                // Gérer l'erreur si l'insertion échoue
                echo "Failed to insert order detail for product ID: $productId";
            }
        }

        // Clear the cart after placing the order
        $_SESSION['cart']->clear();

        // Rediriger vers une page de confirmation ou autre
        header("Location: order_confirmation.php?order_id=$orderId");
        exit;
    } else {
        echo "Failed to place order.";
    }
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet" />
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<header>
    <div class="container">
        <h1>Shopping Cart <i class="fas fa-shopping-cart"></i></h1>
    </div>
</header>
<section>
    <div class="container">
        <!-- Display shopping cart -->
        <?php if (count($_SESSION['cart']->getItems()) === 0): ?>
            <p class="empty-cart-message">Your cart is empty!</p>
            <form method="post" action="product_display.php">
                <button type="submit" class="btn btn-primary">Continue Shopping</button>
            </form>
        <?php else: ?>
            <!-- Display shopping cart content -->
            <table class="table table-washed">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Reduction</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['cart']->getItems() as $item): ?>
                    <?php $cartItem = $item; ?>
                    <tr>
                        <td><?php echo $cartItem->getProduct()->getName(); ?></td>
                        <td><?php echo $cartItem->getQuantity(); ?></td>
                        <td>$<?php
                            $originalPrice = $cartItem->getProduct()->getPrice() * $cartItem->getQuantity();
                            $reductionPercentage = $cartItem->getProduct()->getReduction();
                            $reducedPrice = $originalPrice * (1 - $reductionPercentage / 100);
                            echo number_format($reducedPrice, 2);
                            ?></td>
                        <td><?php echo $reductionPercentage . "%"; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="product_id"
                                       value="<?php echo $cartItem->getProduct()->getId(); ?>">
                                <button type="submit" name="remove_from_cart" class="btn btn-danger"><i
                                            class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Total Price after Reduction -->
            <p>Total Price : $<?php echo number_format($_SESSION['cart']->getTotalPriceAfterReduction(), 2); ?></p>
            <form method="post" action=" " id="placeOrderForm">
                <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
            </form>
        <?php endif; ?>
        <!-- Order confirmation message -->
        <?php if (isset($orderPlacedMessage)): ?>
            <p><?php echo $orderPlacedMessage; ?></p>
        <?php endif; ?>
    </div>
</section>

<script src="cart.js"></script>

</body>
</html>
