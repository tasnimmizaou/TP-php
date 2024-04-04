<?php
require_once "stock_product.php";
class Cart
{
    private $items = [];
   

    // Constructor to initialize user_id
    public function __construct(private $user_id)
    {
    }

    public function getItems()
    {
        return $this->items;
    }
    public function getTotalSum()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }
        return $total;
    }


public function getTotalPriceAfterReduction()
{
    $totalPrice = 0;

    foreach ($this->items as $item) {
        $product = $item->getProduct();
        $quantity = $item->getQuantity();
        $originalPrice = $product->getPrice() * $quantity;
        $reductionPercentage = $product->getReduction();
        $reducedPrice = $originalPrice * (1 - $reductionPercentage / 100);
        $totalPrice += $reducedPrice;
    }

    return $totalPrice;
}


public function removeProductById($productId)
{
    foreach ($this->items as $key => $item) {
        if ($item->getProduct()->getId() == $productId) {
            // Increase the stock when removing the product
            $product = $item->getProduct();
            $newStock = $product->getStock() + $item->getQuantity();
            stock_product::updateProductStock($productId, $newStock);

            // Remove the product from the cart
            unset($this->items[$key]);
            break;
        }
    }
    // Reset array keys after removing an item
    $this->items = array_values($this->items);
}


    public function addProduct($product, $quantity = 1)
    {
        // Check if the product is already in the cart
        foreach ($this->items as $item) {
            if ($item->getProduct() == $product) {
                // If the product is already in the cart, increase the quantity
                $item->increaseQuantity($quantity);
                return;
            }
        }

        // If the product is not in the cart, add it
        $this->items[] = new CartItem($product, $quantity);

        // Update product stock in the database
        stock_product::updateProductStock($product->getId(), $product->getStock() - $quantity);
    }

   
    public function clear()
    {
        $this->items = [];
    }

    
}

?>