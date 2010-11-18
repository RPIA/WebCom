<?php

// profile.php
// page for users to update their information
// TODO:  fill in content

include_once("./global/includes.php");

display_header("Profile", "");

if (logged_in()) {
	$userInfo = $_SESSION['userInfo'];
	// form to change profile info
	?>
<span><span style="size:18pt;font-weight:bold;"><?php echo $userInfo['firstName'];?> <?php echo $userInfo['lastName'];?></span><br>
<span style="size:14pt;font-weight:bold;"><?php echo $_SESSION['majorInfo']['majorName'];?></span></span>
<span id="address">Current address on file:<br><?php echo $userInfo['addressNumber']." ".$userInfo['addressStreet']."<br>".$userInfo['addressCity'].", ".$userInfo['stateAbbrev']." ".$userInfo['addressZip'];?></span>
<span id="studentInfo">Current student info:<br><?php ;?></span>
	<?php
	echo "You'll be able to change your login info here!";
	echo "<pre>";
	print_r($_SESSION);
}

elseif (!logged_in()) {
	echo "You must be logged in to view this page.";
	exit;
}

display_footer();

?>
