<?php
require_once "ConnexionBD.php";
require_once "autoload.php";
class stock_product
{
    public static function updateProductStock($productId, $newStock)
    {
        try {
            $pdo = ConnexionBD::getInstance();
            $stmt = $pdo->prepare("UPDATE article SET stock = :newStock WHERE id = :productId");
            $stmt->bindParam(":newStock", $newStock, PDO::PARAM_INT);
            $stmt->bindParam(":productId", $productId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>
