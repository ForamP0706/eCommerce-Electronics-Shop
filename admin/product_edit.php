<?php
include('includes/header.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include '../includes/db.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    // Perform validation here

    $sql = "UPDATE products 
            SET name='$name', description='$description', price='$price', category_id='$category_id' 
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

    <a href="product_list.php">Back to Product List</a>
    <form method="post">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= $product['name']; ?>" required>
        <br>
        <label for="description">Description</label>
        <textarea id="description" name="description"><?= $product['description']; ?></textarea>
        <br>
        <label for="price">Price</label>
        <input type="text" id="price" name="price" value="<?= $product['price']; ?>" required>
        <br>
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id']; ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                    <?= $category['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="<?= $product['qty']; ?> required>
        <br>
        <input type="submit" value="Update Product">
    </form>
    <?php include('includes/footer.php');
