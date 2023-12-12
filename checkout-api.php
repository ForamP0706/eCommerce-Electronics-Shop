<?php
require_once 'stripe-api/stripe_header.php';
require_once 'total_amount.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delivery_address = $jsonObj->delivery_address;
    $unit_number = $jsonObj->unit_number;
    $city = $jsonObj->city;
    $customer_id = $jsonObj->customer_id;
    $province = $jsonObj->province;
    $zip = $jsonObj->zip;

    if (!empty($jsonObj->delivery_address)) {
        $delivery_address = test_input($jsonObj->delivery_address);
      } else {
           
        $delivery_address = strtoupper($delivery_address);
    }
    
      if (!empty($jsonObj->city)) {
        $city = test_input($jsonObj->city);
      }else {
           
        $city = strtoupper($city);
    }
    
      
      if (!empty($jsonObj->province)) {
        $province = test_input($jsonObj->province);
      }else {
           
        $province = strtoupper($province);
    }
      
    
     
      if (!empty($jsonObj->zip)) {
        $zip = test_input($jsonObj->zip);
    
    
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

        $insert_order_tax_query = "INSERT INTO order_tax (order_id, tax_amount) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_order_tax_query);
        $tax = $order_total_amount * 0.13;
        $stmt->bind_param("id",$order_id, $tax);
        $stmt->execute();

        
        $insert_order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, product_price) VALUES (?, ?, ?,?)";
        $stmt = $conn->prepare($insert_order_item_query);
        foreach ($cart as $product_id => $quantity) {
            $productPrice = getProductPrice($product_id);

            $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $productPrice);
            $stmt->execute();
        }

       echo "{\"order_id\": \"$order_id\"}";
    }
}


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

