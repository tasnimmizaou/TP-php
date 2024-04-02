<?php

class Article {
    public $id;
    public $name;
    public $description;
    public $price;
    public $reduction;
    public $date_ajout;
    public $category;
    public $age;
    public $saison;
    public $stock;
    public $image;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->reduction = $data['reduction'];
        $this->date_ajout = $data['date_ajout'];
        $this->category = $data['cathegory']; // Ensure correct spelling
        $this->age = $data['age'];
        $this->saison = $data['saison'];
        $this->stock = $data['stock'];
        $this->image = $data['image'];
    }

    public function getFormattedPrice() {
        return number_format($this->price, 2) . " dt"; // Assuming dt is the currency symbol
    }

    public function getDetailsUrl($detailsPage = 'details.php') {
        return $detailsPage . "?id=" . $this->id;
    }

    public function getImageDataUrl() {
        return "data:image/png;base64," . base64_encode($this->image);
    }
}

class DatabaseConnection {
    private $conn;

    public function __construct($host, $username, $password, $database) {
        $this->conn = new mysqli($host, $username, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error executing query: " . $this->conn->error);
        }
        return $result;
    }

    public function close() {
        $this->conn->close();
    }
}

class ArticleManager {
    private $db;

    public function __construct(DatabaseConnection $db) {
        $this->db = $db;
    }

    public function getAllArticles() {
        $sql = "SELECT * FROM article";
        $result = $this->db->query($sql);
        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = new Article($row);
        }
        return $articles;
    }

    // Add method for filtering articles based on specific criteria (in filtre.php)
}
