<?php
function get_products($conn) {
    $sql = "SELECT products.*, categories.category_name AS CategoryName 
            FROM products 
            JOIN categories ON products.category_id = categories.id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}


function get_product_by_id($conn, $id) {
    $stmt =  $conn->prepare("SELECT products.*, categories.category_name AS CategoryName  
            FROM products 
            JOIN categories ON products.category_id = categories.id 
            WHERE products.id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
      return $result->fetch_assoc();
  } else {
      return false;
  }
}
function get_categories($conn) {
    $sql = "SELECT * FROM categories";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $categories = [];

    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    return $categories;
}

?>