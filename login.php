<?php

// login.php
// handles login requests
// if you're looking for the login form,
// go to the display_login function in display.php

include_once("./global/includes.php");

// check to see if the user is trying to log in.
if (isset($_POST['username'])) {
    $login_result = login($_POST['username'], $_POST['password']);
    switch($login_result) {
        case "1" :
            // form not filled in completely.
            $status .= "Please fill in all fields completely. ";
            break;
        case "2" :
            // no such user.
            $status .= "The user you have specified does not exist. ";
            break;
        case "3" :
            // wrong password.
            $status .= "The username/password combination you have entered is incorrect. ";
            break;
        case "4" :
            // succeeded
            header("Location: main.php");
            break;
        default :
            break;
    }
}

// check if the user is already logged in
if ($_SESSION['logged_in'] == 1) {
    // redirect to authenticated homepage
    header("Location: main.php");
}

// otherwise, display normal login form
display_header("Login", $status);
display_login_form();
display_footer();

?>
