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

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function increaseQuantity($amount = 1)
    {
        if ($this->product->getAvailableQuantity() >= $this->quantity + $amount) {
            $this->quantity += $amount;
        } else {
            // Handle case where quantity exceeds available stock, maybe show an error message
            // For now, we'll keep the quantity unchanged
        }
    }

    public function decreaseQuantity($amount = 1)
    {
        if ($this->quantity - $amount > 0) {
            $this->quantity -= $amount;
        } else {
            // Handle case where quantity becomes less than 0 or 0
            // For now, we'll keep the quantity unchanged
        }
    }
}

?>
