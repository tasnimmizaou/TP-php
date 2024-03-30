<?php
require_once "Product.php";
require_once "Cart.php";
require_once "CartItem.php";

session_start(); // Start the session after including necessary files

// Check if the cart session variable exists, otherwise create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}

// Function to retrieve product by ID (simulates fetching from a database)
function getProductById($productId)
{
    // Simulated database or external data source
    $products = [
        1 => new Product(1, "pantalon", "Large", "Black", 100.00, "enfant", 10, 10), // Réduction de 10%
        2 => new Product(2, "chemise", "Medium", "White", 90.00, "femme", 15, 5), // Réduction de 5%
        3 => new Product(3, "pull", "Small", "Red", 150.00, "femme", 20, 0) // Pas de réduction
    ];

    return $products[$productId];
}

// Actions to perform when a form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add product to cart
    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $product = getProductById($productId);
        $_SESSION['cart']->addProduct($product, $quantity);
    }

    // Remove item from cart
    if (isset($_POST['remove_from_cart'])) {
        $productId = $_POST['product_id'];
        $_SESSION['cart']->removeProductById($productId);
        header("Location: index.php"); // Redirect back to the same page after removing the product
        exit();
    }

    // Place order
    if (isset($_POST['place_order'])) {
        // Clear the cart after placing the order
        $_SESSION['cart']->clear();
        // Redirect to place_order.php or display a message
        // header("Location: place_order.php");
        // exit();
        $orderPlacedMessage = "Your order has been placed. Thank you!";
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
        <!-- Shopping Cart Title with Icon -->
        <h1><i class="fas fa-shopping-cart"></i> Shopping Cart</h1>

        <!-- Display available products -->
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

        <!-- Display shopping cart -->
        <h2>Shopping Cart</h2>
        <?php if ($_SESSION['cart']->isEmpty()): ?>
            <p class="empty-cart-message">Your cart is empty!</p>
            <form method="post" action="home.php">
                <button type="submit" class="btn btn-primary">Continue Shopping</button>
            </form>
        <?php else: ?>
            <table class="table table-washed">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Reduction</th> <!-- New column for Reduction -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart']->getItems() as $item): ?>
                        <?php $cartItem = $item; ?>
                        <tr>
                            <td><?php echo $cartItem->getProduct()->getName(); ?></td>
                            <td><?php echo $cartItem->getQuantity(); ?></td>
                            <td>$<?php echo number_format($cartItem->getProduct()->getPrice() * (1 - $cartItem->getProduct()->getReduction() / 100), 2); ?></td>
                            <td><?php echo $cartItem->getProduct()->getReduction() . "%"; ?></td> <!-- Display the reduction -->
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
            <!-- Total Price -->
            <p>Total Price: $<?php echo number_format($_SESSION['cart']->getTotalSum(), 2); ?></p>
            <!-- Place Order Form -->
            <form method="post" action="index.php">
                <button type="button" onclick="placeOrder()" class="btn btn-success">Place Order</button>
            </form>
        <?php endif; ?>

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

    // Function to place an order
    function placeOrder() {
        // Clear the cart after placing the order
        // Add any other necessary logic here
        showMessage("Your order has been placed. Thank you!");
    }
</script>
</body>
</html>
