<?php

class CartItem
{
    private $product;
    private $quantity;

    public function __construct($product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function increaseQuantity($quantity)
    {
        $this->quantity += $quantity;
    }

    public function decreaseQuantity()
    {
        $this->quantity--;

        if ($this->quantity < 1) {
            $this->quantity = 1;
        }
    }
}
?>
