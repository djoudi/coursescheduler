<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

//GET CURRENT BREAK WEEKS
$breakweeksfile = "../breakweeks.csv";
$fd = fopen($breakweeksfile, 'r');
$breakweeks1 = fread ($fd, filesize($breakweeksfile));
$breakweeks = explode(',', $breakweeks1);

$springbreak = $breakweeks[0];
$fallbreak = $breakweeks[1];

//CHANGE VALUES FROM FORM
$changespringbreak = $_POST['changespringbreak'];
$changefallbreak = $_POST['changefallbreak'];

//CHECK FOR ONLY ONE SEMESTER CHANGE VALUE
if(($changefallbreak != $fallbreak) && ($changespringbreak != $springbreak)) {
	echo "<script>alert('You can only enter one new value for either Spring or Fall. \\n Please try again.');";
	echo "window.history.go(-1);";
	echo "</script>";
	exit();
	}


//SAVE NEW BREAK WEEKS TO FILE
$newbreaks = $changespringbreak . "," . $changefallbreak; 
$fp = fopen($breakweeksfile, 'w+') or die("I could not open $filename."); 
fwrite($fp,$newbreaks); 
fclose($fp); 

?>

<html lang="en">
<head>
<meta charset="utf-8" />
<title></title>

<style type="text/css">
body{background-color:#3A4F5A;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto; width:800px;background-color:#FFFFFF;padding:15px;}
</style>

</head>

<body>
<div id="container">

<?php


//****************************************
//CHANGE TO FALL BREAK
if(($changefallbreak != $fallbreak) && ($changespringbreak == $springbreak)) {
	echo "Changing Fall break.<br/>These courseID's were changed.<br/>";

//COURSE MUST BE CONVERTED TO SPRING BEFORE INSERTING NEW FALL BREAK
//TRAVERSE ALL COURSES - CONVERT ANY FALL SEMESTERS TO SPRING
//GET COURSE INFO
foreach($db_handle->query("SELECT * from courses WHERE 	semester = 'Fall'")as $row){
	$semesterCurrent = $row['semester'];
	$startdate = $row['startdate'];
	$courseID = $row['courseID'];


	//CONVERT FALL TO SPRING
		echo $courseID . ", ";
		//SELECT ALL LESSONS FROM SPECIFIED COURSE AND WEEKS 9-13
		for($week = $fallbreak - 1;$week > $springbreak - 1;$week--){

			$queryLessons = $db_handle->query("SELECT weeknum, lessonID from lessons WHERE courseID='$courseID' AND weeknum='$week'");
			$result = $queryLessons->fetchALL(PDO::FETCH_ASSOC);

				foreach($result as $row){
				$newweeknum=$row['weeknum'] + 1;
				$updateTable =$db_handle->exec ("UPDATE lessons SET weeknum='$newweeknum' WHERE lessonID = '$row[lessonID]'");
					if(!$updateTable){echo "no update" ."<br>";}
				}
		}

		//SELECT ALL ASSIGNMENTS FROM SPECIFIED COURSE AND WEEKS 9-13
		for($week = $fallbreak - 1;$week > $springbreak - 1;$week--){
			$queryAssignments = $db_handle->query("SELECT assignID, weeknum, duedayfactor from assignments WHERE courseID='$courseID' AND weeknum='$week'");
			$result = $queryAssignments->fetchALL(PDO::FETCH_ASSOC);	
	
				foreach($result as $row){
				$newweeknum=$row['weeknum'] + 1;
				$newdueday = $row['duedayfactor'] + 604800;
				$updateTable =$db_handle->exec ("UPDATE assignments SET weeknum='$newweeknum',duedayfactor='$newdueday' WHERE assignID = '$row[assignID]'");
				}
		}
	

unset($queryAssignments);
unset($queryLessons);


//CONVERT SPRING TO BACK TO FALL PLACING FALL BREAK AT NEW FALL BREAK WEEK

	//SELECT ALL LESSONS FROM SPECIFIED COURSE AND WEEKS 10-14
		for($week=$changespringbreak + 1;$week < $changefallbreak + 1;$week++){
			$queryLessons = $db_handle->query("SELECT weeknum, lessonID from lessons WHERE courseID='$courseID' AND weeknum='$week'");
			$result = $queryLessons->fetchALL(PDO::FETCH_ASSOC);
		
			foreach ($result as $row){
			$newweeknum=$row['weeknum'] - 1;
			$updateTable =$db_handle->exec("UPDATE lessons SET weeknum='$newweeknum' WHERE lessonID = '$row[lessonID]'");
			}
		}


//SELECT ALL ASSIGNMENTS FROM SPECIFIED COURSE AND WEEKS 10-14
		for($week=$changespringbreak + 1;$week < $changefallbreak + 1;$week++){
			$queryAssignments = $db_handle->query("SELECT assignID, weeknum, duedayfactor from assignments WHERE courseID='$courseID' AND weeknum='$week'");
			$result = $queryAssignments->fetchALL(PDO::FETCH_ASSOC);	
	
				foreach($result as $row){
				$newweeknum=$row['weeknum'] - 1;
				$newdueday = $row['duedayfactor'] - 604800;
				$updateTable =$db_handle->exec("UPDATE assignments SET weeknum='$newweeknum',duedayfactor='$newdueday' WHERE assignID = '$row[assignID]'");
				}
			}


}//END TRAVERSING COURSES


echo "The Fall break has been changed in all Fall courses.";

}//END CHANGE TO FALL BREAK


//********************************************
//CHANGE TO SPRING BREAK
if(($changefallbreak == $fallbreak) && ($changespringbreak != $springbreak)) {
echo "Changing spring break.<br/>These courseID's were changed.<br/>";

//COURSE MUST BE CONVERTED TO FALL BEFORE INSERTING NEW SPRING BREAK
//TRAVERSE ALL COURSES - CONVERT ANY SPRING SEMESTERS TO FALL
//GET COURSE INFO
foreach($db_handle->query("SELECT * from courses WHERE semester='Spring'")as $row){
	$semesterCurrent = $row['semester'];
	$startdate = $row['startdate'];
	$courseID = $row['courseID'];


	//CONVERT SPRING TO FALL
		echo $courseID . ", ";
		//SELECT ALL LESSONS FROM SPECIFIED COURSE AND WEEKS BETWEEN SPRING AND FALL
		for($week=$springbreak + 1;$week < $fallbreak + 1;$week++){
		$queryLessons = $db_handle->query("SELECT weeknum, lessonID from lessons WHERE courseID='$courseID' AND weeknum='$week'");
		$result = $queryLessons->fetchALL(PDO::FETCH_ASSOC);
		
			foreach ($result as $row){
			$newweeknum=$row['weeknum'] - 1;
			$updateTable =$db_handle->exec("UPDATE lessons SET weeknum='$newweeknum' WHERE lessonID = '$row[lessonID]'");
			}
		}


		//SELECT ALL ASSIGNMENTS FROM SPECIFIED COURSE AND WEEKS BETWEEN SPRING AND FALL
		for($week=$springbreak + 1;$week < $fallbreak + 1;$week++){

			$queryAssignments = $db_handle->query("SELECT assignID, weeknum, duedayfactor from assignments WHERE courseID='$courseID' AND weeknum='$week'");
			$result = $queryAssignments->fetchALL(PDO::FETCH_ASSOC);	
	
			foreach($result as $row){
				$newweeknum=$row['weeknum'] - 1;
				$newdueday = $row['duedayfactor'] - 604800;
				$updateTable =$db_handle->exec("UPDATE assignments SET weeknum='$newweeknum',duedayfactor='$newdueday' WHERE assignID = '$row[assignID]'");
			}
		}
	

unset($queryAssignments);
unset($queryLessons);


//CONVERT FALL BACK TO SPRING PLACING SPRING BREAK AT NEW SPRING BREAK WEEK

	//SELECT ALL LESSONS FROM SPECIFIED COURSE AND WEEKS 9-13
		for($week = $fallbreak - 1;$week > $changespringbreak - 1;$week--){

			$queryLessons = $db_handle->query("SELECT weeknum, lessonID from lessons WHERE courseID='$courseID' AND weeknum='$week'");
			$result = $queryLessons->fetchALL(PDO::FETCH_ASSOC);

			foreach($result as $row){
				$newweeknum=$row['weeknum'] + 1;
				$updateTable =$db_handle->exec ("UPDATE lessons SET weeknum='$newweeknum' WHERE lessonID = '$row[lessonID]'");
				if(!$updateTable){echo "no update" ."<br>";}
			}
		}

//SELECT ALL ASSIGNMENTS FROM SPECIFIED COURSE AND WEEKS 9-13
		for($week = $fallbreak - 1;$week > $changespringbreak - 1;$week--){
			$queryAssignments = $db_handle->query("SELECT assignID, weeknum, duedayfactor from assignments WHERE courseID='$courseID' AND weeknum='$week'");
			$result = $queryAssignments->fetchALL(PDO::FETCH_ASSOC);	
	
			foreach($result as $row){
				$newweeknum=$row['weeknum'] + 1;
				$newdueday = $row['duedayfactor'] + 604800;
				$updateTable =$db_handle->exec ("UPDATE assignments SET weeknum='$newweeknum',duedayfactor='$newdueday' WHERE assignID = '$row[assignID]'");
			}
		}

}//END TRAVERSING COURSES

echo "The Spring break has been changed in all Spring courses.";

}//END CHANGE TO SPRING BREAK


?>

<p><a href="../admin/admin.php">Return to Admin</a></p>

</div>
</body>
</html>