<?php
class Product
{


    // Constructeur
    public function __construct( private $id,  private $name, private  $description, private $price, private $reduction,  private $dateAdded,  private $category, private  $age,  private $season,  private $stock,  private $image)
    {}
    

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

    public function getTotalPriceAfterReduction($quantity) {
        $originalPrice = $this->price * $quantity;
        $reducedPrice = $originalPrice * (1 - ($this->reduction / 100));
        return $reducedPrice;
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

    public function getSeason()
    {
        return $this->season;
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
