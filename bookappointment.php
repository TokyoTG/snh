<?php

// session_start();
include_once('./libs/header.php');
require_once('./functions/alert.php');
if (!isset($_SESSION['LoggedIn']) || $_SESSION['role'] !== "Patient") {
    $_SESSION['error'] = "You have not login";
    header("location:login.php");
}





?>


<section>
    <a class="btn btn-outline-danger" href="patientDashboard.php" style="margin-left: 20px">&#x2190; Back</a>
    <div class="form-container">
        <div class="welcome">
            <h3>Apointment Form</h3>
            <p>All fields are required</p>
        </div>


        <?php

        print_message();


        ?>
        <form action="proccessapointment.php" method="POST">


            <p>
                <label>Nature of Appointment</label><br>

                <select name="nature">
                    <option value="">Select one</option>
                    <option <?php

                            if (isset($_SESSION['nature']) && $_SESSION['nature'] == 'New Appointment') {
                                echo "selected";
                            }

                            ?>>New Appointment</option>
                    <option <?php

                            if (isset($_SESSION['nature']) && $_SESSION['nature'] == 'FollowUp Appointment') {
                                echo "selected";
                            }

                            ?>>FollowUp Appointment</option>
                </select>
            </p>
            <p>
                <label>Time of Appointment</label><br>
                <input value="<?php

                                if (isset($_SESSION['time']) && $_SESSION['time'] != '') {
                                    echo $_SESSION['time'];
                                    //  $_SESSION['first_name'] = '';      
                                }

                                ?>" name="time" \ type="time">
            </p>
            <p>
                <label>Date of Appointment</label><br>
                <input value="<?php

                                if (isset($_SESSION['date']) && $_SESSION['date'] != '') {
                                    echo $_SESSION['date'];
                                    //  $_SESSION['first_name'] = '';      
                                }

                                ?>" name="date" type="date">
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
                <label>Initial Complaint</label><br>
                <textarea placeholder="Please enter complaint" name="complaint" cols="30" rows="10"><?php
                                                                                                    if (isset($_SESSION['complaint']) && $_SESSION['complaint'] != '') {
                                                                                                        echo $_SESSION['complaint'];
                                                                                                        //  $_SESSION['first_name'] = '';      
                                                                                                    }
                                                                                                    ?></textarea>

            </p>

            <button type="submit">Book Appointment</button>

        </form>
    </div>

</section>

<?php

include_once('./libs/footer.php');

?>