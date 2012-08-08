<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$notesID = $_POST['notesID'];
$courseID = $_POST['courseID'];

$query = $db_handle->exec("DELETE FROM coursenotes WHERE notesID = '$notesID'");

//GO TO newcourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";


?>
