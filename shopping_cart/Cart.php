<?php
require_once "stock_product.php";

class Cart
{
    private array $items = [];
    private int $userId;
    private static $instance = null;

    public function __construct(int $userId)
    {
        $this->$userId= $userId;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalSum(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }
        return $total;
    }

    public function getTotalPriceAfterReduction(): float
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


    public function removeProductById($productId): void
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

    public function addProduct($product, $quantity): void
    {
        // Check if the product is already in the cart
        foreach ($this->items as $item) {
            if ($item->getProduct()->getId() == $product->getId()) {
                // If the product is already in the cart, increase the quantity
                $item->increaseQuantity($quantity);

                // Update product stock in the database
                stock_product::updateProductStock($product->getId(), $product->getStock() - $quantity);
                return;
            }
        }

        // If the product is not in the cart, add it
        $this->items[] = new CartItem($product, $quantity);

        // Update product stock in the database
        stock_product::updateProductStock($product->getId(), $product->getStock() - $quantity);
    }

    /*public function clear(): void
    {
        $this->items = [];
    }*/
    public static function getCartInstance(int $userId): Cart
    {
        // Vérifie si une instance existe déjà, sinon crée une nouvelle instance
        if (self::$instance === null) {
            self::$instance = new self($userId);
        }
        return self::$instance;
    }

    
    
}


?>
