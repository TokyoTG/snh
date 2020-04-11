<?php
require_once('./functions/alert.php');
session_start();
$first_name = $last_name = $email = $password = $gender = $department = $designation = '';
$errorCount = 0;

$_POST['first_name'] !== '' ? $first_name = test_input($_POST['first_name'])  : $errorCount++;
$_POST['last_name'] !== '' ? $last_name = test_input($_POST['last_name'])  : $errorCount++;
$_POST['email'] !== '' ? $email = $_POST['email']  : $errorCount++;
$_POST['password'] !== '' ? $password = test_input($_POST['password'])  : $errorCount++;
$_POST['gender'] !== '' ? $gender = test_input($_POST['gender'])  : $errorCount++;
$_POST['designation'] !== '' ? $designation = test_input($_POST['designation'])  : $errorCount++;
$_POST['department'] !== '' ? $department = test_input($_POST['department'])  : $errorCount++;



$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['gender'] = $gender;
$_SESSION['department'] = $department;
$_SESSION['designation'] = $designation;






if ($errorCount > 0) {
    $session_message = 'Submission failed, you have ' . $errorCount . ' blank field';
    if ($errorCount > 1) {
        $session_message .= "s";
    }
    $session_message .= ' in your form submmision';

    // $_SESSION['error'] = $session_message;
    set_message('error', $session_message);
    header("location:register.php");
    die();
}
if (!preg_match("/^[a-z]+$/i", $first_name) || !preg_match("/^[a-z]+$/i", $last_name)) {
    $_SESSION['error'] = "Firstname and last name cannot have numbers";
    header("location:register.php");
    die();
}

if (strlen($first_name) < 2 || strlen($last_name) < 2) {
    $_SESSION['error'] = "First and last name cannot not be less than 2";
    header("location:register.php");
    die();
}


if (!preg_match("/[a-z0-9.-]+@[a-z-]+\.(com|ng|net|co|org|ng)/i", test_input($email))) {
    $_SESSION['error'] = "Email is invalid";
    header("location:register.php");
    die();
}
if (strlen($email) < 5) {
    $_SESSION['error'] = "Email cannot not be less than 5";
    header("location:register.php");
    die();
} else {


    date_default_timezone_set("Africa/Lagos");
    $dateData = date('d M Y h:i:sa');
    $allusers = scandir('db/users/');
    $numOfUsers = count($allusers);
    $userId = ($numOfUsers - 1);

    $userObject = [
        'id' => $userId,
        'firstname' => $first_name,
        'lastname' => $last_name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'gender' => $gender,
        'department' => $department,
        'designation' => $designation,
        "dateRegistered" => $dateData
    ];


    for ($counter = 0; $counter < $numOfUsers; $counter++) {
        $currentUser = $allusers[$counter];
        if ($currentUser == $email . ".json") {

            // $_SESSION['error'] ='Registration failed, user already exists' ;

            set_message("error", 'Registration failed, user already exists');
            header("location:register.php");
            die();
        }
    }

    file_put_contents("db/users/" . $email . ".json", json_encode($userObject));
    // $_SESSION['message'] = "You have successfully registered you can now login ".$first_name;
    set_message('message', "You have successfully registered you can now login " . $first_name);

    header("location:login.php");
}
