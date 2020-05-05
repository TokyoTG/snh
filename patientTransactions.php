<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
require_once('./functions/getter.php');
if (!isset($_SESSION['LoggedIn']) || $_SESSION['role'] !== "Patient") {
    set_message('error', "You have not login");
    header("location:login.php");
}

$userData = json_decode($_SESSION['userObject']);
$lastLogIn = fetchDate($_SESSION['email']);
?>

<section>
    <div id="table">
        <!-- <h1>Appointment Table for <?php echo $userData->department ?> Department</h1> -->
        <a class="btn btn-outline-danger" href="dashboard.php" style="margin: 20px">&#x2190; Back</a>
        <?php
        $rows = getTransactionsHistory($_SESSION['email']);
        if ($rows) {

        ?>
            <table class="table table-bordered">
                <caption>
                    Transaction History</caption>
                <thead class="thead-dark ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Department</th>
                        <th scope="col">ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    echo $rows;
                    ?>
                </tbody>
            </table>
        <?php
        } else {
        ?>
            <p>You have no transactions to be displayed</p>
        <?php
        }
        ?>

    </div>
</section>