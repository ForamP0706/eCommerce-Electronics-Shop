<?php
include('includes/header.php');
include('includes/navbar.php');

if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];
    $product_query = "SELECT * FROM products WHERE id = $product_id";
    $product_result = $conn->query($product_query);

    if ($product_result->num_rows > 0) {
        $product = $product_result->fetch_assoc();
     
        ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="assets/images/products/<?php echo $product['prod_img']; ?>" alt="<?php echo $product['prod_name']; ?>" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1><?php echo $product['prod_name']; ?></h1>
                    <p>Price: $<?php echo $product['price']; ?></p>
                    <p><?php echo $product['prod_desc']; ?></p>
                    
              
                    <form method="post" action="add_cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="1">
                        </div>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                        <a href="shop.php" class="btn btn-secondary">Continue Shopping</a>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not provided.";
}

include('includes/footer.php');
?>
