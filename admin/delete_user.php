<?php
include '../database/conn.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    // Perform the deletion
    if (delete_customer($conn, $customer_id)) {
        // Optionally, you can redirect or show a success message
        header('Location: user_managment.php');
        exit;
    } else {
        // Handle the case where the deletion fails (e.g., show an error message)
        echo "Deletion failed!";
    }
}
?>
