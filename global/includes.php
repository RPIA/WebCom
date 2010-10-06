<?php

// includes.php
// yes, this is an include that will include all our desired includes
// it will also start a session and initiate the MySQL connection
// intended to be the first thing called at the beginning of each file

include_once('config.php');
include_once('database.php');
include_once('user.php');
include_once('display.php');

session_start();
connectSQL();

?>
