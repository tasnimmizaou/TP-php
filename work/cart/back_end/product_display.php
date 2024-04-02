<?php
require_once "retrieveprbyID.php";

// Array of product IDs
$productIds = [123, 124];

// Initialize an empty array to store product objects
$products = [];

// Retrieve product details for each ID
foreach ($productIds as $productId) {
    $product = getProductById($productId);
    if ($product) {
        $products[] = $product;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="product-container">
        <?php
        // Check if there are any products to display
        if (!empty($products)) {
            // Loop through each product and display its details
            foreach ($products as $product) {
                echo "<div class='product-details'>";
                echo "<h2>{$product->getName()}</h2>";
                echo "<p>Description: {$product->getDescription()}</p>";
                echo "<p>Price: {$product->getPrice()}</p>";
                echo "<p>Stock: {$product->getStock()}</p>";
                echo "<form action='index_cart.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='{$product->getId()}'>";
                echo "<input type='number' name='quantity' value='1' min='1'>";
                echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            // No products found
            echo "No products found.";
        }
        ?>
    </div>
</body>
</html>
