<?php

// admin.php
// TODO:  make admin panel

include_once('./global/includes.php');

display_header("Administrator Panel", "");

if (check_admin_user()) {
	switch ($_GET['status']) {
		case 'adduser':
			break;
		case 'edituser':
			break;
		case 'deluser':
			break;
		case 'addevent':
			break;
		case 'editevent':
			break;
		case 'delevent':
			break;
		case 'editcrew':
			break;
		case 'editdefault':
			break;
			
		default:
			echo "<p align='center'>";
			echo "<a href='admin.php?status=adduser'>Add User</a><br />";
			echo "<a href='admin.php?status=edituser'>Edit User</a><br />";
			echo "<a href='admin.php?status=deluser'>Delete User</a><br />";
			echo "<br />";
			echo "<a href='admin.php?status=addevent'>Add Event</a><br />";
			echo "<a href='admin.php?status=editevent'>Edit Event</a><br />";
			echo "<a href='admin.php?status=delevent'>Delete Event</a><br />";
			echo "<br />";
			echo "<a href='admin.php?status=editcrew'>Edit Night Crew</a><br />";
			echo "<a href='admin.php?status=editdefault'>Edit Default Night Crew</a><br />";
			echo "</p>";
	}
}

else {
	echo "You do not have sufficient privileges to view this page.";
}	

display_footer();

?>
