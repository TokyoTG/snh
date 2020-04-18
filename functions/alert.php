<?php


function print_message()
{
    $types = ['message', 'info', 'error'];
    $colors = ['success', 'info', 'danger'];
    for ($i = 0; $i < count($colors); $i++) {
        if (isset($_SESSION[$types[$i]]) && $_SESSION[$types[$i]] != '') {

            echo "<div class='alert alert-" . $colors[$i] . "'" . " role='alert' id='alert'>"
                . $_SESSION[$types[$i]] .
                "</div>";
            if (!isset($_SESSION['LoggedIn'])) {
                session_destroy();
            } else {
                unset($_SESSION[$types[$i]]);
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

function generateToken()
{
    $token = "";
    $alphabets = ['a', 'b', 'A', 'B', 'c', 'C', 'd', 'D', 'e', 'E', 'f', 'F', 'g', 'G', 'i', 'I', 'j', 'm', "M", 'y', 'z', 'w', 'Z'];

    for ($i = 0; $i < 20; $i++) {
        $index = mt_rand(0, count($alphabets) - 1);
        $token .= $alphabets[$index];
    }
    return $token;
}
