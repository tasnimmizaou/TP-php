<?php
require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "cart_operations.php";
require_once "add_to_cart.php";

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CartManager
{
    public function addProductToCart(Product $product, $quantity, $userId)
    {
        try {
            // Create a new PDO instance
            $connexion = new ConnexionBD();
            $pdo = $connexion->getInstance();
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Prepare the SQL query
            $sql = "INSERT INTO panier (user_id, article_id, quantity) VALUES (:userId, :productId, :quantity)";
            
            // Prepare the statement
            $stmt = $pdo->prepare($sql);
            
            // Bind the parameters
            $stmt->bindParam(':userId', $userId);
            
            $productId = $product->getId(); // Assign the return value of getId() to a variable
            $stmt->bindParam(':productId', $productId, PDO::PARAM_INT); // Pass the variable instead

            $stmt->bindParam(':quantity', $quantity);
            
            // Execute the prepared statement
            $stmt->execute();
            
            // Close the PDO connection
            $pdo = null;
            
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

// Check if the form is submitted for adding a product to the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Retrieve the product ID from the form
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $product = getProductById($productId);

    // Check if product exists before adding to cart
    if ($product) {
        // Check if the cart session variable exists, otherwise create it
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = new Cart();
        }

        $cart = $_SESSION['cart'];
        $itemFound = false;

        // Check if the product already exists in the cart
        foreach ($cart->getItems() as $item) {
            if ($item->getProduct()->getId() == $productId) {
                $itemFound = true;
                $item->setQuantity($item->getQuantity() + $quantity);
                break;
            }
        }

        if (!$itemFound) {
            // If the product is not in the cart, add it as a new item
            $_SESSION['cart']->addProduct($product, $quantity);
        }

        // Update product stock in the database
        stock_product::updateProductStock($productId, $product->getStock() - $quantity);
    } else {
        // Handle error (e.g., product not found)
        echo "Product not found.";
    }
}
?>
