<?php

// The file to be used as the database:
$databasefile = "data/coursescheduler";

if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
	exit;
    }

?>
