<?php
include('includes/header.php');
include('includes/navbar.php');
include('database/conn.php');

// Ensure the cart exists in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$cart = $_SESSION['cart'];
$cartProducts = array();

if (!empty($cart)) {
    // Retrieve product details for items in the cart
    $product_ids = array_keys($cart);
    $product_query = "SELECT * FROM products WHERE id IN (" . implode(',', $product_ids) . ")";
    $product_result = $conn->query($product_query);

    while ($product = $product_result->fetch_assoc()) {
        $product['quantity'] = $cart[$product['id']];
        $cartProducts[] = $product;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $delivery_address = $_POST['delivery_address'];
    $unit_number = $_POST['unit_number'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zip = $_POST['zip'];
    
    if (!empty($cartProducts) && !empty($delivery_address) && !empty($city) && !empty($province) && !empty($zip)) {
        $totalPrice = 0;

        foreach ($cartProducts as $product) {
            $totalPrice += $product['price'] * $cart[$product['id']];
        }

        // Calculate tax
        $tax = $totalPrice * 0.13;
        $totalPriceWithTax = $totalPrice + $tax;

        // Insert delivery address into the delivery_address table
        $insertAddressQuery = "INSERT INTO delivery_address (address, unit_number, city, province, zip)
                            VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertAddressQuery);
        $stmt->bind_param("sssss", $delivery_address, $unit_number, $city, $province, $zip);
        $stmt->execute();

        // Get the last inserted address ID
        $delivery_address_id = $stmt->insert_id;

        // Insert order details into the order_table
        $customer_id = $_SESSION['username']; // You should have this value in your session

        $insertOrderQuery = "INSERT INTO order_table (order_id_index, order_total_amount, delievery_address_id, product_id, customer_id)
                            VALUES (UUID(), $totalPriceWithTax, ?, ?, ?)";

        $stmt = $conn->prepare($insertOrderQuery);

        foreach ($cartProducts as $product) {
            $product_id = $product['id'];
            $stmt->bind_param("iii", $delivery_address_id, $product_id, $customer_id);
            $stmt->execute();
        }

        // Clear the cart
        $_SESSION['cart'] = array();

        // Redirect to a thank you page or any other page as needed
        header("Location: thankyou.php");
    }
}
?>

<div class="container mt-5">
    <h1>Checkout</h1>
    <?php if (!empty($cartProducts)) { ?>
        <form action="checkout.php" method="post">
            <!-- Add input fields for delivery address and other necessary information -->
            <div class="form-group">
                <label for="delivery_address">Delivery Address</label>
                <input type="text" class="form-control" name="delivery_address" required>
            </div>
            <div class="form-group">
                <label for="unit_number">Unit Number</label>
                <input type="text" class="form-control" name="unit_number">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" required>
            </div>
            <div class="form-group">
                <label for="province">Province</label>
                <input type="text" class="form-control" name="province" required>
            </div>
            <div class="form-group">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="zip" required>
            </div>
            <button type="submit" name="checkout" class="btn btn-primary">Complete Order</button>
        </form>
    <?php } else {
        echo 'Your cart is empty.';
    }
    ?>
    <a href="view_cart.php" class="btn btn-secondary">View Cart</a>
</div>
