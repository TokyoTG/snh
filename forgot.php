<?php
include_once('./libs/header.php');

require_once('./functions/alert.php');
?>

<div id="login">
    <div>
        <h1>Forgot Password</h1>
        <p>Please provide the email associated with your account</p>
    </div>

    <?php
    // error();

    ?>
    <?php
    print_message();

    ?>

    <form action="processforgot.php" method="POST">

        <p>
            <label>Email:</label><br>
            <input value="<?php
                            if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
                                echo $_SESSION['email'];
                                $_SESSION['email'] = '';
                            }

                            ?>" type="email" name="email" placeholder="Please enter email">
        </p>

        <button type="submit">Get reset Token</button>
    </form>

</div>

<?php

include_once('./libs/footer.php');

?>