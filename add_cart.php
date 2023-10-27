<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the cart exists in the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if a product ID and quantity were submitted
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = intval($_POST['quantity']);

        // Ensure the quantity is valid
        if ($quantity > 0) {
            // Add or update the product in the cart
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Update the quantity if the product is already in the cart
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Add the product to the cart with the given quantity
                $_SESSION['cart'][$product_id] = $quantity;
            }
        }
    }
}

// Redirect back to the previous page (product details page)
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    // If the HTTP_REFERER is not available, you can redirect to a default page.
    header('Location: product_description.php?product_id=' . $product_id);
}
