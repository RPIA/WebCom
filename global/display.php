<?php

// display_functions.php
// output functions
// TODO:  come up with a better style

function display_header($title=FALSE, $status="") {
    if (isset($_REQUEST['status'])) {
        $status .= $_REQUEST['status'];
    }
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
	  <link rel = "stylesheet" type = "text/css" href = "styles.css" />
	  <link rel = "shortcut icon" href = "favicon.ico" />
	  <title>';
		if ($title)
			echo 'RPI Ambulance - '.$title.'</title>';
		else
			echo 'RPI Ambulance</title>';
		echo '
	</head>

	<body>
		<div id = "page_container">
			<div id = "status">'.$status.'</div>';
}

function display_login_form() {
    echo "
        <div id='login'><h1>Please log in.</h1>
            <form action='login.php' method='post'>
                <p>
                    <label>Username:<br />
                    <input name = 'username' size='20'  /></label>
                </p>
                <p>
                <label>Password:<br />
                    <input type = 'password' name = 'password' size='20' /></label>
                </p>
                <p>
                <input type = 'submit' value = 'Log In' />
                </p>
            </form>
        </div>";
}

function display_menu() {
    // displays the overhead menu
    // put stuff here i guess when we have some sort of a menu
	// right now i just have dummy/generic things like About, Officers, and Contact
	// check is person is logged in and will display a couple different menu items like Admin if admin
	// or Profile so they can update their address/major/email/phone/password, etc
	
    echo "
        <div id = 'top_menu'>
            <a href = about.php'>About</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <a href = 'officers.php'>Officers</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href = 'contact.php'>Contact</a>&nbsp;&nbsp;&nbsp;";
			
    if (check_admin_user()) {
        echo "<a href = 'admin.php'>Admin</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
    }
	
	if (logged_in()) {
	echo "<a href = 'profile.php'>Profile</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href = 'logout.php'>Log Out</a>
	</div>";
	}
}

function display_footer() {
    echo '
    </div>
</body>
</html>';
}

?>
