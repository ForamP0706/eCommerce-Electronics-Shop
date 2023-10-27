<?php
session_start();

// Ensure the cart exists in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if a POST request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            // Ensure the quantity is a positive integer
            $quantity = intval($quantity);
            if ($quantity > 0) {
                // Update the quantity in the cart
                $_SESSION['cart'][$product_id] = $quantity;
            } else {
                // If the quantity is zero or negative, remove the item from the cart
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }

    if (isset($_POST['remove'])) {
        foreach ($_POST['remove'] as $product_id => $remove) {
            // Remove the item from the cart
            unset($_SESSION['cart'][$product_id]);
        }
    }
}

// Redirect the user back to the view cart page
header("Location: view_cart.php");
