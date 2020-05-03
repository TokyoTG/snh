<?php
session_start();
$curl = curl_init();


$userData = json_decode($_SESSION['userObject']);
$customer_name = $userData->firstname . " " . $userData->lastname;
$customer_email = $_SESSION['email'];
$amount = 3000;
$currency = "NGN";
$txref = "rave-2993331"; // ensure you generate unique references per transaction.
$PBFPubKey = "FLWPUBK_TEST-051548f031f54923e482bdba45567279-X"; // get your public key from the dashboard.
$redirect_url = "http://localhost/snh/successpayment.php";


curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'amount' => $amount,
        'customer_email' => $customer_email,
        'customer_email' => $customer_name,
        'currency' => $currency,
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
