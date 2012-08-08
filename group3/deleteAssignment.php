<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

$assignID = $_POST['assignID'];
$courseID = $_POST['courseID'];



//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";


$query = $db_handle->exec("DELETE FROM assignments WHERE assignID = '$assignID'");



//GO TO editCourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";


?>
