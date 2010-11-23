<?php

include_once("./global/includes.php");

display_header("Night Crews", "");

if (logged_in()) {
	// form to change profile info
	echo "Night Crew information goes here.";
}

else if (!logged_in()) {
  echo "Can't change anything, 'cause you're not logged in.";
}

display_footer();

?>