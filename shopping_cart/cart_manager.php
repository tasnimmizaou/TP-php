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
         
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Prepare the SQL query to insert into "panier" table
            $sql = "INSERT INTO panier (user_id, article_id, quantity) VALUES (:userId, :productId, :quantity)";
            $stmt = $pdo->prepare($sql);
    
         
            $productId = $product->getId();
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity);
    
           
            $stmt->execute();
    
            // Close the PDO connection 
            // $pdo = null;
    
           
            return true;
        } catch (PDOException $e) {
            
            error_log("Error adding product to cart: " . $e->getMessage());
            return false;
        }
    }
    



   public function placeOrder($userId)
    {
        try {
            
            $connexion = new ConnexionBD();
            $pdo = $connexion->getInstance();
          
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          
            $pdo->beginTransaction();

        
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


           
            $pdo->commit();

            // Clear the user's cart
            //$_SESSION['cart']->clear();

            
            return $orderId;
        } catch (PDOException $e) {
           
            echo "Error: " . $e->getMessage();
            return false;
        }}
    }
