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

?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];

    // Updating order status using a function
    $updated = update_order_status($conn, $orderId, $newStatus);

    if ($updated) {
       
        header('Location: Order_Management.php');
    } else {
        echo 'Error updating order status.';
    }
}
?>
