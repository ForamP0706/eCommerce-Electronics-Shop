<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #00ff84;">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php" style="color: #aoda;">Electronic e-store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php" style="color: #aoda;">Home</a></li>
                <li class="nav-item">
                    <a href="" class="nav-link text-muted" target="" style="color: #aoda;">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-muted" target="" style="color: #aoda;">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link text-muted" target="" style="color: #aoda;">Login</a>
                </li>
                <li class aoda="nav-item">
                    <a href="register.php" class="nav-link text-muted" target="" style="color: #aoda;">Signup</a>
                </li>
                
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            
                    <p class="lead fs-4">Hello, <?php echo $_SESSION['username']; ?>!</p>
                
            </form>
        </div>
    </div>
</nav>
