<?php

require_once('./functions/alert.php');
session_start();

if (isset($_GET['txref'])) {
    $ref = $_GET['txref'];
    $amount = "3000"; //Correct Amount from Server
    $currency = "NGN"; //Correct Currency from Server

    $query = array(
        "SECKEY" => "FLWSECK_TEST-b0f0a1ea74bc0e2e223feea7d5f71daa-X",
        "txref" => $ref
    );

    $data_string = json_encode($query);
    $payments = scandir("db/payments");
    $id = count($payments) - 1;
    $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);

    $resp = json_decode($response, true);

    $paymentStatus = $resp['data']['status'];
    $chargeResponsecode = $resp['data']['chargecode'];
    $chargeAmount = $resp['data']['amount'];
    $chargeCurrency = $resp['data']['currency'];
    if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
        // transaction was successful...
        file_put_contents("db/payments/" . $id . ".json", $response);
        set_message('message', "payment successful");
        header("location:patientDashboard.php");
        // please check other things like whether you already gave value for this ref
        // if the email matches the customer who owns the product etc
        //Give Value and return to Success page
    } else {
        //Dont Give Value and return to Failure page

    }
} else {
    die('No reference supplied');
}
