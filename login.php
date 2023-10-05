<?php include('includes/header.php');
include('includes/navbar.php');
?>
<?php
session_start();
include 'database/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform user authentication here (e.g., check credentials against the database)
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

    <?php if (isset($login_error)) : ?>
    <p><?= $login_error; ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

    <?php
     include('includes/footer.php');?>

