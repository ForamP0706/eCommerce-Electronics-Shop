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

<div class="d-flex flex-column min-vh-100 bg-light-grey">
    <div class="container mt-5 mb-5 border rounded p-4 bg-white">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="text-white bg-dark thead-dark">
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col" class="col-3">Quantity</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr class="text-dark">
                            <td class="text-wrap"><?= $product['id']; ?></td>
                            <td class="text-wrap"><?= $product['prod_name']; ?></td>
                            <td class="text-wrap">$<?= $product['price']; ?></td>
                            <td class="text-wrap">
                                <?php
                                // Fetch category name based on category_id
                                $category_id = $product['category_id'];
                                $category_name = get_category_name($conn, $category_id);
                                echo $category_name;
                                ?>
                            </td>
                            <td class="text-wrap align-middle">
                                <div class="d-flex align-items-center">
                                    <span class="mr-3 p-3"><?= $product['qty']; ?></span>
                                    <form method="post" action="update_quantity.php" class="form-inline">
                                        <div class="input-group">
                                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                            <input type="number" name="new_quantity" min="0" required placeholder="New Quantity" class="form-control mr-2 p-3 bg-white">
                                            <div class="input-group-append d-flex align-items-center">
                                                <button type="submit" class="btn btn-primary m-0">
                                                    <i class="fas fa-sync-alt"></i> Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                            <td class="align-middle">
                                <a href="product_edit.php?id=<?= $product['id']; ?>" class="btn btn-warning btn-sm mb-0">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="product_delete.php?id=<?= $product['id']; ?>" class="btn btn-danger btn-sm mb-0" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>