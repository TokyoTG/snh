<?php
session_start();
if (isset($_SESSION['transaction_successful'])) {
    $subject = "Bill Payment Succesful";
    $email = $_SESSION['email'];
    $message = "Your payment with transaction ID " . $_SESSION['transaction_ref'] . " for " . $_SESSION['payment_department'] . " department appointment booking was successful";
    // $headers = $_SESSION['transaction_ref'];
    $headers = "From: no-reply@snh.ng" . "\r\n" . "CC:tokyo@snh.ng";
    $sent =  mail($email, $subject, $message, $headers);
    unset($_SESSION['transaction_successful']);
    unset($_SESSION['payment_department']);
    set_message('message', "payment successful");
    header("location:patientDashboard.php");
} else {
    echo  $_SESSION['transaction_successful'];
    die('not successful');
}
