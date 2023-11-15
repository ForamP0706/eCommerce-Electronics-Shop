<?php
include 'includes/header.php';
include 'includes/navbar.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

include '../database/conn.php';

// have if statement for Checking if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = $_POST['categoryName'];

    // Inserting the new category into the database
    $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt->bind_param('s', $categoryName);

    if ($stmt->execute()) {
        $success_message = "Category added successfully!";
    } else {
        $error_message = "Error. Please try again.";
    }
}
?>
<main class="main-content position-relative vh-100 border-radius-lg ">
<div class="container ">
    <div class="row justify-content-center align-items-center my-5 ">
        <div class="col-md-6 ">
            <form method="post" class="border p-4 rounded shadow bg-white">
                <h2 class="mb-4">Add New Category</h2>

                <?php if (isset($success_message)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success_message; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($error_message)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error_message; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName" required style="background-color: white; border: 1px solid #ced4da; border-radius: 5px; padding: 5px;">
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>
</div>
</main>
<?php
include 'includes/footer.php';
?>