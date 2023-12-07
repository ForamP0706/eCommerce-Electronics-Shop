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

<div class="d-flex flex-column min-vh-100">
    <div class="container mt-5 mb-5 border rounded p-4 bg-white">
        <div class="table-responsive">
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
                            <td class="text-wrap"><?= $product['id']; ?></td>
                            <td class="text-wrap"><?= $product['prod_name']; ?></td>
                            <td class="text-wrap"><?= $product['price']; ?></td>
                            <td class="text-wrap">
                                <?php
                                // Fetch category name based on category_id
                                $category_id = $product['category_id'];
                                $category_name = get_category_name($conn, $category_id);
                                echo $category_name;
                                ?>
                            </td>
                            <td class="text-wrap"><?= $product['qty']; ?>
                                <div>
                                    <!-- form to update the quantity value  -->
                                    <form method="post" action="update_quantity.php">
                                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                        <input type="number" name="new_quantity" min="0" required placeholder="Enter new quantity">
                                        <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
                                    </form>
                                </div>
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
    </div>
</div>
<?php include('includes/footer.php'); ?>