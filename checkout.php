<?php
include('includes/header.php');
include('includes/navbar.php');

?>

<div class="container mt-5">
    <h1>Checkout</h1>
<div id="form-parent">
    
        <form name="first">
          
            <div class="form-group">
                <label for="delivery_address">Delivery Address</label>
                <input type="text" class="form-control" name="delivery_address" required>
            </div>
            <div class="form-group">
                <label for="unit_number">Unit Number</label>
                <input type="text" class="form-control" name="unit_number">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" required>
            </div>
            <div class="form-group">
                <label for="province">Province</label>
                <input type="text" class="form-control" name="province" required>
            </div>
            <div class="form-group">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="zip" required>
            </div>
        </form>
        <form id="stripe-payment-form" class="hidden">
            <input type='hidden' id='publishable_key' value='<?php echo STRIPE_PUBLISHABLE_KEY;?>'>
            <div class="form-group">
                <label><strong>Full Name</strong></label>
                <input type="text" id="fullname" class="form-control" maxlength="50" required disabled value="<?=$_SESSION['first_name'].' '.$_SESSION['last_name']?>">
            </div>
            <div class="form-group">
                <label><strong>E-Mail</strong></label>
                <input type="email" id="email" class="form-control" maxlength="50" required disabled value="<?=$_SESSION['username']?>">
            </div>
            <h3>Enter Credit Card Information</h3>
            <div id="stripe-payment-element">
            </div>

            <button id="submit-button" class="pay">
                <div class="spinner hidden" id="spinner"></div>
                <span id="submit-text">Complete Order</span>
            </button>
        </form>
        <div id="payment_processing" class="hidden">
            <span class="loader"></span> Please wait! Your payment is processing...
        </div>

        <div id="payment-reinitiate" class="hidden">
            <button class="btn btn-primary" onclick="reinitiateStripe()">Reinitiate Payment</button>
        </div>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var description = 'All Items Successfully Ordered';
        </script>
        <script src="assets/js/stripe-checkout.js" defer></script>
</div>

    <a href="view_cart.php" class="btn btn-secondary mb-4 mt-4">View Cart</a>
</div>
<script>
    if(!localStorage.getItem('cart')){
        document.getElementById('form-parent').innerHTML = 'Your cart is empty';
    }
</script>
<?php include('includes/footer.php');
session_write_close();
?>