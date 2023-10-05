<?php
include('includes/header.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include '../database/conn.php';
include '../includes/functions.php';

$products = get_products($conn);
$categories = get_categories($conn);
?>


    <a href="product_add.php">Add New Product</a>

    <a href="../logout.php">Logout</a>
    <table>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
            <td><?= $product['id']; ?></td>
            <td><?= $product['prod_name']; ?></td>
            <td><?= $product['price']; ?></td>
            <td><?= $product['category_name']; ?></td>
            <td><?= $product['qty']; ?></td>
            <td>
                <a href="product_edit.php?id=<?= $product['id']; ?>">Edit</a>
                <a href="product_delete.php?id=<?= $product['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php include('includes/footer.php');