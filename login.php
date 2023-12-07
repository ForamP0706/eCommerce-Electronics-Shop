<?php 
include 'includes/header.php';
include 'includes/navbar.php';
?>
<?php
include_once 'database/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role === 'admin') {

        $sql = "SELECT * FROM user WHERE UserName ='$username' AND Password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username;
            header('Location: admin/index.php');
            exit;
        } else {
            $login_error = "Invalid username or password.";
        }
    } elseif ($role === 'user') {


        $sql = "SELECT * FROM customer WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // here we are Verifying the entered password against hashed password
            if (password_verify($password, $row['password'])) {
                $_SESSION['customer_id'] = $row['id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['username'] = $username;


                header('Location: index.php');

                exit;
            } else {
                $login_error = "Invalid username or password.";
            }
        } else {
            $login_error = "Invalid username or password.";
        }
    }
}
?>
<?php if (isset($login_error)) : ?>
    <p><?= $login_error; ?></p>
<?php endif; ?>
<div class="container mt-5 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" class="bg-light p-4 rounded border">
                <div class="form-group">
                    <label for="username">Username/Email </label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group mb-4">
                    <label for="role">Role:</label>
                    <select id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="container mt-1">
                </div>
                <button type="submit" class="btn btn-success">Login</button>
            </form>

        </div>
    </div>
</div>
<?php
include 'includes/footer.php'; ?>
<style>
    .footer {
        background-color: #007BFF;
        color: #fff;
        padding: 20px 0;
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>