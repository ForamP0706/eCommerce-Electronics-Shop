<?php
include 'includes/header.php';
include 'includes/navbar.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

include '../database/conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted to update category status
    if (isset($_POST['updateStatus'])) {
        $categoryId = $_POST['categoryId'];
        $is_enabled = isset($_POST['is_enabled']) ? 1 : 0;

        // Update category status in the database
        $stmt = $conn->prepare("UPDATE categories SET is_enabled = ? WHERE id = ?");
        $stmt->bind_param('ii', $is_enabled, $categoryId);

        if ($stmt->execute()) {
            $success_message = "Category status updated successfully!";
        } else {
            $error_message = "Error updating category status.";
        }
    }

    // Check if the form is submitted to add a new category
    elseif (isset($_POST['addCategory'])) {
        $categoryName = $_POST['categoryName'];

        // Inserting the new category into the database
        $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
        $stmt->bind_param('s', $categoryName);

        if ($stmt->execute()) {
            $success_message = "Category added successfully!";
        } else {
            $error_message = "Error adding category. Please try again.";
        }
    }
}

// Fetch all categories
$result = $conn->query("SELECT * FROM categories");
$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<!-- <main class="main-content position-relative vh-100 border-radius-lg"> -->
<div class="container-fluid bg-light-grey ">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <form method="post" class="border p-4 rounded shadow bg-white mt-4">
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
                <button type="submit" class="btn btn-primary" name="addCategory">Add Category</button>
            </form>

            <div class="row mt-5 mb-5">
                <div class="col-md-20">
                    <h2>Categories</h2>
                    <ul class="list-group">
                        <?php foreach ($categories as $category) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $category['category_name']; ?>
                                <form method="post" class="row align-items-center">
                                    <div class="col-auto">
                                        <input type="hidden" name="categoryId" value="<?= $category['id']; ?>">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="categorySwitch<?= $category['id']; ?>" name="is_enabled" <?= $category['is_enabled'] ? 'checked' : ''; ?>>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary" name="updateStatus">Update Status</button>
                                    </div>
                                </form>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </main> -->

<?php
include 'includes/footer.php';
?>