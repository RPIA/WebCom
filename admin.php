<?php

// admin.php
// TODO:  make admin panel

include_once('./global/includes.php');

display_header("Administrator Panel", "");

if (check_admin_user()) {
	echo "Welcome, administrator.";
}

else {
	echo "You do not have sufficient privileges to view this page.";
}	

display_footer();

?>
