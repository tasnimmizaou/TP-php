<?php
class Product
{
    private $id;
    private $name;
    private $size;
    private $color;
    private $price;
    private $category;
    private $stock;
    private $reduction; // Ajout de l'attribut réduction

    public function __construct($id, $name, $size, $color, $price, $category, $stock, $reduction = 0) // Ajout du paramètre $reduction avec une valeur par défaut de 0
    {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
        $this->color = $color;
        $this->price = $price;
        $this->category = $category;
        $this->stock = $stock;
        $this->reduction = $reduction; // Initialisation de l'attribut réduction
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getReduction() // Méthode pour récupérer la réduction
    {
        return $this->reduction;
    }

    public function addToCart(Cart $cart, $quantity = 1)
    {
        return $cart->addProduct($this, $quantity);
    }
}
?>
