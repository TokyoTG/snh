<?php
// session_start();

include_once('./libs/header.php');
require_once('./functions/alert.php');
require_once('./functions/checkers.php');

if (is_user_loggedIn()) {
    if ($_SESSION['role'] == "Medical Team(MT)") {
        header("location: dashboard.php");
    }
    if ($_SESSION['role'] == "Patient") {
        header("location: patientDashboard.php");
    }
    if ($_SESSION['role'] == "Super Admin") {
        header("location: adminDashboard.php");
    }
}


?>



<div id="login">
    <div>
        <h1>Login</h1>
    </div>

    <?php
    print_message();


    ?>

    <form action="processlogin.php" method="POST">

        <p>
            <label>Email:</label><br>
            <input value="<?php
                            if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
                                echo $_SESSION['email'];
                                //     $_SESSION['first_name'] = '';     
                            }

                            ?>" type="email" name="email" placeholder="Please enter email">
        </p>


        <p>
            <label>Password:</label><br>
            <input type="password" name="password" placeholder="Pleas enter password">

        </p>
        <p>
            <a href="forgot.php">Forget Password</a> <br>
            <a href="register.php">Don't have an account ? Register</a>
        </p>
        <button type="submit">Login</button>
    </form>

</div>


<?php

include_once('./libs/footer.php');

?>