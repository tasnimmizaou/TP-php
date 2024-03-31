<?php
require_once "product_display.php";
require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "cart_operations.php";
?>

<?php
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
?>
