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
        echo '<script>';
        echo 'Swal.fire({';
        echo '  title: "Are you sure?",';
        echo '  text: "You won\'t be able to revert this!",';
        echo '  icon: "warning",';
        echo '  showCancelButton: true,';
        echo '  confirmButtonColor: "#3085d6",';
        echo '  cancelButtonColor: "#d33",';
        echo '  confirmButtonText: "Yes, delete it!"';
        echo '}).then((result) => {';
        echo '  if (result.isConfirmed) {';
        echo '    Swal.fire("Deleted!", "Your order has been deleted.", "success");';
        echo '    window.location.href = "order_management.php";';
        echo '  } else {';
        echo '    Swal.fire("Cancelled", "Your order is safe :)", "info");';
        echo '  }';
        echo '});';
        echo '</script>';
        exit;
    } else {
        echo 'Failed to delete order.';
    }
} else {
    echo 'Invalid request.';
}
?>
