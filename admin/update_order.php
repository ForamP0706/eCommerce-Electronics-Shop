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
        echo '<div class="container mt-5">';
        echo '<h1 class="text-center mb-4">Update Order Status</h1>';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<form action="process_update.php" method="post">';
        
        echo '<div class="mb-3">';
        echo '<label for="status" class="form-label">New Status:</label>';
        echo '<select name="status" id="status" class="form-select" required>';
        echo '<option value="In Process" selected>In Process</option>';
        echo '<option value="Approved">Approved</option>';
        echo '<option value="Not Approved">Not Approved</option>';
        echo '</select>';
        echo '</div>';
        
        echo '<input type="hidden" name="order_id" value="' . $orderId . '">';
        
        echo '<div class="d-grid">';
        echo '<button type="submit" class="btn btn-primary">Update Status</button>';
        echo '</div>';
        
        echo '</form>';
        echo '</div>';
        echo '</div>';
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
