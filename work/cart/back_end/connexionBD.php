<?php

class ConnexionBD
{
    private static $_dbname = "girlhood";
    private static $_user = "root";
    private static $_pwd = "";
    private static $_host = "localhost";
    private static $_bdd = null;

    public function __construct()
    {
        try {
            self::$_bdd = new PDO("mysql:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8", self::$_user, self::$_pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$_bdd) {
            new ConnexionBD();
        }
        return (self::$_bdd);
    }

    public static function updateProductStock($productId, $newStock)
    {
        try {
            $pdo = self::getInstance();
            $stmt = $pdo->prepare("UPDATE article SET stock = :newStock WHERE id = :productId");
            $stmt->bindParam(":newStock", $newStock, PDO::PARAM_INT);
            $stmt->bindParam(":productId", $productId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>