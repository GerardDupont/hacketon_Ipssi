<?php 

// This is the ip of the database
$DBHOST = "127.0.0.1";

// This is the name of the base
$DBNAME = "hacketonipssi";

// This is the charset that is used by the PDO connection
$DBCHARSET = "utf8";

// This is the login to connect to the database
$DBLOGIN = "root";

// This is the password to connect to the database
$DBPASSWD = "";

// This is the files that is needed for the application to work
$_requiredFiles = array("record","database","people","function");


// This is some initialisation set for php
// Give 1 to the ini_set parameters will display the php errors. 
ini_set('display_errors', 1);
error_reporting(E_ALL & (~E_WARNING) & (~E_NOTICE) & (~E_STRICT) & (~E_DEPRECATED));
ini_set('date.timezone','Europe/Paris');

