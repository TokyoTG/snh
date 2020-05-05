<?php
session_start();
require_once('./functions/alert.php');
require_once('./functions/checkers.php');
$userData = json_decode($_SESSION['userObject']);
$errorCount = 0;

$_POST['nature'] !== '' ? $nature = test_input($_POST['nature'])  : $errorCount++;
$_POST['time'] !== '' ? $time = test_input($_POST['time'])  : $errorCount++;
$_POST['date'] !== '' ? $date = $_POST['date']  : $errorCount++;
$_POST['complaint'] !== '' ? $complaint = test_input($_POST['complaint'])  : $errorCount++;

$_POST['department'] !== '' ? $department = test_input($_POST['department'])  : $errorCount++;


if ($errorCount > 0) {
    $session_message = 'Submission failed, you have ' . $errorCount . ' blank field';
    if ($errorCount > 1) {
        $session_message .= "s";
    }
    $session_message .= ' in your form submmision';

    set_message('error', $session_message);

    // $_SESSION['error'] = $session_message;
    header("location:bookappointment.php");
    die();
}

if (strlen($complaint) < 5) {
    set_message('error', "Complaint cannot not be less than 5");
    header("location:bookappointment.php");
    die();
} else {
    $_SESSION['nature'] = $nature;
    $_SESSION['time'] = $time;
    $_SESSION['date'] = $date;
    $_SESSION['department'] = $department;
    $_SESSION['complaint'] = $complaint;


    $timeToString = strtotime($time);
    $formattedTiime = date('h:i:sa', $timeToString);
    $allappointment = scandir('db/appointments/');
    $numOfappointments = count($allappointment);
    $Id = ($numOfappointments - 1);

    $apointObject = [
        'id' => $Id,
        'nature' => $nature,
        'time' => $formattedTiime,
        'date' => $date,
        'department' => $department,
        'complaint' => $complaint,
        'patient_email' => $_SESSION['email'],
        "patientName" => $userData->firstname . " " . $userData->lastname
    ];
    // print_r($apointObject);
    // die();


    file_put_contents("db/appointments/" . $Id . ".json", json_encode($apointObject));

    unset($_SESSION['nature']);
    unset($_SESSION['time']);
    unset($_SESSION['date']);
    unset($_SESSION['complaint']);
    unset($_SESSION['department']);
    set_message('message', "You have successfully submitted an apointment to the " . $department . " department");

    header("location:patientDashboard.php");
}
