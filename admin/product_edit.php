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
    if (!$product || !array_key_exists('id', $product)) {
        echo "Product not found.";
        exit;
    }
}
?>
<div class="container mt-5 mb-2 vh-100">
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

                <button type="submit" class="btn btn-dark mt-3">Update Product</button>
                <a href="product_list.php" class="btn btn-secondary mt-3">Back to Product List</a>
            </form>
        </div>
    </div>
</div>
<!-- here we have some custom css for better styling -->
<style>
    .custom-input {
        background-color: white;
        border: 1px solid #ced4da;
    }

    .custom-input:hover {
        border: 1px solid #6c757d;
    }
</style>



    <?php include('includes/footer.php');
