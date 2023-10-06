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
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['qty']; 
    // Perform validation here

//   here we are using the prepared statement to prevent sql injection
  $stmt = $conn->prepare("INSERT INTO products (prod_name, prod_desc, price, category_id, qty) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssdsi", $name, $description, $price, $category_id, $quantity);

  if ($stmt->execute()) { // Use execute() for prepared statements
    // Redirect to the product list page
    header('Location: product_list.php');
    exit;
} else {
    echo "Error: " . $stmt->error;
}
     // Close the statement
     $stmt->close();
}
?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 border p-4 rounded">
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control p-2 " style="background-color: white; border: 1px solid #ced4da;" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control p-2"  style="background-color: white; border: 1px solid #ced4da;"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" id="price" name="price" class="form-control p-2" style="background-color: white; border: 1px solid #ced4da;" required>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <input type="text" id="category_id" name="category_id" class="form-control p-2" style="background-color: white; border: 1px solid #ced4da;" required>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" name="qty" class="form-control p-2" style="background-color: white; border: 1px solid #ced4da;" required>
                </div>
                <button type="submit" class="btn btn-dark">Add Product</button>
                <a href="product_list.php" class="btn btn-secondary">Back to Product List</a>
            </form>
        </div>
    </div>
</div>

    <?php include('includes/footer.php');