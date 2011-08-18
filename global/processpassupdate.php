<?php

require 'PasswordHash.php';

define("SQL_HOST", "localhost");
define("SQL_USERNAME", "okeefm");
define("SQL_PASSWORD", "lxj9zf3dse");
define("SQL_DATABASE", "rpia");

mysql_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD)
    or die("Unable to connect to MySQL.");
mysql_select_db(SQL_DATABASE)
    or die("Error while connecting to database.");

// Base-2 logarithm of the iteration count used for password stretching
$hash_cost_log2 = 8;
// Do we require the hashes to be portable to older systems (less secure)?
$hash_portable = FALSE;

function quote_smart($value) {
	return mysql_real_escape_string($value);
}

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
	$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
	if ($hasher->CheckPassword($oldpassword, $rows['password'])) {
		$valid_old_password = $oldpassword;
	} else {
		$error_old_password = 'Please enter old password';
	}
	unset($hasher);
	
	if ((strlen($valid_old_password) > 0) &&
	(strlen($valid_password) > 0)) {
		
		$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
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