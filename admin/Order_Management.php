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

<body class=" bg-gray-200 ">
    <main class="main-content position-relative  border-radius-lg mx-auto">
        <div class="container mt-5 border rounded p-4 bg-white">
            <h2 class="text-center animate__animated animate__fadeIn glow-text">Order Management</h2>

            <div class="table-responsive ">
                <table class="table table-hover table-striped">
                    <thead class="text-light thead-dark bg-dark">
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
                                <td class="font-weight-bold text-dark"><?php echo $order['order_id_index']; ?></td>
                                <td class="text-muted font-italic"><?php echo $order['order_date']; ?></td>
                                <td class="font-weight-bold text-dark"><?php echo '$' . number_format($order['order_total_amount'], 2); ?></td>
                                <?php
                                $statusClass = '';

                                switch ($order['order_status']) {
                                    case 'Approved':
                                        $statusClass = 'text-success';
                                        break;
                                    case 'In Process':
                                        $statusClass = 'text-warning';
                                        break;
                                    case 'not approved':
                                        $statusClass = 'text-danger';
                                        break;
                                    default:

                                        $statusClass = 'font-weight-bold';
                                        break;
                                }
                                ?>

                                <td class="<?php echo $statusClass; ?>"><?php echo $order['order_status']; ?></td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="view_order.php?id=<?php echo $order['ID']; ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        <a href="update_order.php?id=<?php echo $order['ID']; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Update Status
                                        </a>
                                        <a href="delete_order.php?id=<?php echo $order['ID']; ?>" class="btn btn-danger btn-sm" >
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