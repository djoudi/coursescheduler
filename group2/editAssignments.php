<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Assignments</title>

<?php
//THIS INCLUDE FILE RETURNS $userID & $role
include ("../validateUser.php");

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$courseID = $_POST['courseID'];
$week = $_POST['week'];
$weekdates = $_POST['weekdates'];


//GET COURSE START DATE
$query = $db_handle->query("SELECT startdate from courses WHERE courseID='$courseID'");
    $result = $query->fetch(PDO::FETCH_ASSOC);
$startdate=$result['startdate'];

//CLEAR QUERY
$query=null;    
?>

<style type="text/css">
body{background-color:#CCCC99;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto; width:600px;background-color:#FFFFFF;padding:15px;}
.style1{font-size:1.2em;font-weight:bold;margin-bottom:5px;}
.comment{margin-top:5px;}
#form1{padding:10px;border:solid 1px #660033;}
.style2 {color: #CC6600;margin-left:25px;margin-bottom:5px;}
</style>
</head>

<body>
<div id="container">
<div> <span style="font-size:1.4em;">Edit Assignment to Week <?php echo $week . " </span><span style='font-size:1.0em;'>" . $weekdates . "</span>";?></div>


<?php

//SELECT ALL ASSIGNMENTS FROM SPECIFIED COURSE AND WEEK
foreach ($db_handle->query("SELECT * from assignments WHERE courseID='$courseID' AND weeknum='$week' ORDER BY duedayfactor ASC") as $row){
echo "<div style='border:solid 1px;padding:5px;'>";
echo "<form  method='post' action='writeEditAssignments.php'>";
echo "<input type='hidden' value='" . $row['assignID'] . "' name='assignID'>";
echo "<input type='hidden' name='courseID'  value='$courseID'>";
echo "<input type='hidden' name='startdate' value='$startdate'>";
$duedate = $startdate + $row['duedayfactor'];
$month = date("F",$duedate);
$monthnum = date("m",$duedate);
$day = date("d",$duedate);
$yr = date("Y",$duedate);

$displaydate = $row['displaydate'];

echo "Date: ";
echo "<select name='month'>";
for($x=$monthnum-1;$x<=$monthnum+1;$x++){
$monthname = date("F",mktime(0,0,0,$x,1,0));
	if($x==$monthnum){
		echo "<option value='" . $x . " ' selected>" . $monthname . "</option>";
	}else{
		echo "<option value='" . $x . " '>" . $monthname . "</option>";
	}
}

echo "</select><select name='day'>";

for($x=1;$x<=31;$x++){
	if($x==$day){echo "<option value='" . $x . " 'selected>" . $x . "</option>";
	}else{	
	echo "<option value='" . $x . "'>" . $x . "</option>";
	}
}

echo "</select><select name='year'>";	
echo "<option value='" . $yr . "'>" . $yr . "</option>";
echo "</select>";

echo"
<span class='style2'>Display date as </span>
<select name='displaydate'>";

if($displaydate == "Due"){echo "<option value='Due' selected>Due</option>";}
else{ echo "<option value='Due'>Due</option>";}
if($displaydate == "On"){echo "<option value='On' selected>On</option>";}
else{echo "<option value='On'>On</option>";}
if($displaydate == "Available"){echo "<option value='Available' selected>Available</option>";}
else{echo "<option value='Available'>Available</option>";}
if($displaydate == "Beginning"){echo"<option value='Beginning' selected>Begining</option>";}
else{echo"<option value='Beginning'>Begining</option>";}
if($displaydate == "Ending"){echo"<option value='Ending' selected>Ending</option>";}
else{echo"<option value='Ending'>Ending</option>";}
if($displaydate == ""){echo"<option value='' selected>No prefix</option>";}
else{echo"<option value=''>No prefix</option>";}
if($displaydate == "nodate"){echo"<option value='nodate' selected>No date displayed</option>";}
else{echo"<option value='nodate'>No date displayed</option>";}


echo"</select><br><br>";

echo "<div style='width:350px;font-size:.8em;'>Text Styles";
if(preg_match("/<strong>/",$row['descrip'])){
echo"<input name='textstyle[]' type='checkbox' value='bold' checked/><strong>Bold</strong> &nbsp;&nbsp;";
}else{
echo"<input name='textstyle[]' type='checkbox' value='bold'/><strong>Bold</strong> &nbsp;&nbsp";
}

if(preg_match("/color/",$row['descrip'])){
echo"<input name='textstyle[]' type='checkbox' value='red' checked/><span style='color:#CC0000;'>Red</span> &nbsp;&nbsp;";
}else{
echo"<input name='textstyle[]' type='checkbox' value='red'/><span style='color:#CC0000;'>Red</span> &nbsp;&nbsp";
}

if(preg_match("/<i>/",$row['descrip'])){
echo"<input name='textstyle[]' type='checkbox' value='italic' checked/><i>Italic</i> &nbsp;&nbsp;";
}else{
echo"<input name='textstyle[]' type='checkbox' value='italic'/><i>Italic</i> &nbsp;&nbsp";
}

echo"</div>";

echo"<textarea name='descrip' cols='60' rows='6'>" . strip_tags($row['descrip']) . "</textarea><br />";
echo "<input type='submit' value='Save Changes' />"; 
echo "</form> ";
	echo "<form method='post' action='deleteAssignment.php'>";
	echo "<input type='hidden' value='" . $row['assignID'] . "' name='assignID'>";
	echo "<input type='hidden' name='courseID'  value='$courseID'>";
	echo "<input type='submit' value='Delete Assignment' /> </form></div><br>";
}
?>

</div>
</body>
</html>
