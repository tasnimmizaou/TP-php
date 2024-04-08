<?php
require_once('Product.php');
require_once('../commun/ConnexionBD.php');


class ArticleManager {
    private $pdo;

    public function __construct() {
        
        $connexion = new ConnexionBD();
        $this->pdo = $connexion->getInstance();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getArticles($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                
                 $stmt->bindParam($key, $value);
                
            }
            $stmt->execute();
            $articles = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $articles[] = new Product($row['id'],$row['name'], $row['description'], $row['price'], $row['reduction'], $row['date_ajout'], $row['category'], $row['age'], $row['stock'], $row['image']);
            }
            
            return $articles;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function getarticlebyid($id) {
        $sql = "SELECT * FROM article WHERE id = :id";
        $params = [':id' => $id];
        return $this->getArticles($sql, $params);
    }
    public function getAllArticles() {
            $sql = "SELECT * FROM article";
            return $this->getArticles( $sql );}
          
    }
    ?>