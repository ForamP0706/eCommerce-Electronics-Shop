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

    // Function to get order details by id
    $orderDetails = get_order_details($conn, $orderId);

    if ($orderDetails) {
        // Get customer details
        $customerId = $orderDetails['customer_id'];
        $customerDetails = get_customer_details($conn, $customerId);

        // Get delivery address details
        $deliveryAddressId = $orderDetails['delivery_address_id'];
        $addressDetails = get_address_details($conn, $deliveryAddressId);
        // Display order details
        echo '<div class="container mt-5">';
        echo '<h1 class="text-center">Order Receipt</h1>';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<p class="card-text"><strong>Order ID:</strong> ' . $orderDetails['order_id_index'] . '</p>';
        echo '<p class="card-text"><strong>Status:</strong> ' . ($orderDetails['order_status'] ? $orderDetails['order_status'] : 'Not available') . '</p>';
        echo '<p class="card-text"><strong>Order Date:</strong> ' . $orderDetails['order_date'] . '</p>';
          // Display customer details
        //   if ($customerDetails) {
        //     $customerName = get_customer_name($conn, $customerId);
        //     echo '<p class="card-text"><strong>Customer Name:</strong> ' . $customerName . '</p>';
        // } else {
        //     echo '<p class="card-text"><strong>Customer Name:</strong> Not available</p>';
        // }
        // Display delivery address details
        if ($addressDetails) {
            echo '<p class="card-text"><strong>Delivery Address:</strong> ' . $addressDetails['address'];
            if ($addressDetails['unit_number']) {
                echo ', ' . $addressDetails['unit_number'];
            }
            echo ', ' . $addressDetails['city'] . ', ' . $addressDetails['province'] . ', ' . $addressDetails['zip'] . '</p>';
        } else {
            echo '<p class="card-text"><strong>Delivery Address:</strong> Not available</p>';
        }

        echo '<p class="card-text"><strong>Created At:</strong> ' . $orderDetails['created_at'] . '</p>';
        echo '<p class="card-text"><strong>Updated At:</strong> ' . $orderDetails['updated_at'] . '</p>';
        
        // Get and display order tax details
        $orderTax = get_order_tax($conn, $orderId);
        if ($orderTax) {
            echo '<p class="card-text"><strong>Tax Amount:</strong> ' . $orderTax['tax_amount'] . '</p>';
        } else {
            echo '<p class="card-text"><strong>Tax Amount:</strong> Not available</p>';
        }
        // Calculate and display total amount
        $totalAmount = $orderDetails['order_total_amount'] + ($orderTax ? $orderTax['tax_amount'] : 0);
        echo '<p class="card-text"><strong>Total Amount:</strong> ' . $totalAmount . '</p>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        //printing receipt
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
