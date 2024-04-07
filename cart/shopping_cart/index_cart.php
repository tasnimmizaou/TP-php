<?php
require_once "autoload.php";
require_once "ConnexionBD.php";

require_once "cart_manager.php"; 

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
    //$product = getProductById($productId);

    if ($product) {
        // Vérifie si la variable de session 'cart' existe, sinon la crée
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = new Cart(1);
        }

        // Ajoute le produit au panier en session
        $_SESSION['cart']->addProduct($product, $quantity);

        // Ajoute également le produit à la table "panier" dans la base de données
        $cartManager = new CartManager();
        $userId = 1; // Remplacez ceci par l'ID de l'utilisateur réel
        $success = $cartManager->addProductToCart($product->getId(), $quantity, $userId);

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



if (isset($_POST['place_order'])) {
    // Assurez-vous que $user_id est défini avant de l'utiliser
    $user_id = 1; // Vous devrez remplacer ceci par votre méthode pour obtenir l'ID de l'utilisateur connecté

    // Create a new CartManager instance
    $cartManager = new CartManager();
    // Place the order using the user_id
    $orderId = $cartManager->placeOrder($user_id);

    if ($orderId) {
        // Commande placée avec succès, redirigez ou affichez un message de réussite
        header("Location: checkout.php?order_id=$orderId");
        exit;
    } else {
        // Gérer l'erreur si la commande échoue
        echo "Failed to place order.";
    }
}






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
        <?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']->getItems()) === 0): ?>
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
          
            <form method="post" action="">
    
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
