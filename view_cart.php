<?php

include('includes/header.php');
include('includes/navbar.php');
include('database/conn.php');


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$cart = $_SESSION['cart'];
$cartProducts = array();

if (!empty($cart)) {
  
    $product_ids = array_keys($cart);
    $product_query = "SELECT * FROM products WHERE id IN (" . implode(',', $product_ids) . ")";
    $product_result = $conn->query($product_query);

    while ($product = $product_result->fetch_assoc()) {
        $product['quantity'] = $cart[$product['id']];
        $cartProducts[] = $product;
    }
}
?>

<div class="container mt-5">
    <h1>Your Shopping Cart</h1>
    <?php if (!empty($cartProducts)) { ?>
        <form action="update_cart.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th colspan="2">Action</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalPrice = 0;

                    foreach ($cartProducts as $product) {
                        $subtotal = $product['price'] * $product['quantity'];
                        $totalPrice += $subtotal;

                        echo '<tr>';
                        echo '<td>' . $product['prod_name'] . '</td>';
                        echo '<td>$' . $product['price'] . '</td>';
                        echo '<td>
                            <input type="number" name="quantity[' . $product['id'] . ']" value="' . $product['quantity'] . '"></td>';
                        echo '<td><button type="submit" class="btn btn-primary" style="padding:5px;">Update</button></td>';
                        echo '<td>
                            <button type="submit" name="remove[' . $product['id'] . ']" class="btn btn-danger" style="padding:5px;">Remove</button>
                        </td>';
                        echo '<td>$' . $subtotal . '</td>';
                        echo '</tr>';
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>SubTotal :</td>
                        <td>$<?php echo $totalPrice; ?></td>
                    </tr>
                    <?php
    
                    $tax = $totalPrice * 0.13;
                    $totalPriceWithTax = $totalPrice + $tax;
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>GST/HST Tax(13%) :</td>
                        <td>$<?php echo $tax; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>                     
                        <td></td>
                        <td><strong>Total :</strong></td>
                        <td><strong>$<?php echo number_format($totalPriceWithTax, 2); ?></strong></td>
                    </tr>
                </tbody>
            </table>
           
        </form>
        
        <a href="checkout.php" class="btn btn-primary mt-2 mb-4 mr-4">Proceed to Checkout</a>
        <a href="empty_cart.php" class="btn btn-danger mt-2 mb-4 mr-4">Empty Cart</a>
    <?php } else {
        echo 'Your cart is empty.';
    }
    ?>
    <a href="shop.php" class="btn btn-secondary mt-2 mb-4 mr-4" >Continue Shopping</a>
</div>
<?php include('includes/footer.php');

?>