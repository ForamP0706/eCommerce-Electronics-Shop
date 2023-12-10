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

$orders = get_orders($conn);
?>

<body class=" bg-gray-200">
    <main class="main-content position-relative  border-radius-lg mx-auto">
        <div class="container mt-5 border rounded p-4 bg-white">
            <h2 class="text-center ">Order Management</h2>
            <div class="table-responsive ">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?php echo $order['order_id_index']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo '$' . number_format($order['order_total_amount'], 2); ?></td>
                                <td><?php echo $order['order_status']; ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="view_order.php?id=<?php echo $order['ID']; ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        <a href="update_order.php?id=<?php echo $order['ID']; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Update Status
                                        </a>
                                        <a href="delete_order.php?id=<?php echo $order['ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
<div class="footer-container">
    <?php include('includes/footer.php'); ?>
</div>