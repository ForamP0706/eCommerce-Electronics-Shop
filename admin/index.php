<?php
     include('includes/header.php');
    
?>


<?php  

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
include '../database/conn.php';
include '../includes/functions.php';

$products = get_products($conn);
?>


    <h1>Welcome to the Admin Dashboard, <?php $_SESSION['username']; ?></h1>

    <a href="product_list.php">View Products</a>
    <br>

    <a href="logout.php">Logout</a>
 

<?php
     include('includes/footer.php');?>