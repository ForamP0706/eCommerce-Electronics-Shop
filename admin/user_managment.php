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

// Handling form submission for updating customer information
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'edit') {
        // here we are getting the customer data for editing
        $customer_id = $_POST['id'];
        $customer = get_customer_by_id($conn, $customer_id);
    } elseif ($_POST['action'] === 'update') {
        // Updating the customer information in the database
        $customer_id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        // Performing the update
        if (update_customer($conn, $customer_id, $first_name, $last_name, $email, $password)) {
        } else {
            // here we Handle the case where the update fails
            echo "Update failed!";
        }
    }
}

// Retrieving the list of customers
$customers = get_customers($conn);
?>

<div class="container mt-3 mb-3 border rounded p-4 bg-white ">
    <div class="table-responsive overflow-hidden">

        <h1 class="display-4 fw-bold">Customer Management</h1>
        <p class="lead fs-4">Hello, <?php echo $_SESSION['username']; ?>!</p>

        <div class="table-responsive">
            <div class="row mt-3">
                <div class="col-md-12 pb-5">
                    <table class="table table-bordered table-hover">
                        <thead class=" text-light bg-dark thead-dark">
                            <tr>
                                <th scope="col" class="col-1">ID</th>
                                <th scope="col" class="col-2">First Name</th>
                                <th scope="col" class="col-2">Last Name</th>
                                <th scope="col" class="col-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $customer) : ?>
                                <tr class="text-dark ">
                                    <td class="text-bold"><?= $customer['id']; ?></td>
                                    <td><?= $customer['first_name']; ?></td>
                                    <td><?= $customer['last_name']; ?></td>
                                    <td class="text-center">
                                        <form action="edit_customer.php" method="post" class="d-inline">
                                            <input type="hidden" name="action" value="edit">
                                            <input type="hidden" name="id" value="<?= $customer['id']; ?>">
                                            <a href="edit_customer.php?id=<?= $customer['id']; ?>" class="btn btn-primary btn-sm w-80"> <i class="fas fa-edit mr-1"></i> Edit</a>
                                        </form>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($customer)) :
?>

<?php endif; ?>

<?php include 'includes/footer.php'; ?>