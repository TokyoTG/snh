<?php
// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
if (!isset($_SESSION['LoggedIn'])) {
    $_SESSION['error'] = "You have not login";
    header("location:login.php");
}

$userData = json_decode($_SESSION['userObject']);
$lastLogIn = fetchDate($_SESSION['email']);
$userData->dateLog = $lastLogIn;
?>

<div id="dashboard">

    <h1 class="display-4">Admin Dashboard</h1>
    <p class="lead">Click on the button to create user</p>
    <p>
        <a class="btn btn-bg btn-outline-success" href="#form">Create New User</a>
    </p>
    <?php
    echo "Welcome " . $userData->firstname . " you are logged in as (" . $userData->designation . ").";
    ?>
</div>
<div class="time">
    <p>Date of Registration : <?php echo  $userData->dateRegistered  ?></p>
    <p>Last Login : <?php echo  $lastLogIn;  ?></p>
    <p>Department : <?php echo $userData->department  ?></p>
</div>

<section id="form">

    <div class=" form-container">
        <div class="welcome">
            <h3>Create New User</h3>
            <p>All fields are required</p>
        </div>


        <?php
        print_message();
        ?>
        <form action="proccesscreate.php" method="POST">
            <p>
                <label>First Name:</label><br>
                <input value="<?php

                                if (isset($_SESSION['first_name']) && $_SESSION['first_name'] != '') {
                                    echo $_SESSION['first_name'];
                                    //  $_SESSION['first_name'] = '';      
                                }

                                ?>" type="text" name="first_name" placeholder="Please enter first name" value="<?php echo $first_name ?>">
            </p>


            <p>
                <label>Last Name:</label><br>
                <input value="<?php

                                if (isset($_SESSION['last_name']) && $_SESSION['last_name'] != '') {
                                    echo $_SESSION['last_name'];
                                    //  $_SESSION['first_name'] = '';      
                                }

                                ?>" type="text" name="last_name" placeholder="Please enter last name">
            </p>


            <p>
                <label>Email:</label><br>
                <input name="email" placeholder="Please enter email">
            </p>


            <p>
                <label>Password:</label><br>
                <input value="<?php

                                if (isset($_SESSION['password']) && $_SESSION['password'] != '') {
                                    echo $_SESSION['password'];
                                    //  $_SESSION['first_name'] = '';      
                                }

                                ?>" type="password" name="password" placeholder="Pleas enter password">
            </p>
            <p>
                <label>Gender</label><br>
                <select name="gender">
                    <option value="">Select one</option>
                    <option <?php

                            if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') {
                                echo "selected";
                            }

                            ?>>Male</option>


                    <option <?php

                            if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') {
                                echo "selected";
                            }

                            ?>>Female</option>
                </select>
            </p>
            <p>
                <label>Designation</label><br>
                <select name="designation">
                    <option value="">Select one</option>
                    <option <?php

                            if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team(MT)') {
                                echo "selected";
                            }

                            ?>>Medical Team(MT)</option>
                    <option <?php

                            if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient') {
                                echo "selected";
                            }

                            ?>>Patient</option>
                </select>
            </p>
            <p>
                <label>Deparment</label><br>
                <input value="<?php

                                if (isset($_SESSION['department']) && $_SESSION['department'] != '') {
                                    echo $_SESSION['department'];
                                    //  $_SESSION['first_name'] = '';      
                                }

                                ?>" type="text" name="department" placeholder="Please enter deparment">
            </p>
            <button type="submit">Create User</button>
        </form>
    </div>

</section>



<?php

include_once('./libs/footer.php');

?>