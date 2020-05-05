<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
require_once('./functions/getter.php');
require_once('./functions/checkers.php');
is_admin();

?>
<section>
    <div id="table">
        <a class="btn btn-outline-danger" href="dashboard.php" style="margin: 20px">&#x2190; Back</a>
        <?php

        $rows = getAllTransactions();
        if ($rows !== '') {
        ?>
            <table class="table table-bordered">
                <caption>
                    Payments Table </caption>
                <thead class="thead-dark ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Patient Email</th>
                        <th scope="col">Amount Paid</th>
                        <th scope="col">Transaction Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Department</th>
                        <th scope="col">Transaction ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    echo $rows;
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>OOps no payment to be displayed</p>
        <?php } ?>

    </div>
</section>