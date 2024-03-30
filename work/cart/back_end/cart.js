// Function to update the number of items in the cart
function updateProductNumber(productId, price, isIncreasing) {
    const productInput = document.getElementById(productId + '-number');
    let productNumber = productInput.value;
    if (isIncreasing) {
        productNumber = parseInt(productNumber) + 1;
    } else if (productNumber > 0) {
        productNumber = parseInt(productNumber) - 1;
    }
    productInput.value = productNumber;
    // Update product total 
    const productTotal = document.getElementById(productId + '-total');
    productTotal.innerText = productNumber * price;
    calculateTotal();
}

// Function to get input value
function getInputValue(productId) {
    const productInput = document.getElementById(productId + '-number');
    const productNumber = parseInt(productInput.value);
    return productNumber;
}

// Function to calculate total
function calculateTotal() {
    let totalPrice = 0;
    // Iterate over each product to calculate the total price
    const products = ['phone', 'case']; // Add more products here if needed
    products.forEach(product => {
        const productPrice = parseFloat(document.getElementById(product + '-price').innerText);
        totalPrice += getInputValue(product) * productPrice;
    });
    // Update the total price on the HTML 
    document.getElementById('total-price').innerText = totalPrice.toFixed(2);
}

// Event listeners for increment and decrement buttons
['case', 'phone'].forEach(product => {
    document.getElementById(product + '-plus').addEventListener('click', function() {
        updateProductNumber(product, parseFloat(document.getElementById(product + '-price').innerText), true);
    });

    document.getElementById(product + '-minus').addEventListener('click', function() {
        updateProductNumber(product, parseFloat(document.getElementById(product + '-price').innerText), false);
    });
});

// Function to display a popup message
function showMessage(message) {
    alert(message); // Display an alert with the message
}

// Function to place an order
function placeOrder() {
    // Clear the cart after placing the order
    // Add any other necessary logic here
    showMessage("Your order has been placed. Thank you!");
}
