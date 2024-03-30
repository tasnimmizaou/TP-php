<?php

require_once "Product.php";
require_once "Cart.php";
require_once "CartItem.php";

$product1 = new Product(1, "iPhone 11", "Size", "Color", 2500, "Category", 10);
$product2 = new Product(2, "M2 SSD", "Size", "Color", 400, "Category", 10);
$product3 = new Product(3, "Samsung Galaxy S20", "Size", "Color", 3200, "Category", 10);
$cart = new Cart();
$cartItem1 = $cart->addProduct($product1, 1);
$cartItem2 = $product2->addToCart($cart, 1);
echo "Number of items in cart: " . PHP_EOL;
echo $cart->getTotalQuantity() . PHP_EOL; // This must print 2
echo "Total price of items in cart: " . PHP_EOL;
echo $cart->getTotalSum() . PHP_EOL; // This must print 2900

$cartItem2->increaseQuantity();
$cartItem2->decreaseQuantity();

echo "Number of items in cart: " . PHP_EOL;
echo $cart->getTotalQuantity() . PHP_EOL; // This must print 4

echo "Total price of items in cart: " . PHP_EOL;
echo $cart->getTotalSum() . PHP_EOL; // This must print 3700

$cart->removeProduct($product1);

echo "Number of items in cart: " . PHP_EOL;
echo $cart->getTotalQuantity() . PHP_EOL; // This must print 1
