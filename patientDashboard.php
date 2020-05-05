<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
require_once('./functions/checkers.php');

is_patient();
$userData = json_decode($_SESSION['userObject']);
$lastLogIn = fetchDate($_SESSION['email']);
?>


<div id="dashboard">
    <div id="message">

        <?php
        set_message('error', '');
        print_message();


        ?>
        <script>
            autoDismmiss();

            function autoDismmiss() {
                setTimeout(function() {
                    let alertDiv = document.getElementById('alert');
                    alertDiv.style.display = 'none';
                }, 2000)
            }
        </script>
    </div>

    <h1>Patient Dashboard</h1>
    <p><?php
        echo "Welcome " . $userData->firstname . " you are logged in as (" . $userData->designation . ").";
        ?></p>
    <a class="btn btn-outline-success" href="paybill.php">Pay Bill</a>
    <a class="btn btn-outline-primary" href="bookappointment.php">Book Appointment</a>
    <a class="btn btn-outline-primary" href="patientTransactions.php">Transaction History</a>
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