<html>
<head>
<title>Create User Table</title>
</head>
<body>

<?php

//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');


echo"This file is run on set up of this software to set up initial tables in the database. Running this deletes all information in any existing users table. As a precaution comment tags have been inserted to prevent accidental deletion. If you are certain you want to run this file you must open the file in a text editor and delete the comment tags and save the file before running it from your browser.";


/*
// The file to be used as the database:
$databasefile = "../data/users";


if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
	exit;
    }

//CREATE USERS TABLE
$deleteTable = $db_handle->exec ("DROP TABLE users");


$makeTable =$db_handle->exec ( "CREATE TABLE users (userID  primary key, groups varchar,email varchar, firstname varchar, lastname varchar, role varchar, lastlogin int)");

echo"<h3>A new table has been created.</h3>";


echo "<br>";
*/


?>

</body>
</html>