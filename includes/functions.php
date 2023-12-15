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
function get_customer_details($conn, $customerId) {
    $query = "SELECT * FROM customer WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}
function get_customer_name($conn, $customer_id) {
    $query = "SELECT * FROM customer WHERE id = $customer_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $customer = mysqli_fetch_assoc($result);

   $full_name = isset($customer['first_name']) ? $customer['first_name'] : '';
   $full_name .= isset($customer['last_name']) ? ' ' . $customer['last_name'] : '';

   return $full_name !== '' ? $full_name : "Customer not found";
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
function get_order_tax($conn, $orderId) {
    $query = "SELECT * FROM order_tax WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
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


function get_address_details($conn, $addressId) {
    $query = "SELECT * FROM delivery_address WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $addressId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
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
function get_category_name($conn, $category_id) {
    $query = "SELECT * FROM categories WHERE id = $category_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $category = mysqli_fetch_assoc($result);

  
    return $category['category_name'];
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
function insert_successful_orders($conn) {
    $sql = "INSERT INTO order_table (order_id_index, order_total_amount, order_date, customer_id, delivery_address_id, order_status)
            SELECT
                transaction_id AS order_id_index,
                amount AS order_total_amount,
                created_at AS order_date,
                c.id AS customer_id,
                da.id AS delivery_address_id,
                'Approved' AS order_status
            FROM stripe_payment
            JOIN customer c ON stripe_payment.transaction_id = c.id
            JOIN delivery_address da ON c.id = da.id
            WHERE payment_status = 'succeeded'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return $result;
}



?>
