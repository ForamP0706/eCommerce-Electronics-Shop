<?php
     include('includes/header.php');
     include('includes/navbar.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
include '../database/conn.php';
include '../includes/functions.php';
$products = get_products($conn);
?>

   <div class="container d-flex justify-content-center align-items-center vh-100 ">
        <div class="col-md-5 text-center border p-4 rounded shadow bg-white">
            <h1 class="display-4 fw-bold">Welcome to the Admin Dashboard</h1>
            <p class="lead fs-4">Hello, <?php echo $_SESSION['username']; ?>!</p>
        </div>
</div>

<?php
include('includes/footer.php');?>