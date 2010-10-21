<?php

// user_functions.php
// user authentication and data functions

function logged_in() {
    //checks to see if user is logged in
    if ($_SESSION['logged_in'] == 1) {
        //reload their session data to keep it up-to-date
        reload_user();
        return true;
    }
    else
        return false;
}

// tries to login a user
function login($username, $password) {
    if ($username == '' || $password == '') {
		// blank field
        return 1;
    }

    // try to get the username this person is trying to login as
    $try_user = std_query("SELECT * FROM `userLogin`
                            WHERE `username` = '".quote_smart($username)."'
                            LIMIT 1");

    // check number of results
    if (mysql_num_rows($try_user) != 1) {
        // no such user, return error code 2
        return 2;
    }
	
    else {
        $try_user = mysql_fetch_assoc($try_user);
    }

    // check password
    if (md5($password) != $try_user['password']) {
        // incorrect password, return error code 3
        return 3;
    }

    // get user info
    $result = std_query("SELECT * FROM `users` INNER JOIN `states` ON `states`.`id`=`users`.`addressState` WHERE `users`.`id`='".$try_user['userID']."'");
    $userInfo = mysql_fetch_assoc($result);
    $result = std_query("SELECT `desc` FROM `memberStatuses` INNER JOIN `memberStatusAssociations` ON `memberStatuses`.`id`=`memberStatusAssociations`.`memberStatus` INNER JOIN `users` ON `users`.`id`=`memberStatusAssociations`.`member_id` WHERE `users`.`id`='".$userInfo['majorID']."'");
	while ($row = mysql_fetch_assoc($result))
		$memberStatusInfo[] = $row['desc'];
    // get major info
    $result = std_query("SELECT *,`majors`.`id` AS `majorID`, `majors`.`name` AS `majorName`, `majorSchools`.`name` AS `schoolName` FROM `majors` INNER JOIN `majorSchools` ON `majorSchools`.`id`=`majors`.`schoolID` WHERE `majors`.`id`='".$userInfo['majorID']."'");
    $majorInfo = mysql_fetch_assoc($result);
    // this person checks out, log them in
    $_SESSION['userLogin'] = $try_user;
    $_SESSION['userInfo'] = $userInfo;
    $_SESSION['memberStatus'] = $memberStatusInfo;
    $_SESSION['majorInfo'] = $majorInfo;
    $_SESSION['logged_in'] = 1;

	// code for good login
    return 4;
}

// check if user is an administrator
// needs to be updated to work with proper db field
// right now, everyone is an admin! yay!
function check_admin_user() {/*
    if ($_SESSION['userlevel'] == 2) {
        return true;
    }
	
    else {
        return false;
    }*/
	return true;
}

// check if user is an officer
function check_officer_user() {
    if ($_SESSION['userlevel'] == 1) {
        return true;
    }
    else {
        return false;
   }
}

// convert userlevels to text
// needs reworking or deletion to conform with database
function userlevel_to_text($userlevel) {
    switch ($userlevel) {
        case 0 :
            $text = "User";
            break;
        case 1 :
            $text = "Officer";
            break;
        case 2 :
            $text = "Administrator";
            break;
    }
    return $text;
}

// reloads a user's information in the database into their session variable
// needs to be removed or reconciled with database
function reload_user() {/*
    $this_user = std_query("SELECT * FROM `users`
                            WHERE `userid` = '".quote_smart($_SESSION['userid'])."'
                            LIMIT 1");
    if (!$this_user) {
        return false;
    }

    $_SESSION = mysql_fetch_assoc($this_user);*/
    $_SESSION['logged_in'] = 1;
    return true;
}

function logout() {
    $_SESSION['logged_in'] = 0;
    session_destroy();
}

?>
