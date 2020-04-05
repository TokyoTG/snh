<?php

// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
if (isset($_SESSION['LoggedIn']) && !empty($_SESSION['LoggedIn'])) {
    if ($_SESSION['role'] == "Medical Team(MT)") {
        header("location: dashboard.php");
        die();
    }
    if ($_SESSION['role'] == "Patient") {
        header("location: patientDashboard.php");
        die();
    }
    if ($_SESSION['role'] == "Super Admin") {
        header("location: adminDashboard.php");
    }
}




?>


<section>

    <div class="form-container">
        <div class="welcome">
            <h3>Welcome, Please Register</h3>
            <p>All fields are required</p>
        </div>


        <?php
        // if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
        //      echo "<span style='color:red;'>".$_SESSION['error']. "</span>";

        //  }
        print_message();

        // print_message();
        ?>
        <form action="proccessregister.php" method="POST">
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
                <input value="<?php

                                if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
                                    echo $_SESSION['email'];
                                    //  $_SESSION['first_name'] = '';      
                                }

                                ?>" name="email" placeholder="Please enter email">
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
            <button type="submit">Register</button>
            <p>
                <a href="forgot.php">Forget Password</a> <br>
                <a href="login.php">Already have an account ? Login</a>
            </p>
        </form>
    </div>

</section>

<?php

include_once('./libs/footer.php');

?>