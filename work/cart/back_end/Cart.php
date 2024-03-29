session_start();

class Cart
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addToCart($productId, $quantity)
    {
        // Validate input
        if (!is_numeric($productId) || !is_numeric($quantity) || $quantity <= 0) {
            // Handle invalid input, maybe show an error message
            header('location: index.php?page=error');
            exit;
        }

        // Prepare the SQL statement to fetch the product from the database
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the product exists
        if (!$product) {
            // Handle non-existing product, maybe show an error message
            header('location: index.php?page=error');
            exit;
        }

        // Initialize or update the cart session variable
        $_SESSION['cart'][$productId] = isset($_SESSION['cart'][$productId]) ?
            $_SESSION['cart'][$productId] + $quantity : $quantity;

        // Redirect to cart page to prevent form resubmission
        header('location: index.php?page=cart');
        exit;
    }

    public function removeFromCart($productId)
    {
        // Validate input
        if (!is_numeric($productId)) {
            // Handle invalid input, maybe show an error message
            header('location: index.php?page=error');
            exit;
        }

        // Check if the product exists in the cart session variable and remove it
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        // Redirect to cart page
        header('location: index.php?page=cart');
        exit;
    }

    public function updateCart()
    {
        // Loop through post data to update quantities for products in cart
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'quantity') !== false && is_numeric($value)) {
                $productId = str_replace('quantity-', '', $key);
                $quantity = (int)$value;

                // Validate product ID and quantity
                if (is_numeric($productId) && isset($_SESSION['cart'][$productId]) && $quantity > 0) {
                    $_SESSION['cart'][$productId] = $quantity;
                }
            }
        }

        // Redirect to cart page to prevent form resubmission
        header('location: index.php?page=cart');
        exit;
    }

    // Send the user to the place order page if they click the Place Order button, also the cart should not be empty
    public function placeOrder()
    {
        if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            header('Location: index.php?page=placeorder');
            exit;
        }
    }
}

// Create an instance of Cart class
$cart = new Cart($pdo);

// Handle add to cart action
if (isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $cart->addToCart($product_id, $quantity);
}

// Handle remove from cart action
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $product_id = (int)$_GET['remove'];
    $cart->removeFromCart($product_id);
}

// Handle update cart action
if (isset($_POST['update'])) {
    $cart->updateCart();
}

// Handle place order action
$cart->placeOrder();
?>
