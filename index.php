<?php include('includes/header.php');
include('includes/navbar.php');
?>
        <header class="bg-primary py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Welcome to our electronics e-store</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Here we have various electronic products</p>
                </div>
            </div>
        </header>
        
        <section class="container">
        <div class="row">
                    <div class="col-md-12" style="margin-top: 35px; margin-bottom: 25px;" >
                    </div>
                </div>
        <div id="carouselExampleSlides" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="assets/images/business-online-shopping-sale-concept.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="assets/images/laptop-shopping-bags-online-shopping-concept.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="assets/images/purchasing-shop-buying-selling-teade.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleSlides" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleSlides" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        </section>
        <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Mobiles</h3>
            </div>
        </div>
        <div class="row">
            <?php
            
            include_once('database/conn.php');
            $sql = "SELECT * FROM products where category_id=2";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card">';
                    echo '<img class="card-img-top" src="assets/images/products/' . $row['prod_img'] . '" alt="' . $row['prod_name'] . '">';
                    echo '<div class="card-body">';
                    $href = 'product_description.php?product_id=' . $row['id'];
                    if (!isset($_SESSION['username'])) {
                        $href = 'javascript:loginClick()';
                    }
                    echo '<h5 class="card-title"><a href="' . $href . '">' . $row['prod_name'] . '</a></h5>';                              
                    echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</section>
<script>
    function loginClick() {
        alert('Login first');
        window.location.href = 'login.php';
    }
</script>
        <?php include('includes/footer.php');

?>