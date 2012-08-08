<?php

//THIS INCLUDE FILE RETURNS $userID & $role
include ("../validateUser.php");

$thisUser = $_GET['thisUser'];

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";


//GET COURSE ID#'S FROM USERCOURSES TABLE
$usersCourses[]=array();
$x = 0;    
foreach ($db_handle->query("SELECT courseID from usercourses WHERE owner = '$thisUser' AND userID = '$thisUser'") as $row){
		$usersCourses[$x] = $row['courseID'];
		$x++;
		}
		
 echo count($usersCourses) . " courses owned/created by: " . $thisUser; 
 echo "<table cellpadding='5' border='1'><tr><th>Course #</th><th>Course Name</th><th>Semester</th></tr>";
		
//GET COURSE NAMES
$courseNames[]=array();		
$x=0; //RESET
for($x=0;$x < count($usersCourses);$x++){
	$query = $db_handle->query("SELECT * from courses WHERE courseID ='$usersCourses[$x]'");
	 $result = $query->fetch(PDO::FETCH_ASSOC);
	 echo "<tr><td>" . $usersCourses[$x] . "</td><td>" . $result['coursename'] . "</td><td>" . $result['semester'] ."</td></tr>";
 }

 
		
?>











