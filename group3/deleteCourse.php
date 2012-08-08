<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$courseID  = $_POST['courseID'];

//COURSES TABLE
$delete = $db_handle->exec("DELETE FROM courses where courseID = '$courseID'");
if(!$delete){echo "did not delete";}


//USERS TABLE
$delete = $db_handle->exec("DELETE FROM usercourses WHERE courseID ='$courseID'");

//LESSOSN TABLE
$delete = $db_handle->exec("DELETE FROM lessons WHERE courseID='$courseID'");

//ASSIGNMENTS
$delete = $db_handle->exec("DELETE FROM assignments WHERE courseID='$courseID'");

//NOTES
$delete = $db_handle->exec("DELETE FROM coursenotes WHERE courseID='$courseID'");



//GO TO options.php
$goto = "options.php";
echo "<script> window.location.href = '$goto' </script>";



?>