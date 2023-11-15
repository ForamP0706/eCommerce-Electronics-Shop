<!-- update_order.php -->
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

    $orderDetails = get_order_details($conn, $orderId);

    if ($orderDetails) {
        // here we have displayed a form to update order status
        echo '<div class="container mt-5>';
        echo '<h1 class="text-center">Update Order Status</h1>';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<form action="process_update.php" method="post">';
        echo '<label for="status">New Status:</label>';
        echo '<input type="text" name="status" id="status" required>';
        echo '<input type="hidden" name="order_id" value="' . $orderId . '">';
        echo '<button type="submit">Update Status</button>';
        echo '</form>';
       echo  '</div>';
       echo  '</div>';
       echo  '</div>';
    } else {
        echo 'Order not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
