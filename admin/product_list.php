<?php
include('includes/header.php');
include('includes/navbar.php');

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



    <div class="container mt-5 border rounded p-4">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Number</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
            </tr>
        </thead>
    
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= $product['id']; ?></td>
                    <td><?= $product['prod_name']; ?></td>
                    <td><?= $product['price']; ?></td>
                    <td><?= $product['category_id']; ?></td>
                    <td><?= $product['qty']; ?></td>
                    <td>

                        <!-- here we have a form to update the quantity value -->
                        <form method="post" action="update_quantity.php">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <input type="number" name="new_quantity" min="0" required>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>

                    </td>
                    <td>
                        <a href="product_edit.php?id=<?= $product['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="product_delete.php?id=<?= $product['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <?php include('includes/footer.php');