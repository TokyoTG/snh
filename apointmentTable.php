<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
require_once('./functions/getter.php');
require_once('./functions/checkers.php');
is_medicalTeam();
$userData = json_decode($_SESSION['userObject']);
$lastLogIn = fetchDate($_SESSION['email']);
?>

<section>
    <div id="table">
        <!-- <h1>Appointment Table for <?php echo $userData->department ?> Department</h1> -->
        <a class="btn btn-outline-danger" href="dashboard.php" style="margin: 20px">&#x2190; Back</a>
        <?php
        $rows = getAppointments($userData->department);
        if ($rows) {

        ?>
            <table class="table table-bordered">
                <caption>
                    <?php echo $userData->department ?> Department Appointments</caption>
                <thead class="thead-dark ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Nature of Apointment</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Time</th>
                        <th scope="col">Department</th>
                        <th scope="col">Initial Complaint</th>
                        <th scope="col">Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $rows; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>You have no pending appointments</p>
        <?php } ?>

    </div>
</section>