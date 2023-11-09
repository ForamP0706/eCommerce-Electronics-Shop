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
        // Optionally, you can redirect or show a success message
        echo "Update successful!";
    } else {
        // Handle the case where the update fails (e.g., show an error message)
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
    // Handle case where customer ID is not provided
    header('Location: user_managment.php');
    exit;
}
?>
<main class="main-content position-relative vh-100 border-radius-lg ">

<div class="container mt-1 border rounded p-4 bg-white">
    <h1 class="display-4 fw-bold">Edit Customer</h1>
    <p class="lead fs-4">Hello, <?php echo $_SESSION['username']; ?>!</p>

    <div class="mt-5">
        <form action="edit_customer.php" method="post">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $customer['id']; ?>">

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?= $customer['first_name']; ?>" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?= $customer['last_name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $customer['email']; ?>" required>

            <button type="submit" class="btn btn-primary btn-sm m-0">Update</button>
            <a href="delete_user.php?id=<?= $customer['id']; ?>" class="btn btn-danger btn-sm m-0" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
        </form>
    </div>
</div>
</main>
<?php include 'includes/footer.php'; ?>
