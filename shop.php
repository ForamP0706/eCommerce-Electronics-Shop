<?php include('includes/header.php');
include('includes/navbar.php');

$sql = "SELECT * FROM products where active = 1";
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $sql .= " and category_id = ".$_GET['category'];
}
if (isset($_GET['q'])) {
    $sql .= " and prod_name like '%".$_GET['q']."%'";
}
if (isset($_GET['q'])) {
    $sql .= " and prod_name like '%".$_GET['q']."%'";
}
$sort = "";
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    switch ($_GET['sort']) {
        case 'price>':
            $sql .= " order by price desc";
            break;
        case 'price<':
            $sql .= " order by price asc";
            break;
        case 'a-z':
            $sql .= " order by prod_name asc";
            break;
        case 'z-a':
            $sql .= " order by prod_name desc";
            break;
        default:
            break;
    }
}
?>
<style>
    .product-img {
        max-width: 100%;
        max-height: 100%;
    }
    .img-parent {
        width: 100%;
        aspect-ratio: 1;
        max-height: 300px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <form method="get" class="row">
            <!-- Category Dropdown -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="categorySelect">Category</label>
                    <select class="form-control" id="categorySelect" name="category">
                        <option value="">All Categories</option>
                        <?php foreach($categories as $cat) { ?>
                            <option <?php 
                                if (isset($_GET['category']) && $cat['id']==$_GET['category']) echo "selected"; else echo "";
                                 ?> value="<?=$cat['id']?>"><?=$cat['category_name']?></option>
                        <?php } ?>
                        <!-- Add more category options here -->
                    </select>
                </div>
            </div>
            
            <!-- Search Input -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="productNameSearch">Keywords</label>
                    <input type="text" value="<?php if (isset($_GET['q'])) echo $_GET['q']; else echo "";?>"
                     class="form-control" name="q" id="productNameSearch" placeholder="Search...">
                </div>
            </div>

            <!-- Sort Options -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sortSelect">Sort By</label>
                    <select class="form-control" id="sortSelect" name="sort">
                        <option value="">None</option>
                        <option <?=($sort=="a-z"?"selected":"")?> value="a-z">A-Z</option>
                        <option <?=($sort=="z-a"?"selected":"")?> value="z-a">Z-A</option>
                        <option <?=($sort=="price<"?"selected":"")?> value="price<">Price: Low to High</option>
                        <option <?=($sort=="price>"?"selected":"")?> value="price>">Price: High to Low</option>
                    </select>
                </div>
            </div>

            <!-- Apply Button -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="applyFilters">&nbsp;</label>
                    <button class="btn btn-primary form-control" type="submit" id="applyFilters">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>All Products</h3>
            </div>
        </div>
        <div class="row">
            <?php
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card mb-4">';                  
                    echo '<div class="img-parent"><img class="product-img" src="assets/images/products/' . $row['prod_img'] . '" alt="' . $row['prod_name'] . '"></div>';
                    echo '<div class="card-body">';
                    $ProductName = substr($row['prod_name'], 0, 30);
                    echo '<h5 class="card-title"><a href="product_description.php?product_id=' . $row['id'] . '">' . $ProductName . '</a></h5>';              
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