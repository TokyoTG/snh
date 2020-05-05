<?php

function getDeptPaymentsEmail($dept)
{
    $allpayments = scandir('db/payments/');
    $paymentsEmails = [];
    $numPayments = count($allpayments);
    for ($j = 2; $j < $numPayments; $j++) {
        $currentPayment = json_decode(file_get_contents('db/payments/' . $allpayments[$j]));
        if ($currentPayment->department === $dept) {
            array_push($paymentsEmails, $currentPayment->email);
        }
    }
    return $paymentsEmails;
}

function getAppointments($dept)
{
    $rows = '';
    $rowNum = 0;
    $allAppointments = scandir('db/appointments/');
    $paymentsEmails = getDeptPaymentsEmail($dept);
    $num = count($allAppointments);
    for ($i = 2; $i < $num; $i++) {
        $appointment = json_decode(file_get_contents('db/appointments/' . $allAppointments[$i]));
        if ($appointment->department == $dept) {
            $rowNum++;
            if (in_array($appointment->patient_email, $paymentsEmails)) {
                $rows .= "
             <tr>
                <th scope='row'>$rowNum</th>
                <td>$appointment->patientName</td>
                <td>$appointment->nature</td>
                <td>$appointment->date</td>
                <td>$appointment->time</td>
                <td>$appointment->department</td>
                  <td>$appointment->complaint</td>
                    <td>Paid</td>
            </tr>
            ";
            } else {
                $rows .= "
             <tr>
                <th scope='row'>$rowNum</th>
                <td>$appointment->patientName</td>
                <td>$appointment->nature</td>
                <td>$appointment->date</td>
                <td>$appointment->time</td>
                <td>$appointment->department</td>
                  <td>$appointment->complaint</td>
                    <td>Not Paid</td>
            </tr>
            ";
            }
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
                <td>$user->email</td>
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
                <td>$user->email</td>  
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

function generateTxRef()
{
    $txref = "";
    $alphabets = [3, 'b', 4, 'B', 'c', 5, 'd', 9, 'e', 6, 'f', 7, 'g', 'G', 'i', 2, 'j', 'm', 8, 'y', 'z', 'w', 0];

    for ($i = 0; $i < 20; $i++) {
        $index = mt_rand(0, count($alphabets) - 1);
        $txref .= $alphabets[$index];
    }
    return $txref;
}

function getTransactionsHistory($email)
{
    $rows = '';
    $rowNum = 0;
    $payments = scandir('db/payments/');
    $num = count($payments);
    for ($i = 2; $i < $num; $i++) {
        $currentPayment = json_decode(file_get_contents('db/payments/' . $payments[$i]));
        // print_r($user);
        if ($currentPayment->email == $email) {
            $rowNum++;
            $rows .= "
             <tr>
                <th scope='row'>$rowNum</th>
                <td>$currentPayment->amount</td>
                 <td>$currentPayment->type</td>
                <td>$currentPayment->date</td>
                <td>$currentPayment->time</td>
                 <td>$currentPayment->department</td>
                <td>$currentPayment->txRef</td>
            </tr>
            ";
        }
    }

    return $rows;
}

function getAllTransactions()
{
    $rows = '';
    $rowNum = 0;
    $payments = scandir('db/payments/');
    $num = count($payments);
    for ($i = 2; $i < $num; $i++) {
        $currentPayment = json_decode(file_get_contents('db/payments/' . $payments[$i]));
        // print_r($user);
        $rowNum++;
        $rows .= "
             <tr>
                <th scope='row'>$rowNum</th>
                <td>$currentPayment->email</td>
                 <td>$currentPayment->amount</td>
                   <td>$currentPayment->type</td>
                <td>$currentPayment->date</td>
                <td>$currentPayment->time</td>
                 <td>$currentPayment->department</td>
                <td>$currentPayment->txRef</td>
            </tr>
            ";
    }

    return $rows;
}
