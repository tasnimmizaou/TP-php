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

    // Getters and setters can be implemented here as needed

    public function addToCart($cart, $quantity)
    {
        return $cart->addProduct($this, $quantity);
    }

    public function removeFromCart($cart)
    {
        return $cart->removeProduct($this);
    }
}
?>

