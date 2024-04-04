<?php
require_once "cart_operations.php";
require_once "autoload.php";
require_once "ConnexionBD.php";

// Function to retrieve product by ID from the database
function getProductById($productId)
{
    try {
        $pdo = ConnexionBD::getInstance(); // Get database connection instance
        $stmt = $pdo->prepare("SELECT * FROM article WHERE id = :productId");
        $stmt->bindParam(":productId", $productId, PDO::PARAM_INT);
        $stmt->execute();
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($productData) {
            // Create a new Product object with retrieved data
            return new Product(
                $productData['id'],
                $productData['name'],
                $productData['description'],
                $productData['price'],
                $productData['reduction'], // Added reduction here
                $productData['date_ajout'],
                $productData['cathegory'],
                $productData['age'],
                $productData['stock'],
                $productData['image']
            );
        } else {
            return null; // Return null if the product is not found
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return null;
    }
}
?>
