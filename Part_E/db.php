<?php

/**
 * Define the DB connection details separately so that 
 * they are not publicly available in github. 
 *
 */
/**
 * Hostname and port mysql is running on (can't use localhost)
 */
define('DB_HOST', 'yallara.cs.rmit.edu.au'); //yallara.cs.rmit.edu.au:54403

define("DB_PORT", "54403");

define('DB_NAME', 'winestore');

define('DB_USER', 's3266174');

define('DB_PW', 'HeRui666');

//define function show databse connection errors
function showerror() {
    die("Error " . mysql_errno() . " : " . mysql_error());
}

?>
