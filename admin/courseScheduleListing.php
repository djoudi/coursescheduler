<?php
//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');

//passed value of $group
$group = $_REQUEST['group'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Course Scheduler Admin</title>
<style type="text/css">
body{background-color:#3A4F5A;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto; width:600px;background-color:#FFFFFF;padding:15px;}
.style1{font-size:1.3em;font-weight:bold;margin-bottom:5px;}
.comment{margin-top:5px;}

.style2 {color: #CC6600;margin-left:25px;margin-bottom:5px;}
.style3 {
	color: #CC6600
}
</style>

</head>

<body>
<div id="container">
<div style='float:right;'><a href='admin.php'>Return to Admin</a></div>
<h3>Course Schedules for Group <?php echo $group; ?></h3>
<div class='style3'>Select checkboxes and Delete Selected Schedules to remove unwanted files.<br/> This will remove all data associated with selected schedules.<br/><strong>Be certain you want to do this.</strong></div><br/>

<form action='deleteSchedule.php' method='post'>

<?php

echo "<input type='hidden' name='group' value='" . $group . "'/>";
// The file to be used as the database:
$databasefile = "../group" . $group . "/data/coursescheduler";


if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
	exit;
    }
 
$courseIDs=array();

//GET COURSES
foreach ($db_handle->query("SELECT * from courses ORDER BY coursename") as $row){
$courseID = $row['courseID'];
$coursename = $row['coursename'];

echo "<input type='checkbox' name='courseIDs[]' value='" . $courseID . "'/>";

echo $coursename . "<br/>";

}

?>

<br/>
<input type='submit' value='DELETE SELECTED SCHEDULES'/>

</form>




</body>
</html>

