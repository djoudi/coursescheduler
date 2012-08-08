<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Course Schedule</title>

<script type="text/javascript">
<!--
function warning(){
var answer = confirm ("All course data will be deleted.\nContinue?")
	if (!answer){
	return false;
	}
}
// -->
</script> 

<style type="text/css">
body{margin:0px;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{width:95%;min-width:1100px;margin:auto;background-color:#FFFFFF;padding:15px;border:}
#topdiv{background-color:#FFFFFF;margin:0px;padding:8px;}
#courseformbox{clear:both;border:solid 1px #660033;}
#form1{width:630px;margin:10px;}
.shading{background-color:#CCCCCC;}
table form{float:right;}
.comment{color:red;font-size:.9em;margin-left:10px;}
table { background-color:#FFFFFF; }
#coursetitle{clear:both;font-size:1.2em;font-weight:bold;padding-bottom:2px;}
.smallorange{color:#CC6600;font-size:.8em;}



<?php
$courseID = $_REQUEST['courseID'];

//SELECT COURSE DATA
 $query = $db_handle->query("SELECT * from courses WHERE courseID=$courseID");
    $result = $query->fetch(PDO::FETCH_ASSOC);

$start = $result['startdate'];
$startdate =$result['startdate'];
$courselength=$result['courselength'];
$coursename = $result['coursename'];
$semester = $result['semester'];
$col1name = $result['col1name'];
$col2name = $result['col2name'];
$col3name = $result['col3name'];
$colorscheme =$result['colorscheme'];

//current year set for this course
$current_year = date("Y",$start);

 unset($query);

//GET OWNER ID
$query = $db_handle->query("SELECT owner FROM usercourses WHERE courseID = '$courseID'");
$result = $query->fetch(PDO::FETCH_ASSOC);
$owner = $result['owner'];

 unset($query);

$yr = date('Y',$start);
$title = $coursename;
/*
if($semester != ""){
$title = $title. " " . $semester . " Semester " .$yr;
}
*/
//CREATE WEEK DATES
for($weekcount=1; $weekcount <= $courselength; $weekcount++){
	$end = $start + 518400; //add six days
	$formatstart = date("n/d",$start) . " - ";
	$formatend = date("n/d/Y",$end);
	$week[$weekcount] = $formatstart . $formatend;
	$start = $end + 86400; //add one day
	}

//WRITE STYLING DEPENDING ON COLORSCHEME VALUE
if($colorscheme==1){
//SCHEME 1 Default
echo"
body{background-color:#345590;color:#333333;}
#container{background-color:#345590;}
.shading{background-color:#ECECEC;}
.comment{color:#33538D;font-size:.9em;margin-left:15px;}
.coursenotes{color:#E3EAF6;}
#tableborder{border: 2px solid #345590;padding:0px;margin:15px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin:10px;color:#FFFFFF;}
.colnames{background-color:#8B9EBE;font-weight:bold;border-bottom: 2px solid #345590;}";

}elseif($colorscheme==2){
//SCHEME 2 IVY
echo"
body{background-color:#679A67;color:#043704;}
#container{background-color:#679A67;}
.shading{background-color:#E1E7E1;}
.comment{color:#728F72;font-size:.9em;margin-left:10px;}
.coursenotes{color:#E7EFE7;}
#tableborder{border: 2px solid #000000;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin:10px;color:#FFFFFF}
.colnames{background-color:#728F72;font-weight:bold;border-bottom: 2px solid #000000;}";
}

elseif($colorscheme==3){
//SCHEME 3 CANADA
echo"
body{background-color:#B20E32;color:#000000;}
#container{background-color:#B20E32;}
.shading{background-color:#E5E5E5;}
.comment{color:#990033;font-size:.9em;margin-left:10px;}
.coursenotes{color:#FFFFFF;}
#tableborder{border: 2px solid #000000;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin:10px;color:#FFFFFF}
.colnames{background-color:#A3A1A1;font-weight:bold;}";}

elseif($colorscheme==4){
//SCHEME 4 Citrus
echo"
body{background-color:#EE5F0C;color:#000000;}
#container{background-color:#EE5F0C;}
.shading{background-color:#FCF9DB;}
.comment{color:#79AC1E;font-size:.9em;margin-left:10px;}
.coursenotes{color:#FCE5D8;}
#tableborder{border: 2px solid #79AC1E;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin:10px;color:#FFFFFF}
.colnames{background-color:#F9F2AE;font-weight:bold;}";}

elseif($colorscheme==5){
//SCHEME 5 Spanish
echo"
body{background-color:#ECE0C8;color:#000000;}
#container{background-color:#ECE0C8;}
.shading{background-color:#F4ECDE;}
.comment{color:#EE5F0C;font-size:.9em;margin-left:10px;}
.coursenotes{color:#998F7B;}
#tableborder{border: 2px solid #000000;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin:10px;}
.colnames{background-color:#998F7B;font-weight:bold;color:#FFFFFF;}";}

echo"</style>";


?>

</head>

<body>
<div id="container">

<div id="topdiv">

<div style="float:right;margin-left:8px;width:400px;">
<form style="float:right;" name="renderpage" method="post" action="displayschedule.php">
<input type="hidden" name="courseID" value="<?php echo $courseID; ?>"> 
<input type="submit" value="Display This Schedule">
</form>

<div style="float:right;padding-right:25px;padding-left:25px;"><a href="options.php"> Return to Options Page</a></div>


<?php


//SHARE THIS COURSE
// The file to be used as the database:
$userdatabase = "../data/users";

if(! $db_handle2 = new PDO("sqlite:$userdatabase")){
   echo $sqlite_error;
	exit;
    }


//GET THE GROUP TO WHICH THIS USER BELONGS
$query = $db_handle2->query("SELECT groups FROM users WHERE userID = '$userID'");
	$result = $query->fetch(PDO::FETCH_ASSOC);
$groups = $result['groups'];





//SELECT ALL USERS IN THIS GROUP
//SHARE FORM WITH DROP DOWN LIST OF USERS
echo"<div style='clear:both;float:right;margin-top:6px;margin-bottom:5px;font-size:.9em;'>";
echo "<form  method='post' action='shareCourse.php'>Share This Course:<input type='submit' value='Add User'>
<input type='hidden' name='courseID'  value='$courseID'>
<select name='newUserID'>";
foreach ($db_handle2->query("SELECT userID FROM users WHERE groups = '$groups'") as $row){
	if(substr($row[0],0,5)!="admin"){ //OMIT ADMIN FROM LIST
	echo"<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	}
}
echo "</select>";
echo"</form>";

//THIS COURSE IS SHARED BY
echo"<span style ='font-size:.8em;'>This course is shared by ";

//CHECK FOR SAMPLE COURSE
if($courseID==1){
echo "all.";}
else{

//IF NOT SAMPLE COURSE GET ALL USERS OF THIS COURSE 
foreach ($db_handle->query("SELECT userID FROM usercourses WHERE courseID = '$courseID'") as $row){
	echo $row[0] . ", ";
	}
}

echo "</span></div> ";
?>
</div>



<div style="font-size:1.3em;font-weight:bold;padding-bottom:5px;">Edit Schedule for Course: <?php echo $title; ?>
</div>

<div id="courseformbox">

<div style="clear:both;float:right;margin:10px;;width:435px;">
	<div style="font-size:.9em;font-weight:bold;">Semester Choices:</div>
<div class="smallorange"><strong>Spring/Fall:</strong> Inserts Spring or Thanksgiving break, typically 16 weeks<br><strong>Summer:</strong> No break, typically 6-12 weeks<br><strong>N/A:</strong>No break inserts, no semester title, variable weeks<br>
<b>Changing semester only affects break placement not dates.</b>
</div>
<div style="font-size:.9em;font-weight:bold;padding-top:5px;">Save As New Course</div>
<form id="saveAsNew" method="post" action="saveAsNew.php">
<input type="hidden" name="courseID" value=" <?php echo $courseID; ?> ">
<input type="hidden" name="groups" value="<?php echo $groups; ?> ">
<input type="text" name="coursename" id="coursename" size="43" value="Enter New Course Name"/>
<input type="submit" value="SAVE">
<div class="smallorange">This will save all data for this course to the new name.</div>
</form>
</div>

<div>
<form  id="form1" name="form1" method="post" action="editCourseSettings.php">
<input type="hidden" name="courseID" id="courseID"  value="<?php echo $courseID; ?>"/>
 <strong>Course name:</strong>
<input type="text" name="coursename" id="coursename" size="60"/ value="
<?php echo $coursename ?> "><br>  
 <strong>Semester:</strong>

<?php
if($semester=="Fall"){echo "<input name='semester' type='radio' value='Fall' checked />Fall";
}else{echo"<input name='semester' type='radio' value='Fall' />Fall";}
if($semester=="Spring"){echo "<input name='semester' type='radio'  value='Spring' checked />Spring";
}else{echo"<input name='semester' type='radio'  value='Spring' />Spring";}
if($semester=="Summer"){echo "<input name='semester' type='radio'  value='Summer' checked/>Summer";
}else{ echo "<input name='semester' type='radio'  value='Summer'/>Summer";}
if($semester=="N/A"){echo "<input name='semester' type='radio'  value='' checked/> N/A<br>";
}else{ echo"<input name='semester' type='radio'  value=''/> N/A<br>";}

//LENGTH OF COURSE
echo "<strong>Length of course:</strong>";
echo "<input type='text' size='4' name='courselength' id='courselength' value='" .   $courselength . "'/>  weeks.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

//COLOR SCHEME
echo "<strong>Color Scheme</strong>";
echo " <select name ='colorscheme'>";
	if($colorscheme ==1){
	echo "<option value='1' selected>Default</option>";
	}else{echo "<option value='1'>Default</option>";}
	if($colorscheme ==2){
	echo "<option value='2' selected>Ivy</option>";
	}else{echo "<option value='2'>Ivy</option>";}
	if($colorscheme ==3){
	echo "<option value='3' selected>Canada</option>";
	}else{echo "<option value='3'>Canada</option>";}
	if($colorscheme ==4){
	echo "<option value='4' selected>Citrus</option>";
	}else{echo "<option value='4'>Citrus</option>";}
	if($colorscheme ==5){
	echo "<option value='5' selected>Spanish</option>";
	}else{echo "<option value='5'>Spanish</option>";}

echo "</select><br>";


//START DATE
echo " <strong>Start date:</strong>";

$month = date("F",$startdate);
$monthnum = date("m",$startdate);
$day = date("d",$startdate);
$yr = date("Y",$startdate);
echo "<select name='month'>";
for($x=1;$x<=12;$x++){
$monthname = date("F",mktime(0,0,0,$x,1,0));
if($x==$monthnum){echo "<option value='" . $x . " 'selected>" . $monthname . "</option>";
}else{	
echo "<option value='" . $x . "'>" . $monthname . "</option>";
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

for($x=$current_year-1;$x<=$current_year + 2;$x++){
if($x==$yr){echo "<option value='" . $x . " 'selected>" . $x . "</option>";
}else{	
echo "<option value='" . $x . "'>" . $x . "</option>";
}
}

echo "</select>";

echo "<span class='smallorange'>First day of the course.</span><br>";


//COLUMN HEADINGS
echo "<strong>Select the 3 column headings:</strong>";

echo "<select name='col1name'>";
if($col1name=='Dates'){
echo "<option value='Dates' selected>Dates</option>";
}else{ echo"<option value='Dates'>Dates</option>";}
if($col1name == 'Week'){
echo"<option value='Week' selected>Week</option>";
}else{echo "<option value='Week'>Week</option>";}
if($col1name == 'Time Frame'){
echo "<option value='Time Frame' selected>Time Frame</option>";
}else{ echo "<option value='Time Frame'>Time Frame</option>";}
echo "</select>";


echo "<select name='col2name'>";
if($col2name=='Lessons'){echo"<option value='Lessons' selected>Lessons</option>";
}else{echo "<option value='Lessons'>Lessons</option>";}
if($col2name=='Topics'){echo"<option value='Topics' selected>Topics</option>";
}else{echo"<option value='Topics'>Topics</option>";}
if($col2name == 'Units'){echo "<option value='Units' selected>Units</option>";
}else{echo "<option value='Units'>Units</option>";}
if($col2name =='Modules'){echo "<option value='Modules' selected>Modules</option>";
}else{echo "<option value='Modules'>Modules</option>";}
echo"</select>";


echo "<select name='col3name'>";
if($col3name=='Assignments'){echo"<option value='Assignments' selected='selected'>Assignments</option>";
}else{echo "<option value='Assignments'>Assignments</option>";}
if($col3name=='Student Tasks'){echo"<option value='Student Tasks' selected='selected'>Student Tasks</option>";
}else{ echo "<option value='Student Tasks'>Student Tasks</option>";}
if($col3name =='Work to be Completed'){echo"<option value='Work to be Completed' selected='selected'>Work to be Completed</option>";
}else{echo"<option value='Work to be Completed'>Work to be Completed</option>";}
echo "</select><br />";
echo "<input style='margin-top:6px;' type='submit' name='submit' id='submit' value='Change Course Schedule Settings' />";
echo "</form>";

echo "</div>";

echo"<form  method='post' action='deleteCourse.php' onsubmit='return  warning()' style='margin-left:10px;'>
<input name='courseID' type='hidden' value='" . $courseID . "'>
<input type='submit' value='Delete this Schedule' /></form>";

//CLOSE COURSE FORM BOX
echo "</div>";


echo"<div style='color:#CC6600;'>Please note: It is essential that the start date is set correctly before adding assignment dates.</div>";

//CLOSE TOPDIV
echo "</div>";



//BEGIN DISPLAY OF SCHEDULE
//*************************************************************


//COURSE TITLE
echo "<div id='coursetitle'>$title</div>";

//ADD-EDIT COURSE NOTES
echo "<form style='clear:both;float:right;margin-top:4px;' method='post' action='editNotes.php'><input type='submit' value='Edit'><input type='hidden' name='courseID'  value='$courseID'></form>

<form style='float:right;' method='post' action='addNotes.php'><span style='color:#FFFFFF;'> <- Course Notes: </span><input type='submit' value='Add'><input type='hidden' name='courseID'  value='$courseID'></form> ";



//SELECT ALL NOTES FROM SPECIFIED COURSE  
foreach ($db_handle->query("SELECT * from coursenotes WHERE courseID='$courseID'") as $row){
	echo "<div class='coursenotes' style='margin-left:25px;margin-bottom:3px;'>" . $row['notes'] . "</div>";
}


echo "<div id='tableborder'>";



//BEGIN TABLE
echo "<table width='100%' cellpadding='5' border='1'>";
echo "<tr class='colnames'><th>$col1name</th><th>$col2name</th><th>$col3name</th></tr>";
for($weekcount=1;$weekcount <= $courselength; $weekcount++){
	//SHADING FOR ALTERNATING ROWS
	if ($weekcount % 2 == 0 ){
		echo "<tr class='shading'>";
	}else{
		echo "<tr>";
	}
	//PRINT WEEK DATES
	//echo "<td width='160' valign='top'> <b>Week $weekcount</b> <br>$week[$weekcount]</td>";
	//echo "<td width='160' valign='top'> <br>$week[$weekcount]</td>";
	
	//PRINT WEEK DATES
	//THIS REPLACES ABOVE TO CHANGE WEEK NUMBER LABELING 8/10
	if(($semester=="Spring") && ($weekcount==9)){
		echo "<td width='160' valign='top'><br>$week[$weekcount]</td>";
		}elseif(($semester=="Spring") && ($weekcount>9)){
			$weekadjusted=$weekcount-1;
			echo "<td width='160' valign='top'><b>Week $weekadjusted</b> <br>$week[$weekcount]</td>";
		}elseif(($semester=="Fall") && ($weekcount==13)){
			echo "<td width='160' valign='top'><br>$week[$weekcount]</td>";
		}elseif(($semester=="Fall") && ($weekcount>13)){
			$weekadjusted=$weekcount-1;
			echo "<td width='160' valign='top'><b>Week $weekadjusted</b><br>$week[$weekcount]</td>";
		}else{
			echo "<td width='160' valign='top'><b>Week $weekcount</b> <br>$week[$weekcount]</td>";
	 }		
	 
	 
	//PRINT ROW FOR FALL OR SPRING BREAKS
	if(($semester=="Spring") && ($weekcount==9)){
		echo "<td width='350'>Spring Break!!</td><td></td></tr>";
	}elseif(($semester=="Fall") && ($weekcount==13)){
		echo "<td width='350'>Thanksgiving Break!!</td><td></td></tr>";
	}else{	
	
	//GET LESSON TITLES
	echo "<td width='350' valign='top'><form method='post' action='editLessons.php'><input type='submit' value='Edit'><input type='hidden' name='courseID'  value='$courseID'><input type='hidden' name='week' value='$weekcount'></form>";
	echo "<form method='post' action='addLessons.php'><input type='submit' value='Add'><input type='hidden' name='courseID'  value='$courseID'><input type='hidden' name='week' value='$weekcount'></form>";
	foreach ($db_handle->query("SELECT * from lessons WHERE courseID='$courseID' AND weeknum='$weekcount'") as $row){
	echo "<div class='title'>" . $row['lessontitle'] . "<div>";
	if($row['lessoncomment']!="") echo "<div class='comment'>" . $row['lessoncomment'] . "</div>";
	}
	 echo "</td>";
	
//GET ASSIGNMENTS
	echo "<td width='*' valign='top'>
	<form method='post' action='editAssignments.php'>
	<input type='submit' value='Edit'>
	<input type='hidden' name='courseID'  value='$courseID'>
	<input type='hidden' name='week' value='$weekcount'>
	<input type='hidden' name='weekdates' value='$week[$weekcount]'>
	</form>";
	
	echo"<form method='post' action='addAssignment.php'>
	<input type='submit' value='Add'>
	<input type='hidden' name='courseID'  value='$courseID'>
	<input type='hidden' name='week' value='$weekcount'>
	<input type='hidden' name='weekdates' value='$week[$weekcount]'>
	<input type='hidden' name='current_year' value='$current_year'>
	</form>";
	
	foreach ($db_handle->query("SELECT * from assignments WHERE courseID='$courseID' AND weeknum='$weekcount' ORDER BY duedayfactor ASC") as $row){
	$baseAssignDate = $startdate + $row['duedayfactor'];
	$assignDate = date("l n/d/Y",$baseAssignDate);
if($row['displaydate']!= "nodate"){
	echo "<b>". $row['displaydate'] . " " . $assignDate . "</b><br>";}
	echo $row['descrip'] . "<br>";
	}
	echo "</td></tr>";
}
}
echo "</table>";

//CLOSE DATABASE
 $db_handle = null;

?>
</div>
</body>
</html>



