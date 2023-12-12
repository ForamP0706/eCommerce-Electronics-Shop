<?php
include('database/conn.php');
include('includes/functions.php');

$categories = get_categories($conn);
$baseUrl = "/eCommerce-Electronics-Shop";

?>
<style>
    .navbar-nav {
        display: flex;
        flex-direction: row;
        align-items: center;
       
    }
    .hover-div {
    position: relative;
    display: inline-block;
}

.hover-div .dropdown-menu {
    display: none;
    position: absolute;
    z-index: 1000;
}

.hover-div:hover .dropdown-menu {
    display: block;
}
.hover-div span{
    padding: 8px;
    
}

</style>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php" style="color: white;">Electronic e-store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 mr-4">
                <li class="nav-item"><a class="nav-link text-white active" aria-current="page" href="index.php">Home</a></li>
                <?php
                    if (isset($_SESSION['username'])) {
                ?>
                <li class="nav-item"><a class="nav-link text-white" aria-current="page" href="shop.php">Shop</a></li>
                <li class="nav-item hover-div">
                    <span class="text-white">Categories  <span class="fas fa-chevron-down"></span></span>
                   <div class="dropdown">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php foreach($categories as $cat) { ?>
                            <a class="dropdown-item" href="<?=$baseUrl?>/shop.php?category=<?=$cat['id']?>"><?=$cat['category_name']?></a>
                        <?php } ?>
                    </div>
                </div>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="about_us.php" class="nav-link text-white" target="">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="contact_us.php" class="nav-link text-white" target="">Contact Us</a>
                </li>
                
                <?php
                    if (isset($_SESSION['username'])) {
                ?>
                <li class="nav-item">
                    <a href="./shop_history.php" class="nav-link text-white">Your Orders</a>
                </li>
                <li class="nav-item">
                    <a href="./logout.php" class="nav-link text-white">Logout</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a href="login.php" class="nav-link text-white" target="">Login</a>
                </li>
                <li class aoda="nav-item">
                    <a href="register.php" class="nav-link text-white" target="">Signup</a>
                </li>
                <?php } ?>
            </ul>
            <?php if (isset($_SESSION['username'])) { ?>
            <form class="d-flex" action="view_cart.php" method="get">
    <button class="btn border-white text-white" type="submit">
        <i class=" me-1"></i>
        Cart
        <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-item-count"></span>
    </button>
    <p class="text-white" style="margin: 5px;">
    <?php
            echo 'Welcome! ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        }?>
</p>
</form>
        </div>
    </div>
</nav>
<script>
    document.getElementById('cart-item-count').innerText = '' + Object.keys(JSON.parse(localStorage.getItem('cart') || '{}')).length;
</script>
<!-- bi-cart-fill  FOR CART ICON-->