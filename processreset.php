<?php
require_once('./functions/alert.php');
session_start();

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
    // $_SESSION['error'] = $session_message;
    set_message('error', $session_message);
    header("location:reset.php");
} else {
    $_SESSION['email'] = $email;
    $alltokens = scandir('db/tokens/');
    $numOfTokens = count($alltokens) - 1;

    for ($counter = 0; $counter < $numOfTokens; $counter++) {
        $currentToken = $alltokens[$counter];
        if (isset($_SESSION['LoggedIn'])) {
            $checkedToken = true;
        } else {
            $checkedToken = $currentToken == $email . ".json";
        }
        if ($checkedToken) {

            $tokenObject = json_decode(file_get_contents('db/tokens/' . $currentToken));
            $tokenFromDB = $tokenObject->token;
            if ($tokenFromDB == $token) {
                $allusers = scandir('db/users/');
                $numOfUsers = count($allusers);
                for ($counter = 0; $counter < $numOfUsers; $counter++) {
                    $currentUser = $allusers[$counter];
                    if ($currentUser == $email . ".json") {
                        $userObject = json_decode(file_get_contents('db/users/' . $currentUser));
                        $userObject->password = password_hash($password, PASSWORD_DEFAULT);
                        unlink('db/users/' . $currentUser);
                        unlink('db/tokens/' . $currentToken);
                        file_put_contents("db/users/" . $email . ".json", json_encode($userObject));


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
                }
            }
        }
    }
    //   $_SESSION['error'] ='Password reset failed, token/email invalid or expired' ;
    set_message('error', 'Password reset failed, token/email invalid or expired');
    header("location:reset.php");
}
