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

    public function __construct($id, $name, $size, $color, $price, $category, $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
        $this->color = $color;
        $this->price = $price;
        $this->category = $category;
        $this->stock = $stock;
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

    public function addToCart(Cart $cart, $quantity = 1)
    {
        return $cart->addProduct($this, $quantity);
    }
}
?>
