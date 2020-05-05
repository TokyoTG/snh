<?php
include_once('./libs/header.php');
require_once('./functions/alert.php');
if (!isset($_SESSION['LoggedIn'])) {
    set_message('error', "You are not authorized to be here");
    header("location:login.php");
}

$userData = json_decode($_SESSION['userObject']);

?>


<a class="btn btn-outline-danger" href="patientDashboard.php" style="margin-left: 20px">&#x2190; Back</a>
<div id="payments">
    <div class="header">
        <h2>Make Payment</h2>
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
            <label>Firstname:</label><br>
            <input value=<?php
                            if (isset($userData->firstname)) {
                                echo $userData->firstname;
                            }
                            ?> type="text" name="first_name" readonly>

        </p>
        <p>
            <label>Lastname:</label><br>
            <input value=<?php
                            if (isset($userData->lastname)) {
                                echo $userData->lastname;
                            }
                            ?> type="text" name="last_name" readonly>

        </p>
        <p>
            <label>Email:</label><br>
            <input <?php
                    if (isset($_SESSION['email'])) {
                        echo "value=" . $_SESSION['email'];
                    }
                    ?> type="email" name="email">
        </p>
        <p>
            <label>Amount (NGN)</label><br>
            <input value="3000" type="number" name="amount" readonly>
        </p>
        <p>
            <label>Deparment</label><br>
            <select name="department">
                <option value="">Select one</option>
                <option <?php

                        if (isset($_SESSION['department']) && $_SESSION['department'] == 'Laboratory') {
                            echo "selected";
                        }

                        ?>>Laboratory</option>
                <option <?php

                        if (isset($_SESSION['department']) && $_SESSION['department'] == 'X-ray') {
                            echo "selected";
                        }

                        ?>>X-ray</option>
            </select>
        </p>
        <p>
            <label>Payment Option</label><br>
            <select name="payment_option">
                <option value="">Select one</option>
                <option <?php

                        if (isset($_SESSION['payment_option']) && $_SESSION['payment_option'] == "card") {
                            echo "selected";
                        }

                        ?> value="card">Card Payment</option>
                <option <?php

                        if (isset($_SESSION['payment_option']) && $_SESSION['payment_option'] == 'account') {
                            echo "selected";
                        }
                        ?> value="account">Account Payment</option>

            </select>
        </p>


        <button type="submit">Pay</button>
    </form>
    <div id="flutter">
        <p>
            Secured By Flutterwave
        </p>
    </div>
</div>

<?php

include_once('./libs/footer.php');

?>