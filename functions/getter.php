<?php

function getAppointments($dept)
{
    $rows = '';
    $rowNum = 0;
    $allAppointments = scandir('db/appointments/');
    $num = count($allAppointments);
    for ($i = 2; $i < $num; $i++) {

        $appointment = json_decode(file_get_contents('db/appointments/' . $allAppointments[$i]));
        if ($appointment->department == $dept) {
            $rowNum++;
            $rows .= "
             <tr>
                <th scope='row'>$rowNum</th>
                <td>$appointment->patientName</td>
                <td>$appointment->nature</td>
                <td>$appointment->date</td>
                <td>$appointment->time</td>
                <td>$appointment->department</td>
                  <td>$appointment->complaint</td>
            </tr>
            ";
        }
    }
    if ($rows == '') {
        return false;
    }
    return $rows;
}


function getAllusers()
{
    $staffRows = '';
    $staffRowNum = 0;
    $patientRows = "";
    $numofPatientRows = 0;
    $allusers = scandir('db/users/');
    $num = count($allusers);
    for ($i = 2; $i < $num; $i++) {
        // echo $allusers[$i];
        $user = json_decode(file_get_contents('db/users/' . $allusers[$i]));
        // print_r($user);
        if ($user->designation == "Medical Team(MT)") {
            $staffRowNum++;
            $staffRows .= "
             <tr>
                <th scope='row'>$staffRowNum</th>
                <td>$user->firstname $user->lastname</td>
                 <td>$user->gender</td>
                <td>$user->designation</td>
                <td>$user->department</td>
                <td>$user->dateRegistered</td>
            </tr>
            ";
        } else if ($user->designation == "Patient") {
            $numofPatientRows++;
            $patientRows .= "
             <tr>
                <th scope='row'>$numofPatientRows</th>
                <td>$user->firstname $user->lastname</td>
                  <td>$user->gender</td>
                <td>$user->designation</td>
                <td>$user->department</td>
                <td>$user->dateRegistered</td>
            </tr>
            ";
        }
    }
    return ['staff' => $staffRows, 'patient' => $patientRows];
}

