<?php
require_once ("../commun/autoload.php");
require_once ("../commun/ConnexionBD.php");
require_once ("../commun/Product.php");
require_once "Cart.php"; 

class CartManager
{public function addProductToCart(Product $product, $quantity, $userId)
    {
        try {
            // Create a new PDO instance
            $connexion = new ConnexionBD();
            $pdo = $connexion->getInstance();
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Prepare the SQL query to insert into "panier" table
            $sql = "INSERT INTO panier (user_id, article_id, quantity) VALUES (:userId, :productId, :quantity)";
            $stmt = $pdo->prepare($sql);
    
            // Bind the parameters
            $productId = $product->getId();
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity);
    
            // Execute the prepared statement
            $stmt->execute();
    
            // Close the PDO connection (optional, as PDO will close automatically)
            // $pdo = null;
    
            // Return true if the insertion was successful
            return true;
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            error_log("Error adding product to cart: " . $e->getMessage());
            return false;
        }
    }
    



   public function placeOrder($userId)
    {
        try {
            // Create a new instance of ConnexionBD
            $connexion = new ConnexionBD();
            $pdo = $connexion->getInstance();
            // Set PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Begin a transaction
            $pdo->beginTransaction();

            // Calculate the total price of the order
            $totalPrice = $_SESSION['cart']->getTotalPriceAfterReduction();

            // Insert a new order into the 'commande' table
            $date = date('Y-m-d H:i:s');
            $stmt = $pdo->prepare("INSERT INTO commande (user_id, date_commande, total_price) VALUES (:userId, :date, :totalPrice)");
            $stmt->execute([':userId' => $userId, ':date' => $date, ':totalPrice' => $_SESSION['cart']->getTotalPriceAfterReduction()]);
            $orderId = $pdo->lastInsertId(); // Get the ID of the inserted order
             // details_commande
            $copyStmt = $pdo->prepare("INSERT INTO details_commande (commande_id, article_id, quantity, prix_unitaire) 
            SELECT :orderId, p.article_id, p.quantity, a.price 
            FROM panier p 
            INNER JOIN article a ON p.article_id = a.id 
            WHERE p.user_id = :userId");
        $copyStmt->execute([':orderId' => $orderId, ':userId' => $userId]);


            // Commit the transaction
            $pdo->commit();

            // Clear the user's cart
            //$_SESSION['cart']->clear();

            // Return the order ID
            return $orderId;
        } catch (PDOException $e) {
            // Log or handle the exception
            echo "Error: " . $e->getMessage();
            return false;
        }}
    }
