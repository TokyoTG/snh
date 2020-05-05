<?php

function is_user_loggedIn()
{
    if (isset($_SESSION['LoggedIn'])) {
        return true;
    }
    return false;
}

function is_token_set()
{
    return is_token_set_in_get() || is_token_set_in_session();
}

function is_token_set_in_get()
{
    if (isset($_GET['token'])) {
        return true;
    }
    return false;
}
function is_token_set_in_session()
{
    if (isset($_SESSION['token'])) {
        return true;
    }
    return false;
}

function is_admin()
{
    if (!isset($_SESSION['LoggedIn']) || $_SESSION['role'] !== "Super Admin") {
        $_SESSION['error'] = "You have not login";
        header("location:login.php");
    }
}

function is_medicalTeam()
{
    if (!isset($_SESSION['LoggedIn']) || $_SESSION['role'] !== "Medical Team(MT)") {
        set_message('error', "You have not login");
        header("location:login.php");
    }
}

function is_patient()
{
    if (!isset($_SESSION['LoggedIn']) || $_SESSION['role'] !== "Patient") {

        set_message('error', "You have not login");
        header("location:login.php");
    }
}

function find_user($email = "")
{
    if (!$email) {
        set_message("error", 'Email not set');
        die();
    }
    $allusers = scandir('db/users/');
    $numOfUsers = count($allusers);
    for ($counter = 0; $counter < $numOfUsers; $counter++) {
        $currentUser = $allusers[$counter];
        if ($currentUser == $email . ".json") {
            $userObject = json_decode(file_get_contents('db/users/' . $currentUser));
            return $userObject;
        }
    }
    return false;
}


function find_token($email)
{
    if (isset($_SESSION['LoggedIn'])) {
        return true;
    }
    $alltokens = scandir('db/tokens/');
    $numOfTokens = count($alltokens) - 1;

    for ($counter = 0; $counter < $numOfTokens; $counter++) {
        $currentToken = $alltokens[$counter];
        if ($currentToken == $email . ".json") {
            return $currentToken;
        }
    }
}
function save_userObject($obj, $email)
{
    file_put_contents("db/users/" . $email . ".json", json_encode($obj));
}
