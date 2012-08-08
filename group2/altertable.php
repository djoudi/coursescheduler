<?php

// The file to be used as the database:
$databasefile = "data/coursescheduler";


if(! $db_handle = sqlite_open($databasefile, 0666, $sqlite_error) ){
   echo $sqlite_error;
	exit;
    }

sqlite_query($db_handle, "DROP TABLE assignment_temp");

sqlite_query($db_handle, "CREATE TEMPORARY TABLE assignment_temp AS SELECT * FROM assignments");

sqlite_query($db_handle, ".schema assignment_temp CREATE TEMP TABLE assignment_temp(courseID,weeknum,duedayfactor, descrip)");


ECHO "TEMP TABLE CREATED";

sqlite_query($db_handle, "DROP TABLE assignments");


sqlite_query($db_handle, "CREATE TABLE assignments (assignID integer primary key,courseID integer, weeknum integer, duedayfactor integer, descrip text, displaydate varchar)");


sqlite_query($db_handle, "INSERT INTO assignments (assignID, courseID , weeknum, duedayfactor, descrip) SELECT assignID, courseID , weeknum, duedayfactor, descrip FROM assignment_temp");

echo "Table Altered";


sqlite_query($db_handle, "UPDATE assignments SET displaydate='Due' WHERE courseID = 1");

?>

