<?php

if ($newuser) {
	$valid_firstname = '';
	$valid_lastname = '';
	$valid_birthdate = '';
	$valid_email = '';
	$valid_phone = '';
	$valid_address = '';
	$valid_city = '';
	$valid_state = '';
	$valid_zip = '';
	$valid_username = '';
	$valid_password = '';
	$valid_rin = '';

	$apartment = '';
	$major = '';
	$passwordconfirmation = '';

	$error_username = '';
	$error_password = '';
	$error_password_confirmation = '';
} else {
	$user_id = $_SESSION['userLogin']['userID'];
	
	$query = "SELECT * FROM `users`, `states`, `majors` WHERE  users.addressState = states.id AND users.majorID = majors.id AND users.id = ".quote_smart($user_id);
	$result = mysql_query($query);
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	} else {
		$rows = mysql_fetch_assoc($result);
		if (!$rows['id']) {
			die("No user found with that ID");
		}
	}
	
	$valid_firstname = $rows['firstName'];
	$valid_lastname = $rows['lastName'];
	$unformatted_date = strtotime($rows['birthDate']);
	$valid_birthdate = date('m/d/Y', $unformatted_date);
	$valid_email = $rows['email'];
	$valid_phone = $rows['phone'];
	$valid_address = $rows['addressNumber']." ".$rows['addressStreet'];
	$valid_city = $rows['addressCity'];
	$valid_state = $rows['stateAbbrev'];
	$valid_zip = $rows['addressZip'];
	$apartment = $rows['addressApt'];
	$valid_rin = $rows['rin'];
	$major = $rows['name'];
}

	$error_firstname = '';
	$error_lastname = '';
	$error_birthdate = '';
	$error_email = '';
	$error_phone = '';
	$error_address = '';
	$error_city = '';
	$error_state = '';
	$error_zip = '';
	$error_rin ='';



