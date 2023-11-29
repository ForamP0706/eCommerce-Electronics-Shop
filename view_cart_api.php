<?php

include('database/conn.php');
$jsonStr = file_get_contents('php://input');
$jsonObj = json_decode($jsonStr, true);
$cart = $jsonObj['cartData'];

if (!empty($cart)) {

    if (is_array($cart)) {
        $product_ids = array_keys($cart);
        $product_query = "SELECT * FROM products WHERE id IN (" . implode(',', $product_ids) . ")";
        $product_result = $conn->query($product_query);

        $cartProducts = [];

        while ($product = $product_result->fetch_assoc()) {
            $product['quantity'] = $cart[$product['id']];
            $cartProducts[] = $product;
        }

        echo json_encode($cartProducts);
    } else {
        echo json_encode(["error" => "Invalid cart data format"]);
    }
} else {
    echo json_encode(["error" => "No cart data provided"]);
}
?>
