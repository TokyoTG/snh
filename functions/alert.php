<?php

function error()
{
    if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
        echo "<span style='color:red;'>" . $_SESSION['error'] . "</span>";
        session_destroy();
    }
}

function message()
{
    if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
        echo "<span style='color:green;'>" . $_SESSION['message'] . "</span>";
        session_destroy();
    }
}



function print_message()
{
    $types = ['message', 'info', 'error'];
    $colors = ['success', 'info', 'danger'];
    for ($i = 0; $i < count($colors); $i++) {
        if (isset($_SESSION[$types[$i]]) && $_SESSION[$types[$i]] != '') {

            echo "<div class='alert alert-" . $colors[$i] . "'" . " role='alert'>"
                . $_SESSION[$types[$i]] .
                "</div>";
            if (!isset($_SESSION['LoggedIn'])) {
                session_destroy();
            }
        }
    }
}

function set_message($type = "message", $content = "")
{
    switch ($type) {
        case "message":
            $_SESSION['message'] = $content;
            break;
        case "error":
            $_SESSION['error'] = $content;
            break;
        default:
            $_SESSION['message'] = $content;
    }
}

function test_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function storeTime($email)
{
    date_default_timezone_set("Africa/Lagos");
    $dateData = date('d M Y h:i:sA');
    file_put_contents("db/timeData/" . $email . ".json", json_encode(['date' => $dateData]));
}

function fetchDate($email)
{
    $allDates = scandir("db/timeData/");
    $numOfDates = count($allDates);
    for ($counter = 0; $counter < $numOfDates; $counter++) {
        $currentDate = $allDates[$counter];
        if ($currentDate == $email . ".json") {
            $dateData = json_decode(file_get_contents('db/timeData/' . $currentDate));
            return $dateData->date;
        }
    }
}
