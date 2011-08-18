<?php

// config.php
// configuration and global variable definitions

// name of your domain.
define("DOMAIN_NAME", "rpiambulance.org");

// path relative to documentroot that you installed this into
define("INSTALL_PATH", "");

// mysql host
define("SQL_HOST", "localhost");

// mysql username
define("SQL_USERNAME", "rpia");

// mysql password
define("SQL_PASSWORD", "BXT7X6RMSmZW6Vsr");

// mysql database
define("SQL_DATABASE", "rpia");

// Base-2 logarithm of the iteration count used for password stretching
define("HASH_COST_LOG2", 8);
// Do we require the hashes to be portable to older systems (less secure)?
define("HASH_PORTABLE", FALSE);

?>
