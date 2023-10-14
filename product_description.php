<?php include('includes/header.php');
include('includes/navbar.php');
include('database/conn.php');

if (isset($_GET['id'])) {
   
    // Retrieve product information from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found.");
    }
} else {
    die("Product ID not provided.");
}
?>
 <style>
            .error {
                color:red;
            }

            .product{
              gap:10px;
              margin-top:4px;
              margin-bottom:4px;
            }
            
            .product-content{
                display: flex;
                flex-direction: column;
                place-content: center;
            }
        </style>
        <div class="product">
                <div class="product-image">
                    <img src="Images/<?php echo $product['prod_img']
                    ?>" alt="Product Image"  >
                </div>
                <div class="product-content">
                    <h2> <?php echo $product['prod_name']
                    ?> </h2>
                    <p> <?php echo $product['prod_desc']
                    ?>
                </p>
                <h3> <?php echo $product['price']." CAD"; ?>  </h3>
                <div>
                  <form method='get'>
                    <input type='hidden' value='<?php echo $id ?>' name='product_id'>
                <button type='submit' class=" my-3" > Add to cart </button> 
                </form>
               </div>   
                </div>
        </div>        
        <?php
include('includes/footer.php');?>