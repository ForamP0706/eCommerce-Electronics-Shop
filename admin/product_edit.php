<?php
include('includes/header.php');
include('includes/navbar.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
// include '../includes/db.php';
include '../database/conn.php';

include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    // Perform validation here

    $sql = "UPDATE products 
            SET prod_name='$name', prod_desc='$description', price='$price', category_id='$category_id' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: product_list.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $product = get_product_by_id($conn, $id);
    if (!$product) {
        echo "Product not found.";
        exit;
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" class="bg-light p-4 rounded border">
                <input type="hidden" name="id" value="<?= $product['id']; ?>">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control custom-input p-2" id="name" name="name" value="<?= $product['prod_name']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control custom-input p-2" id="description" name="description"><?= $product['prod_desc']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control custom-input p-2" id="price" name="price" value="<?= $product['price']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <input type="text" class="form-control custom-input p-2" id="category_id" name="category_id" value="<?= $product['category_id']; ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control custom-input p-2" id="qty" name="quantity" value="<?= $product['qty']; ?>" required>
                </div>

                <button type="submit" class="btn btn-dark">Update Product</button>
                <a href="product_list.php" class="btn btn-secondary">Back to Product List</a>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-input {
        background-color: white;
        border: 1px solid #ced4da; /* Bootstrap default border color */
    }

    .custom-input:hover {
        border: 1px solid #6c757d; /* Bootstrap default border color for hover state */
    }
</style>



    <?php include('includes/footer.php');
