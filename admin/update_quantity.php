<?php
include('includes/header.php');
include('includes/navbar.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include '../database/conn.php';
include '../includes/functions.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['new_quantity'];

    // Perform validation if needed

    // Update the quantity in the database
    $sql = "UPDATE products SET qty = $new_quantity WHERE id = $product_id";

    if ($conn->query($sql) === TRUE) {
        header('Location: product_list.php');
    } else {
        echo "Error updating quantity: " . $conn->error;
    }
}

include('includes/footer.php');
?>
