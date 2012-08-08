<?php
//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$notesID = $_POST['notesID'];
$courseID = $_POST['courseID'];
$notes = $_POST['notes'];
$notes = htmlentities($notes, ENT_QUOTES);
$notes = nl2br($notes);

$updateTable = $db_handle->exec("UPDATE coursenotes SET notes='$notes' WHERE notesID = '$notesID'");



//GO TO editCourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";


?>
