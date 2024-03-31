<?php

require_once "autoload.php";
require_once "ConnexionBD.php";
require_once "cart_operations.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet" />
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<section>
    <div class="container">
       

        <!-- Display available products -->
        <h2>Products</h2>
        <ul>
        <?php foreach ([1, 2, 3] as $productId): ?>
    <?php $product = getProductById($productId); ?>
    <?php if ($product): ?>
        <li>
            <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                <label>
                    <?php echo $product->getName(); ?> -
                    <?php if ($product->getStock() > 0): ?>
                        $<?php echo $product->getPrice(); ?>
                    <?php else: ?>
                        Not Available
                    <?php endif; ?>
                </label>
                <?php if ($product->getStock() > 0): ?>
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                <?php endif; ?>
            </form>
        </li>
    <?php endif; ?>
<?php endforeach; ?>

        </ul>
