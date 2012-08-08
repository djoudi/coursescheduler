<?php
//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

//CALLED BY options.php
$userID = $_POST['userID'];
$coursename = htmlentities($_POST['coursename'], ENT_QUOTES);
$courselength = $_POST['courselength'];
$semester = $_POST['semester'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$col1name = $_POST['col1name'];
$col2name = $_POST['col2name'];
$col3name = $_POST['col3name'];
$colorscheme = $_POST['colorscheme'];


$basedate = mktime(12,0,0,$month,$day,$year);

$query = $db_handle->exec("INSERT INTO courses (coursename,startdate,semester,courselength,col1name,col2name,col3name,colorscheme)VALUES ('$coursename','$basedate','$semester','$courselength','$col1name','$col2name','$col3name','$colorscheme')");

$courseID = $db_handle->lastInsertId();

$query=null;

//LIST COURSE IN USERS COURSES TABLE
$query = $db_handle->exec("INSERT INTO usercourses (userID,courseID,owner)VALUES('$userID','$courseID','$userID')");


//CLEAR QUERY
$query=null;


//GO TO newcourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";


?>
