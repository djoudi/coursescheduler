<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$current_year = $current_year = date("Y");



$x=0;

//GET THIS USERS COURSES OR ALL IF ADMIN
if($role == "admin"){
	foreach ($db_handle->query("SELECT * FROM courses") as $row){

	$coursedata[$x][0] = $row['courseID'];
	$coursedata[$x][1] = $row['coursename'];
	$coursedata[$x][2] = $row['semester'];

	$x++;
	}
}else{
	foreach ($db_handle->query("SELECT courseID FROM usercourses WHERE userID='$userID' ") as $row){

	$query2 = $db_handle->query("SELECT courseID,coursename,semester from courses WHERE courseID = $row[0]");
 	$result = $query2->fetch(PDO::FETCH_ASSOC);

	$coursedata[$x][0] = $result['courseID'];
	$coursedata[$x][1] = $result['coursename'];
	$coursedata[$x][2] = $result['semester'];

	$x++;
	}
}  

//SAVE NUMBER OF COURSES FOUND FOR DISPLAY LOOP 
$numcourses=$x;

//SORT THE COURSEDATA ARRAY TO DISPLAY LISTING ALPHABETICALLY
function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}

$coursedata = subval_sort($coursedata,'1');

    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Schedule Creator</title>


<style type="text/css">
body{background-color:#3A4F5A;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto; width:800px;background-color:#FFFFFF;padding:15px;}
.style1{font-size:1.3em;font-weight:bold;margin-bottom:5px;}
.comment{margin-top:5px;}
#form1{padding:10px;border:solid 1px #660033;}
#form2{padding:10px;border:solid 1px #660033;}
#form3{padding:10px;border:solid 1px #660033;}
.style2 {color: #CC6600;margin-left:25px;margin-bottom:5px;}
.style3 {
	color: #CC6600
}
</style>


</head>

<body>
<div id="container">

<div style="float:right;margin-right:30px;"><a href="help.html"target="_blank">Help</a></div>
<div style="clear:both;float:right;margin-right:30px;margin-top:5px;font-size:.8em;"><?php echo $userID;?> <a href="https://webaccess.psu.edu/cgi-bin/logout"> Log out</a>
</div>


<h2 class="style3">Course Schedule Creator</h2>
<div class="style1"></div>
<form id="form1" name="form1" method="post" action="writeNewCourse.php">
<input type="hidden" name="userID" id="userID" value="<?php echo $userID; ?>"/>
<div class="style1">Create New Course Schedule</div>
  Course name:
  <input type="text" name="coursename" id="coursename" size="40"/>
  <div class="style2">Course title and nomenclature. Ex: African and American Studies (AAAS100)</div>
  
 Semester:
<input name="semester" type="radio" value="Fall"  checked  />Fall
<input name="semester" type="radio"  value="Spring"  />Spring
<input name="semester" type="radio"  value="Summer" />Summer
<input name="semester" type="radio"  value=""/>N/A

 <div style="margin-top:5px;">Length of course:
 <input type="text" size="4" name="courselength" id="courselength" value="16">  weeks. 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Color Scheme
<select name="colorscheme">
	<option value="1">Default</option>
	<option value="2">Ivy</option>
	<option value="3">Canada</option>
	<option value="4">Citrus</option>
	<option value="5">Spanish</option>
</select>
</div>
 <div class="style2">Typical: Spring or Fall-16 weeks including breaks, Summer- 6-12 weeks.</div>
 Start date:
 <select name="month">
<option value=01>January</option>
<option value=02 selected>February</option>
<option value=03>March</option>
<option value=04>April</option>
<option value=05>May</option>
<option value=06>June</option>
<option value=07>July</option>
<option value=08>August</option>
<option value=09>September</option>
<option value=10>October</option>
<option value=11>November</option>
<option value=12>December</option>
</select>
<select name="day">
<option value=01>1</option>
<option value=02>2</option>
<option value=03>3</option>
<option value=04>4</option>
<option value=05>5</option>
<option value=06>6</option>
<option value=07>7</option>
<option value=08>8</option>
<option value=09>9</option>
<option value=10>10</option>
<option value=11>11</option>
<option value=12>12</option>
<option value=13>13</option>
<option value=14>14</option>
<option value=15>15</option>
<option value=16>16</option>
<option value=17>17</option>
<option value=18>18</option>
<option value=19>19</option>
<option value=20>20</option>
<option value=21>21</option>
<option value=22>22</option>
<option value=23>23</option>
<option value=24>24</option>
<option value=25>25</option>
<option value=26>26</option>
<option value=27>27</option>
<option value=28>28</option>
<option value=29>29</option>
<option value=30>30</option>
<option value=31>31</option>
</select>
<select name="year">
<?php
for($x=$current_year;$x<=$current_year + 5;$x++){
	echo "<option value='$x'>$x</option>";
	}
?>
</select>
<div class="style2">First day of the course.</div>

Select the 3 column headings:
<select name="col1name"><option value="Dates">Dates</option><option value="Week">Week</option><option value="Time Frame">Time Frame</option></select>

<select name="col2name"><option value="Lessons">Lessons</option><option value="Topics">Topics</option><option value="Units">Units</option><option value="Modules">Modules</option></select>

<select name="col3name"><option value="Assignments">Assignments</option><option value="Student Tasks">Student Tasks</option><option value="Work to be Completed">Work to be Completed</option></select>
<br />
<div class="style3" style="float:right;">All choices can be changed later.</div>
<input type="submit" name="submit" id="submit" value="Create New Course" />
</form>
<br/>

<!--EDIT EXISTING COURSE-->

<form id="form2" name="form2" method="post" action="editCourse.php">
<div class="style1">Edit Existing Course</div>
<select name="courseID">

<?php
for($x=0;$x<$numcourses;$x++){
echo "<option value='" . $coursedata[$x][0] . "'>" . $coursedata[$x][1] . "</option>";
}

?>

</select>

<input type="submit" name="submit" value="GO" />
<br />
<div class="comment">Change start date, add assignments, add comments, make changes to existing schedule.</div>
</form>
<br/>

<!--SAVE SCHEDULE AS HTML PAGE-->

<form id="form3" name="form3" method="post" action="writeHTMLfile.php">
<div class="style1">Save Schedule of Existing Course as an HTML file.</div>
<select name="courseID">

<?php
for($x=0;$x<$numcourses;$x++){
echo "<option value='" . $coursedata[$x][0] . "'>" . $coursedata[$x][1] . "</option>";
}

?>

</select>

<input type="submit" name="submit" value="GO" />
  <br />
<div class="comment">This will create an HTML file on the server from data of the selected course and give you a URL to that page. This page can be linked to the calendar tab in Angel.  
<p>It can also be saved from your browser, opened in Word and then converted to a Word or PDF document to be offered as a downloadable/printable document.It can be opened in other software, such as Dreamweaver, and altered as desired, although the linked file is not modified.</p>
This file will remain until the course schedule is deleted. It is overwritten each time the schedule is Saved as HTML file as long as schedule title, semester, and year are the same. Changes to any of these creates a new file with new name. Editing the schedule will not effect this file until it is Saved as HTML again.
</div>
</form>

</div>



</body>
</html>
