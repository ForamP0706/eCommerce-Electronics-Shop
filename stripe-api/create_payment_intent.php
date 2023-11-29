<?php 
require_once 'stripe_header.php';
require_once __DIR__ . '/../total_amount.php';

$amount = calculateOrderTotal($cartProducts);
$product_price = round($amount*100 * 1.13); 

try { 
    $paymentIntent = \Stripe\PaymentIntent::create([ 
        'amount' => $product_price,
        'currency' => CURRENCY, 
        'description' => $jsonObj->description, 
        'payment_method_types' => [ 
            'card' 
        ] 
    ]); 
    
    $output = [ 
        'paymentIntentId' => $paymentIntent->id, 
        'clientSecret' => $paymentIntent->client_secret 
    ]; 
    
    echo json_encode($output); 
} catch (Error $e) {
    http_response_code(500); 
    echo json_encode(['error' => $e->getMessage()]); 
} 
?>