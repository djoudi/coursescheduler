<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";


$courseID = $_POST['courseID'];
$week = $_POST['week'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];

//ESCAPE ANY QUOTES-ADD LINE BREAKS
$descrip = $_POST['descrip'];
$descrip = htmlentities($descrip, ENT_QUOTES);
$descrip = nl2br($descrip);
$displaydate = $_POST['displaydate'];
$assignDate = mktime(12,0,0,$month,$day,$year);


//NOTE $TEXTSTYLE IS CHECKBOX ARRAY
if (isset($_POST['textstyle'])) {
    $textstyle= $_POST['textstyle'];

$n=count($textstyle);

	for($x=0;$x<$n;$x++){
		//ADD STYLE TAGS TO $DESCRIP STRING
		if($textstyle[$x]=='bold'){
			$descrip = '<strong>' . $descrip . '</strong>';
		}

		if($textstyle[$x]=='red'){
			$descrip = '<span style="color:#CC0000;">' . $descrip . '</span>';
		}

		if($textstyle[$x]=='italic'){
			$descrip = '<i>' . $descrip . '</i>';
		}

	}
}


//GET COURSE START DATE
$query = $db_handle->query("SELECT startdate from courses WHERE courseID=$courseID");
     $result = $query->fetch(PDO::FETCH_ASSOC);
$startdate = $result['startdate'];

//CALCULATE ASSIGNMENT DUE FACTOR
$duefactor = $assignDate - $startdate;

//CLEAR QUERY
$query=null;    


$query = $db_handle->exec("INSERT INTO assignments (courseID,weeknum,duedayfactor,descrip,displaydate)VALUES ('$courseID','$week','$duefactor','$descrip', '$displaydate')");


//return to editCourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";


?>
