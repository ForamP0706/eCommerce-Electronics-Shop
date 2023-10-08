<?php include('includes/header.php');
include('includes/navbar.php');
?>
<?php
session_start();
include 'database/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // here we are dong the user authentication 
    $sql = "SELECT * FROM user WHERE UserName = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header('Location: admin/index.php');
        exit;
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

    <?php if (isset($login_error)): ?>
            <p><?= $login_error; ?></p>
    <?php endif; ?>
    <div class="container mt-5 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" class="bg-light p-4 rounded border">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="container mt-1">
    <div class="alert alert-success" role="alert">
    
      
        Admin101 <br> 101
    </div>
  </div>

                <button type="submit" class="btn btn-success">Login</button>
            </form>

        </div>
    </div>
</div>



    <?php
    include('includes/footer.php'); ?>

