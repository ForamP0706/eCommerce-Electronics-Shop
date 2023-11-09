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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the product exists
    $product = get_product_by_id($conn, $id);
    if (!$product) {
        echo "Product not found.";
        exit;
    }

    // Perform deletion
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: product_list.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
<?php include('includes/footer.php');