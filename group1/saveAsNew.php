<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

//GET FORM VARIABLES FROM EDIT PAGE
$courseID = $_POST['courseID'];
$coursename = $_POST['coursename'];
$groups = $_POST['groups'];


$query = $db_handle->query("SELECT * from courses WHERE courseID=$courseID");
   $result = $query->fetch(PDO::FETCH_ASSOC);

$startdate=$result['startdate'];
$semester=$result['semester'];
$courselength=$result['courselength'];
$col1name=$result['col1name'];
$col2name=$result['col2name'];
$col3name=$result['col3name'];
$colorscheme=$result['colorscheme'];

$query=null;

if(!$query = $db_handle->exec("INSERT INTO courses (coursename,startdate,semester,courselength,col1name,col2name,col3name,colorscheme)VALUES ('$coursename','$startdate','$semester','$courselength','$col1name','$col2name','$col3name','$colorscheme')")){echo "FAILED";}

//THIS WILL BE THE COURSE ID NUMBER
$lastentry = $db_handle->lastInsertId();


//CLEAR QUERY
$query=null;

//GET LESSONS - PUT IN NEW COURSE($lastentry)
$query = $db_handle->query("SELECT * from lessons WHERE courseID=$courseID");
$rowarray = $query->fetchall(PDO::FETCH_ASSOC);
$query->closeCursor();//NEEDED TO FREE RESOURCE OTHERWISE TABLE LOCKED ERROR

foreach ($rowarray as $row) {
	$weeknum=$row['weeknum'];
	$lessontitle=$row['lessontitle'];
	$lessoncomment=$row['lessoncomment'];

	$query2 = $db_handle->exec("INSERT INTO lessons (courseID,weeknum,lessontitle, lessoncomment)VALUES ('$lastentry','$weeknum','$lessontitle','$lessoncomment')");
}


//CLEAR QUERY
$query=null;

//GET ASSIGNMENTS - PUT IN NEW COURSE($lastentry)
$query = $db_handle->query("SELECT * from assignments WHERE courseID=$courseID");
$rowarray = $query->fetchall(PDO::FETCH_ASSOC);
$query->closeCursor();

foreach ($rowarray as $row) {
	$weeknum=$row['weeknum'];
	$duedayfactor=$row['duedayfactor'];
	$descrip=$row['descrip'];
	$displaydate=$row['displaydate'];

	$query2 = $db_handle->exec("INSERT INTO assignments (courseID,weeknum,duedayfactor,descrip,displaydate)VALUES ('$lastentry','$weeknum','$duedayfactor','$descrip','$displaydate')");
}


//CLEAR QUERY
$query=null;

//LIST COURSE IN USERS COURSES TABLE
$query = $db_handle->exec("INSERT INTO usercourses (userID,courseID,owner)VALUES('$userID','$lastentry','$userID')");

//CLEAR QUERY
$query=null;


//GO TO editCourse.php
$goto = "editCourse.php?courseID=" . $lastentry;
echo "<script> window.location.href = '$goto' </script>";


?>
