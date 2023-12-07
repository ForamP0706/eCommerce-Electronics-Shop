<?php
include('includes/header.php');
include('includes/navbar.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
include '../database/conn.php';
include '../includes/functions.php';

// Retrieving orders
$orders = get_orders($conn);

?>
<div class="container mt-5 mb-5 border rounded p-4 bg-white">
    <h2>Order Management</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['order_id_index']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td>
                        <?php
                        // Fetch customer name based on customer_id
                        $customer_id = $order['customer_id'];
                        $customer_name = get_customer_name($conn, $customer_id);
                        echo $customer_name;
                        ?>
                    </td>
                    <td><?php echo $order['order_total_amount']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary">
                                <a href="view_order.php?id=<?php echo $order['ID']; ?>" style="color: white; text-decoration: none;">View Details</a>
                            </button>
                            <button type="button" class="btn btn-warning">
                                <a href="update_order.php?id=<?php echo $order['ID']; ?>" style="color: white; text-decoration: none;">Update Status</a>
                            </button>
                            <button type="button" class="btn btn-danger">
                                <a href="delete_order.php?id=<?php echo $order['ID']; ?>" style="color: white; text-decoration: none;">Delete</a>
                            </button>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
include('includes/footer.php');
?>