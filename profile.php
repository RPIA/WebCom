<?php

// profile.php
// page for users to update their information
// TODO:  fill in content

include_once("./global/includes.php");

display_header("Profile", "");

if (logged_in()) {
	// form to change profile info
	echo "You'll be able to change your login info here!";
	echo "<pre>";
	print_r($_SESSION);
}

else if (!logged_in()) {
	header("Location: login.php?status=Please log in.");
	exit;
}

display_footer();

?>
