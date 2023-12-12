<?php 
require_once 'stripe_header.php';

$payment = !empty($jsonObj->payment_intent)?$jsonObj->payment_intent:''; 
$customer_id = !empty($jsonObj->customer_id)?$jsonObj->customer_id:''; 
$order_id = !empty($jsonObj->order_id)?$jsonObj->order_id:''; 
    
try {
    $customerData = \Stripe\Customer::retrieve($customer_id);  
}catch(Exception $e) { 
    $error = $e->getMessage(); 
}

if(empty($error)) {
    if(!empty($payment) && $payment->status == 'succeeded'){
        $transaction_id = $payment->id; 
        $amount = ($payment->amount/100); 
        $currency = $payment->currency; 
        $item_description = $payment->description; 
        $payment_status = $payment->status; 
            
        $fulname = $email = ''; 
        if(!empty($customerData)){
            if(!empty($customerData->name)) {
                $fullname = $customerData->name;
            }
            if(!empty($customerData->email)) {
                $email = $customerData->email;
            }
        }

        $query = "SELECT id FROM `stripe_payment` WHERE transaction_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $transaction_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            $insertQuery = "INSERT INTO `stripe_payment` (`fullname`, `email`, `item_description`, `currency`, `amount`, `transaction_id`,  `payment_status`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("ssssdss", $fullname, $email, $item_description, $currency, $amount, $transaction_id, $payment_status);
            $stmt->execute();
        }
        $query = "UPDATE `order_table` set order_status = 'Approved' where `ID` = ?";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die('Error preparing statement: ' . $conn->error);
        }
       $stmt->bind_param("s", $jsonObj->order_id);
        $stmt->execute();
        
        $conn->close();
        $output = [ 
            'transaction_id' => $transaction_id
        ];
        echo json_encode($output); 
    }else{ 
        http_response_code(500); 
        echo json_encode(['error' => 'Transaction has been failed!']); 
    } 
}else{ 
    http_response_code(500);
    echo json_encode(['error' => $error]); 
} 
?>
