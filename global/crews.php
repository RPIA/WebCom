<?php

/*function get_crew_member($date, $position_id) {
  $result = std_query("SELECT * FROM `nightCrews` 
    INNER JOIN `positions` ON `nightCrews'.'positionID`=`crewPositions`.`id`
    INNER JOIN `members` ON `nightCrews`.`memberID`=`users`.`id`
    WHERE `date` = '".quote_smart($date)."' and `positionID` = '".quote_smart($position_id)."'
    ");
  
  $nightCrewInfo = mysql_fetch_assoc($result);
}

function get_crew($date) {
} */

function display_crew_member($user_id) {

  $result = std_query("SELECT * FROM `users` WHERE `users`.`id`='".$user_id."'");
    $userInfo = mysql_fetch_assoc($result);
  echo "&nbsp;&nbsp;<a href = 'mailto:$userInfo['email']' >'$userInfo['firstName'][0]' '$userInfo['lastName']'</a>&nbsp;&nbsp;";  
}

?>