if($_POST)
{
	 
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$birthdate = trim($_POST['birthdate']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$address = trim($_POST['address']);
	$apartment = trim($_POST['apt']);
	$city = trim($_POST['city']);
	$state = trim($_POST['state']);
	$zip = trim($_POST['zip']);
	$rin = trim($_POST['rin']);
	$major = trim($_POST['major']);
	
	if ($newuser) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$passwordconfirmation = trim($_POST['passwordconfirmation']);
	}
	
	//Birthdate
	if (preg_match("/\d{1,2}.\d{1,2}.\d{4}/", $birthdate)) {
		$valid_birthdate=$birthdate;
		if (($birthtime = strtotime($valid_birthdate)) === false) {
			$error_birthdate = 'Enter valid birthdate in MM/DD/YYYY format';
			$valid_birthdate = '';
		}
		$formatted_birthdate = date("Y-m-d", $birthtime);
	} else {
		$error_birthdate='Enter valid birthdate in MM/DD/YYYY format.';
	}
	
	//Address
	if (strlen($address) > 2) {
		$valid_address = $address;
	} else {
		$error_address = 'Enter valid address.';
	}
	
	//City
	if (strlen($city) > 2) {
		$valid_city = $city;
	} else {
		$error_city = 'Enter valid city';
	}
	
	//State
	if (strlen($state) == 2) {
		$valid_state = $state;
	} else {
		$error_state = 'Enter a valid state';
	}
	
	//Zip
	if (preg_match('/^\d{5}$/', $zip)) {
		$valid_zip = $zip;
	} else {
		$error_zip = 'Enter a valid zip';
	}
	
	//Phone
	if (preg_match('/(\d)?(\s|-)?(\()?(\d){3}(\))?(\s|-){1}(\d){3}(\s|-){1}(\d){4}/',$phone)) {
		$valid_phone = $phone;
	} else {
		if (preg_match('/^\d{10}$/', $phone)) {
			$valid_phone = $phone;
		} else {
			$error_phone = 'Enter a valid phone number.';
		}
	}
	
	//First name
	if (preg_match('/[A-Za-z0-9 ]{3,20}/',$firstname))
	{
		$valid_firstname=$firstname;
	}
	else
	{ 
		$error_firstname='Enter valid First Name.'; 
	}
	
	//Last name
	if (preg_match('/^[\w \\\']{3,20}$/', quote_smart($lastname)))
	{
		$valid_lastname=$lastname;
	}
	else
	{ 
		$error_lastname='Enter valid Last Name.'; 
	}
	
	if ($newuser) {
		// Usename min 3 char max 20 char
		if (preg_match('/^[A-Za-z0-9_]{3,20}$/',$username))
		{
			$valid_username=$username;
			$query = "SELECT * FROM `userlogin` WHERE `username` = '".quote_smart($valid_username)."'";
			$result = mysql_query($query);
			$rows = mysql_fetch_row($result);
			if ($rows != NULL) {
				$error_username='This username has been taken.';
				$valid_username='';
			}
		}
		else
		{ 
			$error_username='Enter valid Username, at least 3 characters.'; 
		}
		
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
	}
	
	// Email
	if (preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$/', $email))
	{
	$valid_email=$email; 
	}
	else
	{ 
	$error_email='Enter valid Email.'; 
	}	
	
	//RIN
	if (strlen($rin) > 0) {
		if (preg_match('/^\d{9}$/', $rin)) {
			$valid_rin = $rin;
		}else {
			$error_rin = 'Enter valid RIN';
		}
	} 
	
	if((strlen($valid_birthdate) > 0) && (strlen($valid_address) > 0) && (strlen($valid_city) > 0) &&
		(strlen($valid_state) > 0) && (strlen($valid_zip) > 0) && (strlen($valid_phone) > 0) &&
		(strlen($valid_firstname) > 0) &&(strlen($valid_lastname) > 0) && (strlen($valid_email) > 0)) {
	
		//Apartment
		if(strlen($apartment) == 0) {
			$apartment = 'NULL';
		}
		
		$address_parts = explode(" ", $valid_address);
		$address_num = $address_parts[0];
		$address_rest = implode(" ", array_slice($address_parts, 1, count($address_parts) -1));
		
		$query = "SELECT `id` FROM `states` WHERE `stateAbbrev` = '".quote_smart($valid_state)."'";
		$result = mysql_query($query);
		$state_num = mysql_fetch_row($result);
		$state_num = $state_num[0];
		
		$phone_stripped = preg_replace(array("/ /", "/\(/", "/\)/", "/-/", "/\./"), "", $valid_phone);
		if (strlen($phone_stripped) > 10) {
			$phone_stripped = substr($phone_stripped, 1, 10);
		}
		
		$query = "SELECT `id` FROM `majors` WHERE `name` = '".quote_smart($major)."'";
		$result = mysql_query($query);
		$major_id = mysql_fetch_row($result);
		if (!$major_id) {
			$query = "INSERT INTO `majors` VALUES (NULL, NULL, '".quote_smart($major)."')";
			$result = mysql_query($query);
			$query = "SELECT `id` FROM `majors` WHERE `name` = '".quote_smart($major)."'";
			$result = mysql_query($query);
			$major_id = mysql_fetch_row($result);
		}
		$major_id = $major_id[0];
		
		if ($newuser && (strlen($valid_username) > 0) &&
		(strlen($valid_password) > 0)) {
			$query = "INSERT INTO `users` VALUES (NULL, '".quote_smart($valid_firstname).
			"', '".quote_smart($valid_lastname)."', ".quote_smart($address_num).", '".quote_smart($address_rest).
			"', '".quote_smart($apartment)."', '".quote_smart($valid_city)."', ".$state_num.", ".quote_smart($valid_zip).
			", ".quote_smart($phone_stripped).", NULL, ".$major_id.", ".quote_smart($valid_rin).", '".date("Y-m-d")."', '".quote_smart($formatted_birthdate)."', '".quote_smart($valid_email)."')";
			$result = mysql_query($query);
			if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
			}
			
			$query = "SELECT MAX(id) FROM `users` WHERE `email` ='".quote_smart($valid_email)."'";
			$result = mysql_query($query);
			if (!$result) {
				die("Unable to find user ID");
			} else {
				$result = mysql_fetch_row($result);
				$id = $result[0];
			}
			
			$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
			$hash = $hasher->HashPassword($valid_password);
			if (strlen($hash) < 20) {
				unset($hasher);
				die('Failed to hash new password');
			}
			unset($hasher);
			
			$query = "INSERT INTO `userLogin` VALUES (".quote_smart($id).
			", '".quote_smart($valid_username)."', '".$hash."')";
			$result = mysql_query($query);
			if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
			} else {
				header( 'Location: index.html');
			}
		} else {
				$query = "UPDATE `users` SET firstName='".quote_smart($valid_firstname).
			"', lastName='".quote_smart($valid_lastname)."', addressNumber=".quote_smart($address_num).", addressStreet='".quote_smart($address_rest).
			"', addressApt='".quote_smart($apartment)."', addressCity='".quote_smart($valid_city)."', addressState=".$state_num.", addressZip=".quote_smart($valid_zip).
			", phone=".quote_smart($phone_stripped).", majorID=".$major_id.", rin=".quote_smart($valid_rin).
			", birthdate='".quote_smart($formatted_birthdate)."', email='".quote_smart($valid_email)."' WHERE `id` = ".quote_smart($user_id);
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

}
	
?>