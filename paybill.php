<?php
include_once('./libs/header.php');
require_once('./functions/alert.php');
if (!isset($_GET['token']) && !isset($_SESSION['token']) && !isset($_SESSION['LoggedIn'])) {
    set_message('error', "You are not authorized to be here");
    header("location:login.php");
}

?>

<div id="login">
    <div>
        <h1>Make Payment</h1>
        <p>Payment for booking an appointment with a medical team</p>
    </div>

    <?php
    // error();
    ?>
    <?php
    print_message();
    ?>

    <form action="processpaybill.php" method="POST">
        <p>
            <label>Email:</label><br>
            <input <?php
                    if (isset($_SESSION['email'])) {
                        echo "value=" . $_SESSION['email'];
                    }
                    ?> type="email" name="email" readonly>
        </p>
        <p>
            <label>Amount in NGN</label><br>
            <input <?php
                    if (isset($_SESSION['amount'])) {
                        echo "value=" . $_SESSION['amount'];
                    }
                    ?> type="number" name="amount" readonly>
        </p>


        <button type="submit">Pay With Flutterwave</button>
    </form>
    <div>
        <p>
            Secured By Flutterwave
        </p>
    </div>
</div>

<?php

include_once('./libs/footer.php');

?>