<?php

$oldpassword = '';
$valid_password = '';
$passwordconfirmation = '';

$error_old_password = '';
$error_password = '';
$error_password_confirmation = '';

//$user_id = $_SESSION['userid'];
$user_id = 4;
	
$query = "SELECT * FROM `userlogin` WHERE userID = ".quote_smart($user_id);
$result = mysql_query($query);
if (!$result) {
	$message  = 'Invalid query: ' . mysql_error() . "\n";
	$message .= 'Whole query: ' . $query;
	die($message);
} else {
	$rows = mysql_fetch_assoc($result);
	if (!$rows['userID']) {
		die("No user found with that ID");
	}
	$valid_username = $rows['username'];
}

if($_POST)
{
	$oldpassword = trim($_POST['oldpassword']);
	$password = trim($_POST['password']);
	$passwordconfirmation = trim($_POST['passwordconfirmation']);
	
	//Password
	if (strlen($password) > 5) {
		if ($password == $passwordconfirmation) {
			$valid_password = $password;
		} else {
			$error_password_confirmation = 'Password and confirmation must match.';
		}
	} else {
		$error_password = 'Password must be at least 6 characters';
	}
	
	//Old password
	$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
	if ($hasher->CheckPassword($oldpassword, $rows['password'])) {
		$valid_old_password = $oldpassword;
	} else {
		$error_old_password = 'Please enter old password';
	}
	unset($hasher);
	
	if ((strlen($valid_old_password) > 0) &&
	(strlen($valid_password) > 0)) {
		
		$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
		$hash = $hasher->HashPassword($valid_password);
		if (strlen($hash) < 20) {
			unset($hasher);
			die('Failed to hash new password');
		}
		unset($hasher);
		
		$query = "UPDATE `userlogin` SET password='".$hash.
		"' WHERE userID = ".quote_smart($user_id);
		$result = mysql_query($query);
		if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
		} else {
			header( 'Location: index.html');
		}
	} 
}
	
?>