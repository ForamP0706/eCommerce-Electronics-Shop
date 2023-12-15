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
// fetching  categories from the database
$categoriesQuery = "SELECT id, category_name FROM categories WHERE is_enabled = 1";
$categoriesResult = mysqli_query($conn, $categoriesQuery);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['qty'];

    //   here we are using the prepared statement to prevent sql injection
    $stmt = $conn->prepare("INSERT INTO products (prod_name, prod_desc, price, category_id, qty) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsi", $name, $description, $price, $category_id, $quantity);

    if ($stmt->execute()) { // we are using execute() for prepared statements
        // after we are redirecting it to product list page
        header('Location: product_list.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    // Closing here
    $stmt->close();
}
?>
<!-- <main class="main-content position-relative vh-100 border-radius-lg "> -->
<div class="container-fluid min-vh-100 bg-light-grey">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 border p-4 rounded bg-white mt-4">
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control border p-2 bg-white" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control border p-2 bg-white" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" id="price" name="price" class="form-control border  p-2 bg-white" required>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" name="qty" class="form-control border p-2 bg-white" required>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" name="category_id" class="form-select border p-2 bg-white" required>
                        <?php
                        while ($row = mysqli_fetch_assoc($categoriesResult)) {
                            echo "<option value='{$row['id']}'>{$row['category_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-dark">Add Product</button>
                    <a href="product_list.php" class="btn btn-secondary">Back to Product List</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- </main> -->
<?php include('includes/footer.php');
