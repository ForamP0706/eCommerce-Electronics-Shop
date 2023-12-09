<?php
include('includes/header.php');
include('database/conn.php');
include 'includes/functions.php';

if(!empty($_GET['tid'])){
    $transaction_id  = $_GET['tid'];

    $query = "SELECT * FROM `stripe_payment` WHERE transaction_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullname = $row['fullname'];
        $email = $row['email'];
        $item_description = $row['item_description'];
        $currency = $row['currency'];
        $amount = $row['amount'];
        insert_successful_orders($conn);
    }
}else{ 
    header("Location: index.php"); 
    exit(); 
} 
?>
<html>
<head>
<title>Demo Integrate Stripe Payment Gateway using PHP - AllPHPTricks.com</title>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>
<body>

<div class="container">
<h1>Demo Integrate Stripe Payment Gateway using PHP</h1>

<?php if(!empty($row)){ ?>
    <h2 style="color: #327e00;">Success! Your payment has been received successfully.</h2>
    <h3>Payment Receipt:</h3>
    <p><strong>Full Name:</strong> <?php echo $fullname; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Transaction ID:</strong> <?php echo $transaction_id; ?></p>
    <p><strong>Amount:</strong> <?php echo $amount.' '.$currency; ?></p>
    <p><strong>Item Description:</strong> <?php echo $item_description; ?></p>
    <button onclick="location.href='/eCommerce-Electronics-Shop'" class="btn btn-primary">Ok</button>
<?php }else{ ?>
    <h1>Error! Your transaction has been failed.</h1>
<?php } ?>

</div>
</body>
</html>
