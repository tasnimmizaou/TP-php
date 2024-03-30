<?php

class Cart
{
    private $items = [];
    
    public function getItems()
    {
        return $this->items;
    }

    public function addProduct($product, $quantity)
    {
        foreach ($this->items as $item) {
            if ($item->getProduct() == $product) {
                $item->increaseQuantity($quantity);
                return $item;
            }
        }

        $this->items[] = new CartItem($product, $quantity);

        return end($this->items);
    }

    public function getTotalQuantity()
    {
        $totalQuantity = 0;

        foreach ($this->items as $item) {
            $totalQuantity += $item->getQuantity();
        }

        return $totalQuantity;
    }

    public function getTotalSum()
    {
        $totalSum = 0;

        foreach ($this->items as $item) {
            $totalSum += $item->getProduct()->getPrice() * $item->getQuantity();
        }

        return $totalSum;
    }

    public function removeProduct($product)
    {
        $key = array_search($product, array_column($this->items, 'product'));

        if ($key !== false) {
            unset($this->items[$key]);
        }
    }
}
?>
