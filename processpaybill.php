<?php
require_once('./functions/getter.php');
require_once('./functions/alert.php');
session_start();
$curl = curl_init();

$errorCount = 0;

$_POST['department'] !== '' ? $department = $_POST['department'] : $errorCount++;
$_POST['payment_option'] !== '' ? $payment_option = $_POST['payment_option'] : $errorCount++;

if ($errorCount > 0) {
    $session_message = 'Request failed, you have ' . $errorCount . ' error';
    if ($errorCount > 1) {
        $session_message .= "s";
    }
    $session_message .= ' in your form submmision';
    // $_SESSION['error'] = $session_message;
    set_message('error', $session_message);
    header("location:paybill.php");
    die();
} else {

    $userData = json_decode($_SESSION['userObject']);
    $customer_email = $_POST['email'];
    $amount = 3000;
    $_SESSION['payment_department'] = $department;
    $currency = "NGN";
    $paymentTitle = "Appointment Payment to " . $department . " department";
    $paymentDescription = 'Payment for booking an appointment with a medical team';
    $payment_plan = $department;
    $txref =  generateTxRef(); // ensure you generate unique references per transaction.
    $_SESSION['transaction_ref'] = $txref;
    $PBFPubKey = "FLWPUBK_TEST-051548f031f54923e482bdba45567279-X"; // get your public key from the dashboard.
    $redirect_url = "http://localhost/snh/successfulpayment.php";


    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'amount' => $amount,
            'customer_email' => $customer_email,
            'custom_title' => $paymentTitle,
            'custom_description' => $paymentDescription,
            'customer_firstname' => $userData->firstname,
            "customer_lastname" => $userData->lastname,
            'currency' => $currency,
            'payment_options' => $payment_option,
            'txref' => $txref,
            'PBFPubKey' => $PBFPubKey,
            'redirect_url' => $redirect_url
        ]),
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "cache-control: no-cache"
        ],
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        // there was an error contacting the rave API
        die('Curl returned error: ' . $err);
    }



    $transaction = json_decode($response);

    if (!$transaction->data && !$transaction->data->link) {
        // there was an error from the API
        print_r('API returned error: ' . $transaction->message);
    }

    // uncomment out this line if you want to redirect the user to the payment page
    //print_r($transaction->data->message);


    // redirect to page so User can pay
    // uncomment this line to allow the user redirect to the payment page
    header('Location: ' . $transaction->data->link);
}
