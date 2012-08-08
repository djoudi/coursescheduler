<?php
//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');
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

<?php

$group = $_REQUEST['group'];

echo"<h3>Schedules saved as HTML file for Group ". $group . "</h3>";
echo"<span class='style3'>Click file name to view in new tab.<br/>Select checkboxes and Delete Files to remove unwanted files.</span>";
echo"<br/><br/>";

$dirname = "../group" .$group . "/calendarfiles";
$dir = opendir($dirname);


$calendarfiles = array();
$x=0;
echo "<form action='deletefiles.php' method='post'>";

while(false != ($file = readdir($dir)))
{
	if(($file != ".") and ($file != ".."))
	{
	$calendarfiles[$x]= "../group" . $group . "/calendarfiles/" . $file;

	echo "<input type='checkbox' name='deletefiles[]' value='" . $calendarfiles[$x] . "'>";
	echo "<a href='" . $calendarfiles[$x] . "' target='_blank'>" . $file . "</a><br/>";
	}
	
}
if($calendarfiles==null){
echo "No files are saved<br/>";
}else{
echo "<br/><input type='submit' value='Delete Files'/>";
}

echo " <a href='admin.php'>Return</a>";
echo "</form>";



?>



</body>
</html>

