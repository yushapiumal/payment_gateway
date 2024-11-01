<?php
session_start();
require_once("../lib/Simplify.php");

Simplify::$publicKey = 'sbpb_NjU0NWMyMjMtMzVmYi00ZWVjLWI0NDItN2I4MjljZWJiM2I0';
Simplify::$privateKey = '5Hsh1LbHPktNOcWZ0ZBwUQADlyquDfSmiPMwX7qxrzd5YFFQL0ODSXAOkNtXTToq';

$notificationMessage = '';

if (isset($_POST['simplifyToken'])) {
    $token = $_POST['simplifyToken'];
    $amount = '1000';
    $currency = 'USD';
    $reference = uniqid();
    try {
        $payment = Simplify_Payment::createPayment(array(
            'reference' => $reference,
            'amount' => $amount,
            'description' => 'payment description',
            'currency' => $currency,
            'token' => $token,
        ));

        if ($payment->paymentStatus == 'APPROVED') {
            $notificationMessage = 'Payment Approved! Thank you for your purchase!';
            $status = 'APPROVED';
        } else {
            $notificationMessage = 'Payment Failed: ' . htmlspecialchars($payment->paymentStatus);
            $status = 'FAILED';
        }
    } catch (Exception $e) {
        $notificationMessage = 'Payment Error: ' . htmlspecialchars($e->getMessage());
        $status = 'ERROR';
    }
} else {
    $notificationMessage = 'No Payment Token Found. Please try again.';
    $status = 'ERROR';
}

header("Location: ../index.php?status=$status&message=" . urlencode($notificationMessage));
exit();
?>
