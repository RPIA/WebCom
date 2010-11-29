<?php

include_once("./global/includes.php");
include_once("./global/crews.php");

display_header("Night Crews", "");

if (logged_in()) {
	// form to change profile info
	echo "Night Crew information goes here.";
  display_crew_member(3);
}

else if (!logged_in()) {
	not_logged_in_msg();
}

display_footer();

?>