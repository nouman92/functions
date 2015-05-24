<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'nouman');    // DB username
define('DB_PASSWORD', 'nouman92');    // DB password
define('DB_DATABASE', 'fb_users');      // DB name
try {
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) ;//or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) ;//or die( "Unable to select database");
}
catch(Exception $e)
    {
    echo "DB Connection failed: " ;
    }
 ?>