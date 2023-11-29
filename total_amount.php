<?php
$cart = json_decode($jsonObj->cart, true);
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

function calculateOrderTotal($cartProducts) {
    $total = 0.0; 

    foreach ($cartProducts as $product) {
        
        $productPrice = $product['price'];
        $quantity = $product['quantity'];

       
        $subtotal = $productPrice * $quantity;

    
        $total += $subtotal;
    }

    return $total;
}
