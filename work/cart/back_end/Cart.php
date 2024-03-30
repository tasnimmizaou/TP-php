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

    public function removeProductById($productId)
    {
        foreach ($this->items as $key => $item) {
            if ($item->getProduct()->getId() == $productId) {
                unset($this->items[$key]);
                break;
            }
        }

        $this->items = array_values($this->items);
    }

    public function getTotalSum()
    {
        $totalSum = 0;

        foreach ($this->items as $item) {
            $product = $item->getProduct();
            if ($product !== null) {
                $totalSum += $item->getQuantity() * $product->getPrice();
            }
        }

        return $totalSum;
    }

    public function isEmpty()
    {
        return empty($this->items);
    }

    public function clear()
    {
        $this->items = [];
    }
}
