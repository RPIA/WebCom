<?php

// includes.php

//include global libraries.
include_once('config.php');
include_once('database.php');
include_once('user.php');
include_once('display.php');

// start a session and make MySQL connection
session_start();
connectSQL();

?>
