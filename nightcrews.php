<?php

include_once("./global/includes.php");

display_header("Night Crews", "");

if (logged_in()) {
	// form to change profile info
	echo "Night Crew information goes here.";
}

else if (!logged_in()) {
	not_logged_in_msg();
}

display_footer();

?>