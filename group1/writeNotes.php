<?php
//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$courseID = $_POST['courseID'];
$notes = htmlentities($_POST['notes'], ENT_QUOTES);
$notes = nl2br($notes);

$query = $db_handle->exec("INSERT INTO coursenotes (courseID,notes)VALUES ('$courseID','$notes')");


//GO TO newcourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";


?>
