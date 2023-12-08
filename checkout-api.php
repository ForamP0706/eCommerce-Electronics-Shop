<?php
session_start();
include('database/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $delivery_address = $_POST['delivery_address'];
    $unit_number = $_POST['unit_number'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zip = $_POST['zip'];

    if (!empty($_POST["delivery_address"])) {
        $delivery_address = test_input($_POST["delivery_address"]);
      } else {
           
        $delivery_address = strtoupper($delivery_address);
    }
    
      if (!empty($_POST["city"])) {
        $city = test_input($_POST["city"]);
      }else {
           
        $city = strtoupper($city);
    }
    
      
      if (!empty($_POST["province"])) {
        $province = test_input($_POST["province"]);
      }else {
           
        $province = strtoupper($province);
    }
      
    
     
      if (!empty($_POST["zip"])) {
        $zip = test_input($_POST["zip"]);
    
    
        if (!preg_match("/^\d{5}$/", $zip)) {
          $zipErr = "Invalid zip code format (e.g., 12345)";
        }
        else {
           
          $zip = strtoupper($zip);
      }
      }
      if (!empty($cartProducts) && !empty($delivery_address) && !empty($city) && !empty($province) && !empty($zip)) {
        
        $insertAddressQuery = "INSERT INTO delivery_address (address, unit_number, city, province, zip)
        VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertAddressQuery);
        $stmt->bind_param("sssss", $delivery_address, $unit_number, $city, $province, $zip);
        $stmt->execute();

        
        $delivery_address_id = $stmt->insert_id;

        
        $insert_order_query = "INSERT INTO order_table (order_id_index,order_total_amount, delivery_address_id, customer_id) VALUES (UUID(),?, ?, ?)";
        $stmt = $conn->prepare($insert_order_query);
        $order_total_amount = calculateOrderTotal($cartProducts);
        $stmt->bind_param("dii", $order_total_amount, $delivery_address_id, $customer_id);
        $stmt->execute();

        
        $order_id = $stmt->insert_id;

        
        $insert_order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, product_price) VALUES (?, ?, ?,?)";
        $stmt = $conn->prepare($insert_order_item_query);
        foreach ($cart as $product_id => $quantity) {
            $productPrice = getProductPrice($product_id);

            $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $productPrice);
            $stmt->execute();
        }

       
    }
}


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
function getProductPrice($product_id) {
   
    $query = "SELECT price FROM products WHERE id = ?";
    include('database/conn.php');
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row['price'];
}

