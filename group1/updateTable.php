<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";


$query = $db_handle->exec("DELETE FROM usercourses WHERE userID = 'admin'");

//GO TO newcourse.php
$goto = "editCourse.php?courseID=" . $courseID;
//echo "<script> window.location.href = '$goto' </script>";


?>
