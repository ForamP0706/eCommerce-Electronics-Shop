<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5 vh-100">
    <div class="cart-container border rounded p-4">
        <h1>Your Shopping Cart</h1>
        <div id="cart-table"></div>
        <a href="checkout.php" class="btn btn-primary mt-4 mb-4 mr-4">Proceed to Checkout</a>
        <button onclick="localStorage.setItem('cart','{}'), location.reload();" class="btn btn-danger mt-4 mb-4 mr-4">Empty Cart</button>
        <a href="shop.php" class="btn btn-secondary mt-4 mb-4 mr-4">Continue Shopping</a>
    </div>
</div>

<script>
    const cartData = localStorage.getItem('cart') || '{}';

if (cartData) {
    fetch('view_cart_api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ cartData: JSON.parse(cartData) })
    })
    .then(response => response.json())
    .then(data => {
        const cartContent = document.getElementById('cart-table');
        cartContent.innerHTML = renderCart(data);
    })
    .catch(error => console.error('Error:', error));
} else {
    console.log('Cart data not found in localStorage.');
}
function renderCart(cartItems) {
    let totalPrice = 0;
    let cartHTML = '<table width="100%">';
    cartHTML += '<thead><tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Action</th><th>Subtotal</th></tr></thead>';
    cartHTML += '<tbody>';

    cartItems.forEach((product) => {
        const subtotal = product.price * product.quantity;
        totalPrice += subtotal;

        cartHTML += `<tr>
        
                        <td>${product.prod_name.slice(0, 30)}</td>
                        <td>$${product.price}</td>
                        <td><input type="number" id="quantity${product.id}" value="${product.quantity}"></td>
                        <td><button onclick="updateQuantity(${product.id})" class="btn btn-primary mr-2 mb-2" style="padding:8px;">Update</button>
                            <button onclick="removeProduct(${product.id})" class="btn btn-danger mr-2 mb-2" style="padding:8px;">Remove</button></td>
                        <td>$${subtotal}</td>
                       
                    </tr>`;
                   
    });

    const tax = totalPrice * 0.13;
    const totalPriceWithTax = totalPrice + tax;

    cartHTML += `<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>SubTotal :</td>
                    <td>$${totalPrice}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>GST/HST Tax(13%) :</td>
                    <td>$${tax}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total :</strong></td>
                    <td><strong>$${totalPriceWithTax.toFixed(2)}</strong></td>
                </tr>`;

    cartHTML += '</tbody></table>';
    return cartHTML;
}
function updateQuantity(id) {
  const cart = JSON.parse(localStorage.getItem('cart') || '{}');
    cart[id] = parseInt(document.getElementById('quantity'+id).value);
  localStorage.setItem('cart', JSON.stringify(cart));
  location.reload();
}
function removeProduct(id){
    const cart = JSON.parse(localStorage.getItem('cart') || '{}');
    delete cart[''+id];
  localStorage.setItem('cart', JSON.stringify(cart));
  location.reload();
}
</script>
<?php include('includes/footer.php');

?>