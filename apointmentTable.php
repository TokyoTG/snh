<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
require_once('./functions/getter.php');
if (!isset($_SESSION['LoggedIn']) || $_SESSION['role'] !== "Medical Team(MT)") {
    $_SESSION['error'] = "You have not login";
    header("location:login.php");
}

$userData = json_decode($_SESSION['userObject']);
$lastLogIn = fetchDate($_SESSION['email']);
?>

<section>
    <h1>Appointment Table for <?php echo $userData->department ?> Department</h1>
    <a class="btn btn-outline-danger" href="dashboard.php" style="margin: 20px">Back</a>
    <?php getAppointments($userData->department) ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Nature of Apointment</th>
                <th scope="col">Date of Appointment</th>
                <th scope="col">Initial Complaint</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
        </tbody>
    </table>

</section>