<?php

// admin.php
// TODO:  make admin panel

include_once('./global/includes.php');

display_header("Administrator Panel", "");

if (check_admin_user()) {
	switch ($_GET['action']) {
		case 'adduser':
			header( 'location: newuser.php');
			break;
		case 'edituser':
			header( 'location: edituser.php');
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
			echo "<a href='admin.php?action=adduser'>Add User</a><br />";
			echo "<a href='admin.php?action=edituser'>Edit User</a><br />";
			echo "<a href='admin.php?action=deluser'>Delete User</a><br />";
			echo "<br />";
			echo "<a href='admin.php?action=addevent'>Add Event</a><br />";
			echo "<a href='admin.php?action=editevent'>Edit Event</a><br />";
			echo "<a href='admin.php?action=delevent'>Delete Event</a><br />";
			echo "<br />";
			echo "<a href='admin.php?action=editcrew'>Edit Night Crew</a><br />";
			echo "<a href='admin.php?action=editdefault'>Edit Default Night Crew</a><br />";
			echo "</p>";
	}
}

else {
	echo wrong_permissions_msg();
}	

display_footer();

?>
