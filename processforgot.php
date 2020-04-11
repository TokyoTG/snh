<?php
require_once('./functions/alert.php');
session_start();

$errorCount = 0;

$_POST['email'] !== '' ? $email = $_POST['email'] : $errorCount++;

$_SESSION['email'] = $email;


if ($errorCount > 0) {
    $session_message = 'Process failed, you have ' . $errorCount . ' error';
    if ($errorCount > 1) {
        $session_message .= "s";
    }
    $session_message .= ' in your form submmision';
    // $_SESSION['error'] = $session_message;
    set_message('error', $session_message);
    header("location: forgot.php");
} else {
    $allusers = scandir('db/users/');
    $numOfUsers = count($allusers);
    for ($counter = 0; $counter < $numOfUsers; $counter++) {
        $currentUser = $allusers[$counter];
        if ($currentUser == $email . ".json") {
            $token = generateToken();

            $subject = "Password reset link";
            $message = "A password reset has been initiated on this account, if you do not initiate this reset,
            please ignore this message. Otherwise, visit: localhost/snh/reset.php?token=" . $token;
            $headers = "From: no-reply@snh.ng" . "\r\n" . "CC:tokyo@snh.ng";

            file_put_contents("db/tokens/" . $email . ".json", json_encode(['token' => $token]));
            $sent =  mail($email, $subject, $message, $headers);

            //    print_r($sent);
            if ($sent) {
                // $_SESSION['message'] ='Password reset link as be sent to your email: '.$email ;
                set_message('message', 'Password reset link as be sent to your email: ' . $email);
                header("location:login.php");
            } else {
                set_message('error', "Something went wrong we coud not sent password reset link to email: " . $email);
                header("location:forgot.php");
            }
            die();
        }
    }
    // $_SESSION['error'] ='Email not registered with us ERR: '.$email ;
    set_message('error', 'Email not registered with us ERR: ' . $email);
    header("location:forgot.php");
}
