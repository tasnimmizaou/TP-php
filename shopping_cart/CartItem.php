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

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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

    public function getTotalPriceAfterReduction(): float
    {
        $originalPrice = $this->product->getPrice() * $this->quantity;
        $reductionPercentage = $this->product->getReduction();
        $reducedPrice = $originalPrice * (1 - $reductionPercentage / 100);
        return $reducedPrice;
    }
}

?>