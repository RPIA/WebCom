<?php

// profile.php
// page for users to update their information
// TODO:  fill in content

include_once("./global/includes.php");

display_header("Profile", "");

if (logged_in()) {
	// form to change profile info
}

else if (!logged_in()) {
	header("Location: login.php?status=Please log in.");
	exit;
}

display_footer();

?>
