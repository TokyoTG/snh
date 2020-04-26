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
        <h1>Reset Password</h1>
        <p>Please provide a new password for your account</p>
    </div>

    <?php
    // error();
    ?>
    <?php
    print_message();
    ?>

    <form action="processreset.php" method="POST">
        <?php if (!isset($_SESSION['LoggedIn'])) { ?>
            <input type="hidden" name="token" value="<?php
                                                        if (isset($_GET['token'])) {
                                                            echo ($_GET['token']);
                                                        } else {
                                                            if (isset($_SESSION['token'])) {
                                                                echo ($_SESSION['token']);
                                                            }
                                                        }

                                                        ?>">
        <?php } ?>
        <p>
            <label>Email:</label><br>
            <input <?php
                    if (isset($_SESSION['email'])) {
                        echo "value=" . $_SESSION['email'];
                    }
                    ?> <?php
                        if (isset($_SESSION['LoggedIn'])) {
                            echo 'readonly';
                        }
                        ?> type="email" name="email" placeholder="Please enter email">
        </p>
        <p>
            <label>New Password:</label><br>
            <input type="password" name="password" placeholder="Pleas new enter password" required>

        </p>

        <button type="submit">Reset Password</button>
    </form>

</div>

<?php

include_once('./libs/footer.php');

?>