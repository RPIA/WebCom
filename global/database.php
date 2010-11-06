<?php

// database_functions.php
// database function library

function connectSQL() {
    mysql_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD)
        or die("Unable to connect to MySQL.");
    mysql_select_db(SQL_DATABASE)
     or die("Error while connecting to database.");
}

// wrapper function for sanitizing inputs
function quote_smart($value) {
	return mysql_real_escape_string($value);
}

// executes a query with standardized error message
// return value is a PHP MySQL result resource
function std_query($query) {
   $result = mysql_query($query)
      or die("Could not query MySQL database in ".$_SERVER['PHP_SELF'].".<br />
             ".mysql_error()."<br />
             Query: ".$query."<br />
            Time: ".time());
   return $result;
}

?>
