<?php
require_once("../lib/Simplify.php");

Simplify::$publicKey = 'sbpb_ZTQ3ODk5YWItNjE3YS00ZjNjLTg3MDgtMDM2YjFmOGJjOGY5';
Simplify::$privateKey = 'gN3QMB3AiB6AwhfZgSgtY6T5SB/j6nGg/bXEuHDD3lN5YFFQL0ODSXAOkNtXTToq';

if (isset($_POST['simplifyToken'])) {
    $token = $_POST['simplifyToken']; 
    $amount = '1000'; 
    $currency = 'USD'; 
    $reference = uniqid();
    try {
     
        // error_log("Token: $token");
        // error_log("Amount: $amount");
        // error_log("Currency: $currency");
        // error_log("reference: $reference");

        $payment = Simplify_Payment::createPayment(array(
            'reference' => uniqid(), 
            'amount' => $amount,
            'description' => 'payment description',
            'currency' => $currency,
            'token' => $token,
        ));

      
        error_log(print_r($payment, true));

        if ($payment->paymentStatus == 'APPROVED') {
            echo "Payment approved. Thank you for your purchase!";
        } else {
            echo "Payment failed: " . $payment->paymentStatus;
        }
    } catch (Exception $e) {
        echo "Payment error: " . $e->getMessage();
    }
} else {
    echo "No payment token found.";
}