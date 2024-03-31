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

    

    public function getDetailsUrl($detailsPage = 'details.php') {
        return $detailsPage . "?id=" . $this->id;
    }

    

    // Méthodes pour obtenir les attributs de l'article
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getFormattedPrice() {
        return number_format($this->price, 2) . " dt"; // Assuming dt is the currency symbol
    }
    public function getReduction() {
        return $this->reduction;
    }

    public function getDateAjout() {
        return $this->date_ajout;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getAge() {
        return $this->age;
    }

    public function getSaison() {
        return $this->saison;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getImageDataUrl() {
        return "data:image/png;base64," . base64_encode($this->image);
    }
}


    ?>