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
        // Display a form to update order status
        echo '<div class="container mt-5>';
        echo '<h1 class="text-center">Update Order Status</h1>';
        echo '<div class="card m-2">';
        echo '<div class="card-body">';
        echo '<form action="process_update.php" method="post">';
        echo '<label for="status">New Status:</label>';
        echo '<select name="status" id="status" required>';
        echo '<option value="In Process" selected>In Process</option>';
        echo '<option value="Approved">Approved</option>';
        echo '<option value="Not Approved">Not Approved</option>';
        echo '</select>';
        echo '<input type="hidden" name="order_id" value="' . $orderId . '">';
        echo '<button type="submit">Update Status</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="container mt-5">';
        echo '<div class="alert alert-danger">Order not found.</div>';
        echo '</div>';
    }
} else {
    echo '<div class="container mt-5">';
    echo '<div class="alert alert-danger">Invalid request.</div>';
    echo '</div>';
}
?>
