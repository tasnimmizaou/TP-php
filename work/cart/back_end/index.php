<?php
require_once "product_display.php";
require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "cart_operations.php";
require_once "cart_manager.php"; // Inclure le fichier cart_manager.php

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

<section>
    <div class="container">
       
        <!-- Display shopping cart -->

<?php if (count($_SESSION['cart']->getItems()) === 0): ?>
    <p class="empty-cart-message">Your cart is empty!</p>
    <form method="post" action="index.php">
        <button type="submit" class="btn btn-primary">Continue Shopping</button>
    </form>
<?php else: ?>
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
                            <input type="hidden" name="product_id" value="<?php echo $cartItem->getProduct()->getId(); ?>">
                            <button type="submit" name="remove_from_cart" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<!-- Total Price after Reduction -->
<p>Total Price : $<?php echo number_format($_SESSION['cart']->getTotalPriceAfterReduction(), 2); ?></p>

            <!-- Place Order Form -->
            <form method="post" action="index.php">
                <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
            </form>


        <!-- Order confirmation message -->
        <?php if (isset($orderPlacedMessage)): ?>
            <p><?php echo $orderPlacedMessage; ?></p>
        <?php endif; ?>
    </div>
</section>

<script src="cart.js"></script>
<script>
    // Function to display a popup message
    function showMessage(message) {
        alert(message); // Display an alert with the message
    }
</script>
</body>
</html>
