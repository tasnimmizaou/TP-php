document.addEventListener("DOMContentLoaded", function() {
    // Sample product data
    const products = [
        { id: 1, name: "Product 1", price: 10 },
        { id: 2, name: "Product 2", price: 20 },
        { id: 3, name: "Product 3", price: 30 }
    ];

    const cart = [];

    // Function to display products
    function displayProducts() {
        const productsContainer = document.getElementById("products");
        productsContainer.innerHTML = "";

        products.forEach(product => {
            const productDiv = document.createElement("div");
            productDiv.classList.add("product");
            productDiv.innerHTML = `
                <p>${product.name} - $${product.price}</p>
                <button onclick="addToCart(${product.id})">Add to Cart</button>
            `;
            productsContainer.appendChild(productDiv);
        });
    }

    // Function to add product to cart
    function addToCart(productId) {
        const product = products.find(p => p.id === productId);
        if (product) {
            cart.push(product);
            displayCart();
        }
    }

    // Function to display cart
    function displayCart() {
        const cartContainer = document.getElementById("cart");
        cartContainer.innerHTML = "";

        cart.forEach(product => {
            const cartItemDiv = document.createElement("div");
            cartItemDiv.classList.add("cart-item");
            cartItemDiv.innerHTML = `
                <p>${product.name} - $${product.price}</p>
            `;
            cartContainer.appendChild(cartItemDiv);
        });

        const totalPrice = cart.reduce((total, product) => total + product.price, 0);
        const totalDiv = document.createElement("div");
        totalDiv.classList.add("cart-total");
        totalDiv.textContent = `Total: $${totalPrice}`;
        cartContainer.appendChild(totalDiv);
    }

    // Initialize
    displayProducts();
});
