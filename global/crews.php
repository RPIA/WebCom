<?php

function get_crew_member($date, $position_id) {
  $result = std_query("SELECT * FROM `nightCrews` 
    INNER JOIN `positions` ON `nightCrews'.'positionID`=`crewPositions`.`id`
    INNER JOIN `members` ON `nightCrews`.`memberID`=`users`.`id`
    WHERE `date` = '".quote_smart($date)."' and `positionID` = '".quote_smart($position_id)."'
    ");
  
  $nightCrewInfo = mysql_fetch_assoc($result);
}

function get_crew($date) {
  $positions = 
}
?>