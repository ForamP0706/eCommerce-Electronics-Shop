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

<div class="container d-flex justify-content-center align-items-center min-vh-100 animate__animated animate__rotateInDownLeft">
    <div class="col-md-5 text-center border p-4 rounded shadow bg-light">
        <h1 class="display-4 fw-bold mb-4">Welcome to the Admin Dashboard</h1>
        <p class="lead fs-4">Hello, <?php echo $_SESSION['username']; ?>!</p>
        <a href="#" class="btn btn-primary mt-3">Explore Dashboard</a>
    </div>
</div>



<?php
include('includes/footer.php');?>