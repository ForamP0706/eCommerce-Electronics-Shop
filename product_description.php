<?php include('includes/header.php');
include('includes/navbar.php');
if(isset($_GET['id']))
$id=htmlspecialchars($_GET['id']);
else
$pid=1;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=:pid");
$stmt->execute(['id' => $pid]); 
$product = $stmt->fetch();
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