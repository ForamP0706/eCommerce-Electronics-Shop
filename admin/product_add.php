<?php
include('includes/header.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include '../database/conn.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $quantity=$_POST['qty'];

    // Perform validation here

    $sql = "INSERT INTO products (prod_name, prod_desc, price, category_id,qty) 
            VALUES ('$name', '$description', '$price', '$category_id','$quantity')";

    if ($conn->query($sql) === TRUE) {
        header('Location: product_list.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

    <a href="product_list.php">Back to Product List</a>
    <form method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <label for="price">Price</label>
        <input type="text" id="price" name="price" required>
        <br>
        <label for="category_id">Category</label>
       <input type="text" id="category_id" name="category_id" required>
        <br>
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" required>
        <br>
        <input type="submit" value="Add Product">
    </form>
    <?php include('includes/footer.php');