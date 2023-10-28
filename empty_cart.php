<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$_SESSION['cart'] = array();


header("Location: view_cart.php");
