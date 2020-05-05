<?php
include_once('./libs/header.php');
require_once('./functions/alert.php');
require_once('./functions/checkers.php');
if (!is_user_loggedIn() && !is_token_set()) {
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
        <?php if (!is_user_loggedIn()) { ?>
            <input type="hidden" name="token" value="<?php
                                                        if (is_token_set_in_get()) {
                                                            echo ($_GET['token']);
                                                        } else {
                                                            if (is_token_set_in_session()) {
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