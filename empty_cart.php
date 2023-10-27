<?php
session_start();

// Ensure the cart exists in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Empty the cart by setting it to an empty array
$_SESSION['cart'] = array();

// Redirect the user back to the view cart page
header("Location: view_cart.php");
