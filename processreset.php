<?php
session_start();
require_once('./functions/alert.php');
require_once('./functions/checkers.php');


$errorCount = 0;
if (!isset($_SESSION['LoggedIn'])) {
    $_POST['token'] !== '' ? $token = $_POST['token'] : $errorCount++;
    $_SESSION['token'] = $token;
}

$_POST['email'] !== '' ? $email = $_POST['email'] : $errorCount++;
$_POST['password'] !== '' ? $password = $_POST['password'] : $errorCount++;

if ($errorCount > 0) {
    $session_message = 'Reset failed, you have ' . $errorCount . ' error';
    if ($errorCount > 1) {
        $session_message .= "s";
    }
    $session_message .= ' in your form submmision';
    set_message('error', $session_message);
    header("location:reset.php");
} else {
    $_SESSION['email'] = $email;
    $checkedToken = find_token($email);
    if ($checkedToken) {
        $tokenObject = json_decode(file_get_contents('db/tokens/' . $email . ".json"));
        $tokenFromDB = $tokenObject->token;
        $user_exists = find_user($email);
        if ($tokenFromDB == $token) {
            if ($user_exists) {
                $user_exists->password = password_hash($password, PASSWORD_DEFAULT);
                unlink('db/users/' . $user_exists->email . ".json");
                unlink('db/tokens/' . $user_exists->email . ".json");
                save_userObject($user_exists, $email);
                $subject = "Password Reset Succesful";
                $message = "Your account on snh has been updated, your password has changed.
             If you do not request this change, please visit snh.org and reset your password ";
                $headers = "From: no-reply@snh.ng" . "\r\n" . "CC:tokyo@snh.ng";
                $sent =  mail($email, $subject, $message, $headers);

                if ($sent) {
                    session_unset();
                    $_SESSION['email'] = $email;
                    set_message('message', "Password reset successful, you can now login");
                    //  $_SESSION['message'] = "Password reset successful, you can now login";                  
                    header("location:login.php");
                    die();
                }
            }
        } else {
            set_message('error', 'Password reset failed, token/email invalid or expired');
            header("location:reset.php");
        }
    } else {
        set_message('error', 'Password reset failed, token/email invalid or expired');
        header("location:reset.php");
    }
}
