<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

//CALLED BY options.php
$newUserID = $_POST['newUserID'];
$courseID = $_POST['courseID'];
$return = "editCourse.php?courseID=" . $courseID;

//GET OWNER ID
$query = $db_handle->query("SELECT owner FROM usercourses WHERE courseID = '$courseID'");
$result = $query->fetch(PDO::FETCH_ASSOC);
$owner = $result['owner'];

$query= null;

//CHECK TO SEE IF USER ALREADY HAS ACCESS TO COURSE
foreach ($db_handle->query("SELECT userID FROM usercourses WHERE courseID = '$courseID'") as $row){
	if($newUserID == $row['userID']){
	header("Refresh: 3; URL=$return");
echo"<div align='center'><h3>This User already has access to this course.</h3><div>";
exit();}
}
$query= null;

$query = $db_handle->exec("INSERT INTO usercourses (userID,courseID,owner)VALUES ('$newUserID','$courseID','$owner')");


//GO TO editCourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";


?>
