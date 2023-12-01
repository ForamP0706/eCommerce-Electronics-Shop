<?php
// //Stripe Credentials Configuration
// define("STRIPE_SECRET_API_KEY", "sk_test_51OHfmDIfuNxYRy4KbZyC5yckBSpGMkck89ltKULgfmcJTwtM1gtDSPEnwMTu3yqmUEHqmyP0zegFxPosVN8RIajP00MQOLhfaF");
// define("STRIPE_PUBLISHABLE_KEY", "pk_test_51OHfmDIfuNxYRy4Ki6laL1ARSyoSY2MUJnOUYDvTHQbNkdBcpo26inIWooN38JIc8VSgqNMooQEcs9zHRHcxLtOz00FKtRjWqz");

// define('CURRENCY', 'CAD');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "electronics";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>