window.onload = function () {
    var size = window.screen.width;
    console.log(size);
    if (size < 800) {
        var cloneFoodItems = document.getElementById('food-items').cloneNode(true);
        var cloneCartPage = document.getElementById('cart-page').cloneNode(true);
        document.getElementById('food-items').remove();
        document.getElementById('cart-page').remove();
        document.getElementById('category-header').after(cloneFoodItems);
        document.getElementById('food-items').after(cloneCartPage);
        addEvents()
    }
    if (size > 800) {
        var cloneFoodItems = document.getElementById('food-items').cloneNode(true);
        document.getElementById('food-items').remove();
        document.getElementById('header').after(cloneFoodItems);

        var cloneCartPage = document.getElementById('cart-page').cloneNode(true);
        document.getElementById('cart-page').remove();
        document.getElementById('food-items').after(cloneCartPage);
        addEvents()
    }
    
    // Add event listeners after manipulating the DOM
    addEvents();
};

function addEvents() {
    document.querySelectorAll('.add-to-cart').forEach(item => {
        item.addEventListener('click', addToCart);
    });
    document.querySelectorAll('.increase-item').forEach(item => {
        item.addEventListener('click', incrementItem);
    });
    document.querySelectorAll('.decrease-item').forEach(item => {
        item.addEventListener('click', decrementItem);
    });
    
    // Move the checkout event listener here
    document.getElementById('checkout').addEventListener('click', function() {
         // Create a JSON object containing the order details
         var orderDetails = {
            items: itemNames,
            totalPrice: calculateTotalPrice(), 
            userAddress: document.getElementById('add-address').innerText
        };
    
        // Send the order details to a PHP script using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'user_order.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
    
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Handle successful response from the server
                    console.log('Order successfully inserted into database');
                    // Redirect to the order confirmation page
                    window.location.href = 'user_order.php'; // Replace 'order_confirmation.php' with the actual URL of your confirmation page
                } else {
                    // Handle errors
                    console.error('Error occurred during checkout:', xhr.status);
                }
            }
        };
    
        xhr.send(JSON.stringify(orderDetails));
    });
}