<?php
require_once('./functions/alert.php');
session_start();

$errorCount = 0;

$_POST['email'] !== '' ? $email = $_POST['email'] : $errorCount++;
$_POST['password'] !== '' ? $password = $_POST['password'] : $errorCount++;

$_SESSION['email'] = $email;


if ($errorCount > 0) {
    $session_message = 'Submission Failed, you have ' . $errorCount . ' blank field';
    if ($errorCount > 1) {
        $session_message .= "s";
    }
    $session_message .= ' in your form submmision';
    // $_SESSION['error'] = $session_message;
    set_message('error', $session_message);
    header("location: login.php");
} else {
    $allusers = scandir('db/users/');
    $numOfUsers = count($allusers);
    for ($counter = 0; $counter < $numOfUsers; $counter++) {
        $currentUser = $allusers[$counter];
        if ($currentUser == $email . ".json") {
            $userObject = json_decode(file_get_contents('db/users/' . $currentUser));
            $passwordFromDB = $userObject->password;
            if (password_verify($password, $passwordFromDB)) {
                $_SESSION['LoggedIn'] = $userObject->id;
                $_SESSION['email'] = $userObject->email;
                // $_SESSION['first_name'] = $userObject->firstname;
                $_SESSION['role'] = $userObject->designation;
                $_SESSION['userObject'] = json_encode($userObject);
                // $_SESSION['register_date'] = $userObject->dateRegistered;

                if ($userObject->designation == "Medical Team(MT)") {
                    header("location: dashboard.php");
                    die();
                }
                if ($userObject->designation == "Patient") {
                    header("location: patientDashboard.php");
                    die();
                }
                if ($userObject->designation == "Super Admin") {
                    header("location: adminDashboard.php");
                    die();
                }
            }
        }
    }
    //  $_SESSION['error'] ='Invalid Email or Password' ;
    set_message('error', 'Invalid Email or Password');
    header("location:login.php");
}
