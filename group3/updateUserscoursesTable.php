<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

//THIS PAGE IS FOR ADMINS TO MAKE CHANGES TO THE DATABASE
//ADD WHATEVER QUERIES ARE NEEDED AND CALL PAGE
    
//$query = $db_handle->exec("DELETE FROM usercourses  WHERE userID='admin'");
    
//$query3 = $db_handle->exec("INSERT INTO usercourses (userID,courseID,owner)VALUES ('admin','19','tln3')");
    
    
/*

if(!$query = $db_handle->exec("UPDATE usercourses SET owner = 'admin' WHERE owner = 'admin1'")){
	echo "Fail";
	exit;
    }


//CLOSE DATABASE
$db_handle = null;


echo "Update complete";
*/


?>
