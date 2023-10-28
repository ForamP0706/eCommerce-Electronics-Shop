<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
          
            $quantity = intval($quantity);
            if ($quantity > 0) {
              
                $_SESSION['cart'][$product_id] = $quantity;
            } else {
               
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }

    if (isset($_POST['remove'])) {
        foreach ($_POST['remove'] as $product_id => $remove) {
     
            unset($_SESSION['cart'][$product_id]);
        }
    }
}


header("Location: view_cart.php");
