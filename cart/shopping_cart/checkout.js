// checkout.js

document.addEventListener("DOMContentLoaded", function() {
    // Select the checkout button
    var checkoutBtn = document.getElementById("checkoutBtn");

    // Add click event listener to the button
    checkoutBtn.addEventListener("click", function() {
        // Redirect to payer.php when the button is clicked
        window.location.href = "payer.php";
    });
});
