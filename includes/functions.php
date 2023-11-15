<?php
function get_products($conn) {
    $sql = "SELECT products.*, categories.category_name AS CategoryName 
            FROM products 
            JOIN categories ON products.category_id = categories.id";
    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}

function get_customers($conn) {
    $query = "SELECT * FROM customer";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    $customers = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }

    return $customers;
}
function get_customer_by_id($conn, $customer_id) {
    $query = "SELECT * FROM customer WHERE id = $customer_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $customer = mysqli_fetch_assoc($result);

    return $customer;
}
function update_customer($conn, $customer_id, $first_name, $last_name, $email, $password) {
    // here we customer table 
    $query = "UPDATE customer SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password' WHERE id = $customer_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return true; 
}
function delete_customer($conn, $customer_id) {
    $query = "DELETE FROM customer WHERE id = $customer_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return true;
}
function get_orders($conn) {
    $sql = "SELECT * FROM order_table";
    $result = mysqli_query($conn, $sql);

    $orders = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
    }

    return $orders;
}

function get_order_details($conn, $orderId) {
   
    $orderId = mysqli_real_escape_string($conn, $orderId);

    $query = "SELECT * FROM `order_table` WHERE ID = '$orderId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
       
        $orderDetails = mysqli_fetch_assoc($result);
        return $orderDetails;
    } else {
        return false; 
    }
}


function update_order_status($conn, $orderId, $newStatus) {
    // Prepare the SQL query
    $sql = "UPDATE `order_table` SET `order_status` = ? WHERE `ID` = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("si", $newStatus, $orderId);

    // Execute the statement
    $result = $stmt->execute();

    // Close the statement
    $stmt->close();

    return $result;
}



function delete_order($conn, $orderId) {
    
    $orderId = mysqli_real_escape_string($conn, $orderId);

    $query = "DELETE FROM `order_table` WHERE ID = '$orderId'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        return true; // Order deleted successfully
    } else {
        return false; // Failed to delete order
    }
}

function get_product_by_id($conn, $id) {
    $sql = "SELECT products.*, categories.category_name AS CategoryName  
            FROM products 
            JOIN categories ON products.category_id = categories.id 
            WHERE products.id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

function get_category_by_id($conn, $id) {
    $sql = "SELECT * 
            FROM categories             
            WHERE categories.id = $id";
            
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}


function get_categories($conn) {
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);
    $categories = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    return $categories;
}

// function calculateTotalAmountFromCart($conn) {
//     $totalAmount = 0;

//     if (!empty($_SESSION['cart'])) {
//         $productIds = array_keys($_SESSION['cart']);

//         // Fetch the prices of the products from the database
//         $productQuery = "SELECT id, price FROM products WHERE id IN (" . implode(',', $productIds) . ")";
//         $productResult = $conn->query($productQuery);

//         // Calculate the total amount by summing the prices of the products in the cart
//         while ($product = $productResult->fetch_assoc()) {
//             $productId = $product['id'];
//             $quantity = $_SESSION['cart'][$productId];
//             $price = $product['price'];
//             $subtotal = $quantity * $price;
//             $totalAmount += $subtotal;
//         }
//     }

//     return $totalAmount;
// }


?>
