<?php include('includes/header.php');
include('includes/navbar.php');
?>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>All Products</h3>
            </div>
        </div>
        <div class="row">
            <?php
            include('database/conn.php');
            $sql = "SELECT * FROM products where category_id=2";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card">';
                    echo '<img class="card-img-top" src="assets/images/products/' . $row['prod_img'] . '" alt="' . $row['prod_name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['prod_name'] . '</h5>';                 
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
<?php 
include('includes/footer.php');
?>