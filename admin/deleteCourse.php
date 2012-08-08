<?php
//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');


$courseID = $_POST['courseID'];
$group = $_POST['group'];

// The file to be used as the database:
$databasefile = "../group" . $group . "/data/coursescheduler";


if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
   echo "Did not connect";
	exit;
    }


//COURSES TABLE
$delete = $db_handle->exec("DELETE FROM courses where courseID = '$courseID'");
if(!$delete){echo "no good";}


//USERS TABLE
$delete = $db_handle->exec("DELETE FROM usercourses WHERE courseID ='$courseID'");

//LESSONS TABLE
$delete = $db_handle->exec("DELETE FROM lessons WHERE courseID='$courseID'");

//ASSIGNMENTS
$delete = $db_handle->exec("DELETE FROM assignments WHERE courseID='$courseID'");

//NOTES
$delete = $db_handle->exec("DELETE FROM coursenotes WHERE courseID='$courseID'");



//MESSAGE AND RETURN TO ADMIN PAGE

header("Refresh: 3; URL=admin.php");
echo"<div align='center'><h3>All data for this course has been deleted.</h3><div>";
exit();



?>