<?php 
require_once __DIR__ . '/../database/conn.php'; 
 
require_once __DIR__ . '/../stripe/vendor/autoload.php';

\Stripe\Stripe::setApiKey(STRIPE_SECRET_API_KEY); 

header('Content-Type: application/json'); 

$jsonStr = file_get_contents('php://input'); 
$jsonObj = json_decode($jsonStr); 
?>