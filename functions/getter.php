<?php

function getAppointments($dept)
{
    $allAppointments = scandir('db/appointments/');
    $num = count($allAppointments);
    // for ($i = 0; $i < $num; $i++) {
    $res = json_decode(file_get_contents('db/appointments/' . $allAppointments[0]));
    print_r($res);
    // }
}
