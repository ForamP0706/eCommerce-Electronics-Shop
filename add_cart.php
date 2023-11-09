<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = intval($_POST['quantity']);

      
        if ($quantity > 0) {
           
            if (array_key_exists($product_id, $_SESSION['cart'])) {
              
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
              
                $_SESSION['cart'][$product_id] = $quantity;
            }
        }
    }
}


if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
   
    header('Location: product_description.php?product_id=' . $product_id);
}
