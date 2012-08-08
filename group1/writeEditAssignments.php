<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$assignID = $_POST['assignID'];
$courseID = $_POST['courseID'];
$startdate = $_POST['startdate'];
$month = abs($_POST['month']);
$day = abs($_POST['day']);
$year = abs($_POST['year']);


//ESCAPE ANY QUOTES-ADD LINE BREAKS
$descrip = $_POST['descrip'];
$descrip = htmlentities($descrip, ENT_QUOTES);
$descrip = nl2br($descrip);

$displaydate = $_POST['displaydate'];

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

//CALCULATE ASSIGNMENT DUE FACTOR
$assigndate = mktime(12,0,0,$month,$day,$year);
$duefactor = $assigndate - $startdate;

$query = $db_handle->exec("UPDATE assignments SET duedayfactor='$duefactor', descrip='$descrip', displaydate ='$displaydate' WHERE assignID = '$assignID'");


//GO TO newcourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";


?>
