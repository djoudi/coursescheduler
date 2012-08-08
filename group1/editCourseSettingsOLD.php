<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$courseID = $_POST['courseID'];
$coursename = $_POST['coursename'];
$courselength = $_POST['courselength'];
$semester = $_POST['semester'];
$month = abs($_POST['month']);
$day = abs($_POST['day']);
$year = abs($_POST['year']);
$col1name = $_POST['col1name'];
$col2name = $_POST['col2name'];
$col3name = $_POST['col3name'];
$colorscheme = $_POST['colorscheme'];

$fallbreakweek = 14;

//CONVERT DATE TO UNIX TIMESTAMP
$basedate = mktime(12,0,0,$month,$day,$year);
//echo "basedate = " . $basedate . "<br>";
//echo $coursename;


//GET CURRENT SETTINGS
$query = $db_handle->query("SELECT * from courses WHERE courseID=$courseID");
    $result = $query->fetch(PDO::FETCH_ASSOC);
$semesterCurrent = $result['semester'];
$startdate = $result['startdate'];


//MUST END QUERY BEFORE UPDATE QUERY WILL WORK
$query=null;


//CHECK FOR CHANGE IN SEMESTER

//CONVERT FALL TO SPRING
if(($semesterCurrent =="Fall") && ($semester == "Spring")){

//SELECT ALL LESSONS FROM SPECIFIED COURSE AND WEEKS 9-13
for($week= $fallbreakweek - 1;$week > 8;$week--){

		$queryLessons = $db_handle->query("SELECT weeknum, lessonID from lessons WHERE courseID='$courseID' AND weeknum='$week'");
		$result = $queryLessons->fetchALL(PDO::FETCH_ASSOC);

		foreach($result as $row){
		$newweeknum=$row['weeknum'] + 1;
		$updateTable =$db_handle->exec ("UPDATE lessons SET weeknum='$newweeknum' WHERE lessonID = '$row[lessonID]'");
		if(!$updateTable){echo "no update" ."<br>";}
		}
	}

//SELECT ALL ASSIGNMENTS FROM SPECIFIED COURSE AND WEEKS 9-13
for($week= $fallbreakweek - 1;$week > 8;$week--){
	$queryAssignments = $db_handle->query("SELECT assignID, weeknum, duedayfactor from assignments WHERE courseID='$courseID' AND weeknum='$week'");
	$result = $queryAssignments->fetchALL(PDO::FETCH_ASSOC);	
	
	foreach($result as $row){
		$newweeknum=$row['weeknum'] + 1;
		$newdueday = $row['duedayfactor'] + 604800;
		$updateTable =$db_handle->exec ("UPDATE assignments SET weeknum='$newweeknum',duedayfactor='$newdueday' WHERE assignID = '$row[assignID]'");
		}
	}
}

//CONVERT SPRING TO FALL
if(($semesterCurrent =="Spring") && ($semester == "Fall")){

//SELECT ALL LESSONS FROM SPECIFIED COURSE AND WEEKS 10-14
for($week=10;$week < $fallbreakweek + 1;$week++){
		$queryLessons = $db_handle->query("SELECT weeknum, lessonID from lessons WHERE courseID='$courseID' AND weeknum='$week'");
		$result = $queryLessons->fetchALL(PDO::FETCH_ASSOC);
		
		foreach ($result as $row){
		$newweeknum=$row['weeknum'] - 1;
		$updateTable =$db_handle->exec("UPDATE lessons SET weeknum='$newweeknum' WHERE lessonID = '$row[lessonID]'");
		}
	}


//SELECT ALL ASSIGNMENTS FROM SPECIFIED COURSE AND WEEKS 10-14
for($week=10;$week < $fallbreakweek + 1;$week++){

		$queryAssignments = $db_handle->query("SELECT assignID, weeknum, duedayfactor from assignments WHERE courseID='$courseID' AND weeknum='$week'");
		$result = $queryAssignments->fetchALL(PDO::FETCH_ASSOC);	
	
		foreach($result as $row){
		$newweeknum=$row['weeknum'] - 1;
		$newdueday = $row['duedayfactor'] - 604800;
		$updateTable =$db_handle->exec("UPDATE assignments SET weeknum='$newweeknum',duedayfactor='$newdueday' WHERE assignID = '$row[assignID]'");
		}
	}
}





//UPDATE COURSES TABLE WITH NEW FORM INFO
$count = $db_handle->exec("UPDATE courses SET coursename='$coursename', startdate='$basedate', semester='$semester', courselength='$courselength', col1name='$col1name', col2name='$col2name', col3name='$col3name',colorscheme='$colorscheme' WHERE courseID='$courseID'");

/*** close the database connection ***/
    $db_handle = null;


//$lastentry = sqlite_last_insert_rowid($db_handle);
//echo $lastentry;



//GO TO editCourse.php
$goto = "editCourse.php?courseID=" . $courseID; 
echo "<script> window.location.href = '$goto' </script>";


?>
