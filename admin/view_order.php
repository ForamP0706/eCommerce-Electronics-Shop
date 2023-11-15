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

//   function to get order details by id
    $orderDetails = get_order_details($conn, $orderId);

    if ($orderDetails) {
        // display order details here
        echo '<div class="container mt-5">';
        echo '<h1 class="text-center">Order Receipt</h1>';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<p class="card-text"><strong>Order ID:</strong> ' . $orderDetails['order_id_index'] . '</p>';
        echo '<p class="card-text"><strong>Total Amount:</strong> $' . number_format($orderDetails['order_total_amount'], 2) . '</p>';
        echo '<p class="card-text"><strong>Status:</strong> ' . ($orderDetails['order_status'] ? $orderDetails['order_status'] : 'Not available') . '</p>';
        echo '<p class="card-text"><strong>Order Date:</strong> ' . $orderDetails['order_date'] . '</p>';
        echo '<p class="card-text"><strong>Delivery Address ID:</strong> ' . $orderDetails['delivery_address_id'] . '</p>';
        echo '<p class="card-text"><strong>Customer ID:</strong> ' . $orderDetails['customer_id'] . '</p>';
        echo '<p class="card-text"><strong>Created At:</strong> ' . $orderDetails['created_at'] . '</p>';
        echo '<p class="card-text"><strong>Updated At:</strong> ' . $orderDetails['updated_at'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
         // for printing rececipt
         echo '<div class="text-center mt-3">';
         echo '<button class="btn btn-primary" onclick="window.print()">Print Receipt</button>';
         echo '</div>';
    } else {
        echo 'Order not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
