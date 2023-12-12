<?php
include 'includes/header.php';
include 'includes/navbar.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

include '../database/conn.php';
include '../includes/functions.php';

// Check if the form is submitted and the action is set to 'update'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $customer_id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Perform the update
    if (update_customer($conn, $customer_id, $first_name, $last_name, $email, $password)) {
        
        echo "Update successful!";
    } else {
        // Handle the case where the update fails
        echo "Update failed!";
    }
}


// Check if customer ID is provided in the URL
if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $customer = get_customer_by_id($conn, $customer_id);

    if (!$customer) {
        // Handle case where customer is not found
        echo "Customer not found!";
        exit;
    }
} else {
 
    header('Location: user_managment.php');
    exit;
}
?>
<!-- <body class="bg-gray-200"> -->
<main class="main-content position-relative vh-100 border-radius-lg ">

<div class="container mt-5 p-4 bg-light border rounded shadow mx-auto" style="max-width: 50%;">
    <h1 class="display-4 fw-bold text-primary">Edit Customer</h1>
    <p class="lead fs-4">Hello, <?php echo $_SESSION['username']; ?>!</p>

    <div class="mt-4">
        <form action="edit_customer.php" method="post">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $customer['id']; ?>">

            <div class="mb-3">
                <label for="first_name" class="form-label text-dark text-bold fs-5">First Name:</label>
                <input type="text" name="first_name" class="form-control bg-white shadow-lg p-3" value="<?= $customer['first_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label text-dark text-bold fs-5">Last Name:</label>
                <input type="text" name="last_name" class="form-control bg-white shadow-lg p-3" value="<?= $customer['last_name']; ?>" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="delete_user.php?id=<?= $customer['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
            </div>
        </form>
    </div>
</div>


</main>
<!-- </body> -->
<?php include 'includes/footer.php'; ?>

