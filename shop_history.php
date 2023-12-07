 <?php
 include('includes/header.php');
 include('includes/navbar.php');

?>
 <?php
// include('database/conn.php');
$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;

if ($customer_id) {
    $order_history_query = "SELECT o.order_id_index, o.order_total_amount, oi.product_id, oi.quantity, oi.product_price, p.prod_name, o.order_date, d.address, d.unit_number, d.city, d.province, d.zip
                    FROM order_table o
                    JOIN order_items oi ON o.ID = oi.order_id
                    JOIN delivery_address d ON o.delivery_address_id = d.ID
                    JOIN products p ON oi.product_id = p.id
                    WHERE o.customer_id = ? GROUP BY o.order_id_index";

    $stmt = $conn->prepare($order_history_query);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $order_history_result = $stmt->get_result();
   

    if ($order_history_result->num_rows > 0) {
        echo '<div class="box">';
        echo '<h1>Order History</h1>';
        while ($order = $order_history_result->fetch_assoc()) {
            echo '<div class="order">';
            echo '<div class="order-details">';
            echo '<h3>Order ID: ' . $order['order_id_index'] . '</h3>';
            echo '<h3>Total Amount: $' . number_format($order['order_total_amount'], 2) . '</h3>';
            echo '</div>';
            echo '<ul class="order-items">';
            echo '<li class="order-item">';
            echo '<div class="product-info">';
            echo '<span class="product-name">' . $order['prod_name'] . '</span>';
            echo '<span class="product-price">$' . number_format($order['product_price'], 2) . '</span>';
            echo '</div>';
            echo '<p><strong>Quantity : </strong>' . $order['quantity'] . '</p>';
            echo '<p><strong>Order Date :</strong> ' . $order['order_date'] . '</p>';
            echo '<span><strong>Delivery Address:</strong> </span>';
            echo $order['address'] .' '.$order['unit_number'].'<br>';
            echo $order['city'] .' '.$order['province'].' '.$order['zip'] .'<br>';         
            echo '</li>';
            echo '</ul>';          
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo '<div class="container">';
        echo '<h1>Order History</h1>';
        echo '<p class="no-orders">You have no orders in your history.</p>';
        echo '</div>';
    }
} else {
    echo "Please log in to view your order history.";
}

include('includes/footer.php');
?> 

 <style>
      
        .box{
            width:70%;
            margin:auto;
            padding:50px;
        }
        h1 {
            color: #333;
        }

        .order {
            margin: 20px 0;
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 5px;
         
        }

        .order-details {
            display: flex;
            justify-content: space-between;
        }

        .order-details h3 {
            font-size: 18px;
            color: #555;
        }

        .order-items {
            list-style: none;
            padding: 0;
        }

        .order-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item .product-info {
            display: flex;
            justify-content: space-between;
        }

        .order-item .product-info .product-name {
            font-weight: bold;
        }

        .order-item .product-info .product-price {
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .no-orders {
            text-align: center;
            color: #777;
            font-style: italic;
            margin-top: 20px;
        }
    </style> 
