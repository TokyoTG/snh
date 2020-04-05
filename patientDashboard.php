<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
if (!isset($_SESSION['LoggedIn'])) {
    $_SESSION['error'] = "You have not login";
    header("location:login.php");
}

$userData = json_decode($_SESSION['userObject']);
$lastLogIn = fetchDate($_SESSION['email']);
?>


<div id="dashboard">
    <h1>Patient Dashboard</h1>
    <?php
    echo "Welcome " . $userData->firstname . " you are logged in as (" . $userData->designation . ").";
    ?>
</div>
<div class="time">
    <p>Date of Registration : <?php echo  $userData->dateRegistered  ?></p>
    <p>Last Login : <?php echo  $lastLogIn;  ?></p>
    <p>Department : <?php echo $userData->department  ?></p>
</div>

<?php

include_once('./libs/footer.php');

?>