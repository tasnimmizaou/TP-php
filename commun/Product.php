<?php
class Product
{

    
    
        private $id;
        private $name;
        private $description;
        private $price;
        private $reduction;
        private $dateAdded;
        private $category;
        private $age;
        private $stock;
        private $image;
    
        // Constructeur
        public function __construct($id, $name, $description, $price, $reduction, $dateAdded, $category, $age, $stock, $image)
        {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->reduction = $reduction;
            $this->dateAdded = $dateAdded;
            $this->category = $category;
            $this->age = $age;
            $this->stock = $stock;
            $this->image = $image;
        }
    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }
    
    public function getDetailsUrl($detailsPage = 'details.php') {
        return $detailsPage . "?id=" . $this->id;
    }
    
    public function getImageDataUrl() {
        return "data:image/png;base64," . base64_encode($this->image);
    }

    public function getTotalPriceAfterReduction($quantity) {
        $originalPrice = $this->price * $quantity;
        $reducedPrice = $originalPrice * (1 - ($this->reduction / 100));
        return $reducedPrice;
    }
    public function getFormattedPrice() {
        return number_format($this->price, 2) . " dt"; // Assuming dt is the currency symbol
    }

    public function getReduction()
    {
        return $this->reduction;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getAge()
    {
        return $this->age;
    }

    

    public function getStock()
    {
        return $this->stock;
    }

    public function getImage()
    {
        return $this->image;
    
    }

    public function addToCart(Cart $cart, $quantity = 1)
    {
        return $cart->addProduct($this, $quantity);
    }
}
?>