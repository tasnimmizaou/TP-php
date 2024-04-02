<?php
require_once('Article.php');

class ArticleManager {
    private $db;

    public function __construct(DatabaseConnection $db) {
        $this->db = $db;
    }

    public function getArticles($sql){
        $result = $this->db->query($sql);
        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = new Article($row);
        }
        return $articles;
    }

    public function getarticlebyid($id) {
        $sql = "SELECT * FROM article WHERE id = $id";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows > 0) {
            $articleData = $result->fetch_assoc();
            return new Article($articleData); // Crée un objet Article 
        } else {
            return null; //in case there was an error 
        }
    }
      
      
    public function getAllArticles() {
        $sql = "SELECT * FROM article";
        return $this->getArticles($sql);
    }
    public function filterBycategory($category) {
        $sql = "SELECT * FROM article where category =$category" ;
        return $this->getArticles($sql);
    }

    public function filterByage($age) {
        $sql = "SELECT * FROM article where age =$age" ;
        return $this->getArticles($sql);
    }

    public function filterBysaison($saison) {
        $sql = "SELECT * FROM article where saison = $saison" ;
        return $this->getArticles($sql);
    }

    public function filterByname($name1 , $name2) {
        $sql = "SELECT * FROM article where name LIKE   '%".$name1."%' OR LIKE   '%".$name2."%'" ;
        return $this->getArticles($sql);
    }

    public function filterByprice($min , $max) {
        $sql = "SELECT * FROM article where price BETWEEN $min AND $max";
        return $this->getArticles($sql);
    }

}

?>

