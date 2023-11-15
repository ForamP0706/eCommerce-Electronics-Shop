<!-- delete_order.php -->
<?php
include('includes/header.php');
include('includes/navbar.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include '../database/conn.php';

?>
<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
// function to delete an order by id 
 
    $result = delete_order($conn, $orderId);

    if ($result) {
        echo 'Order deleted successfully.';
    } else {
        echo 'Failed to delete order.';
    }
} else {
    echo 'Invalid request.';
}
?>
