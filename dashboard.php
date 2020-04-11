<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
if (!isset($_SESSION['LoggedIn']) || $_SESSION['role'] !== "Medical Team(MT)") {
    $_SESSION['error'] = "You have not login";
    header("location:login.php");
}

$userData = json_decode($_SESSION['userObject']);
$lastLogIn = fetchDate($_SESSION['email']);
?>


<div id="dashboard">
    <h1>Medical Team Dashboard</h1>
    <p>
        <?php
        echo "Welcome " . $userData->firstname . " you are logged in as (" . $userData->designation . ").";
        ?>
    </p>

    <a class="btn btn-outline-primary" href="apointmentTable.php">View Appointments</a>

</div>
<div class="time">
    <p>Date of Registration : <?php echo  $userData->dateRegistered  ?></p>
    <p>Last Login : <?php
                    if (isset($lastLogIn)) {
                        echo  $lastLogIn;
                    } else {
                        echo $userData->dateRegistered;
                    }
                    ?></p>
    <p>Department : <?php echo $userData->department  ?></p>
</div>


<?php

include_once('./libs/footer.php');

?>