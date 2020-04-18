<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
require_once('./functions/getter.php');
if (!isset($_SESSION['LoggedIn']) || $_SESSION['role'] !== "Super Admin") {
    $_SESSION['error'] = "You have not login";
    header("location:login.php");
}

$userData = json_decode($_SESSION['userObject']);
$lastLogIn = fetchDate($_SESSION['email']);
$userData->dateLog = $lastLogIn;
$table = $_GET['table'];
?>
<section>
    <div id="table">
        <a class="btn btn-outline-danger" href="dashboard.php" style="margin: 20px">&#x2190; Back</a>
        <?php

        $rowArry = getAllusers();
        ?>
        <table class="table table-bordered">
            <caption>
                <?php
                echo $table;
                ?> Table </caption>
            <thead class="thead-dark ">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Department</th>
                    <th scope="col">Date of Registration</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $rowArry[$table]; ?>
            </tbody>
        </table>
    </div>
</section>