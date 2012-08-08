<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display Course Data</title>
<style type="text/css">
body{background-color:#3A4F5A;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto; width:90%;background-color:#FFFFFF;padding:15px;}
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


<?php
//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');

$courseID= $_POST['courseID'];
$group=$_POST['group'];

echo "<b>Group" . $group . "</b>";

// The file to be used as the database:
$databasefile = "../group" . $group . "/data/coursescheduler";


if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
   echo "Did not connect";
	exit;
    }


//COURSES TABLE

 
 echo "<table border=1><tr><th>Course ID</th><th>Course Name</th><th>Startdate</th><th>Semester</th><th>Course Length</th><th>col1name</th><th>col2name</th><th>col3name</th><th>Color</th></tr>";
    
foreach ($db_handle->query("SELECT * from courses where courseID = '$courseID'") as $row){
        echo "<tr><td>$row[courseID]</td><td>$row[coursename]</td><td>$row[startdate]</td><td>$row[semester]</td><td>$row[courselength]</td><td>$row[col1name]</td><td>$row[col2name]</td><td>$row[col3name]</td><td>$row[colorscheme]</td></tr>";
}

 echo "</table>";

echo "<br>";

//DELETE COURSE AND ALL ITS DATA
echo"<form id='form1' method='POST' action='deleteCourse.php' style='color:red;'>
<input name='courseID' type='hidden' value='" . $courseID . "'>
<input name='group' type='hidden' value='" . $group . "'>
<input type='submit' name='submit' value='DELETE THIS COURSE'>
This button will delete the course and all its data.
</form>";



//USER COURSES TABLE
$query = $db_handle->query("SELECT * from usercourses WHERE courseID ='$courseID'");
 $result = $query->fetch(PDO::FETCH_ASSOC);
 
 echo"<b>This course is owned by:</b>" . $result['owner'] . "<br>"; 
 
 echo"<b>It can be edited by:</b>";
    
foreach ($query as $row){
        echo $row['userID'] . ", ";
}


echo "<br><br>";


//LESSONS TABLE

echo"<b>Lessons</b>";   
 echo "<table border=1><tr><th>Lesson ID</th><th>Course ID</th><th>Week Number</th><th>Lesson Title</th><th>Comments</th></tr>\n";
    
foreach ($db_handle->query("SELECT * from lessons WHERE courseID='$courseID'") as $row){
        echo "<tr><td>$row[lessonID]</td><td>$row[courseID]</td><td>$row[weeknum]</td><td>$row[lessontitle]</td><td>$row[lessoncomment]</td></tr>\n";
}

 echo "</table>\n";

echo "<br>";


//ASSIGNMENTS TABLE

echo"<b>Assignments</b>";   
 echo "<table border=1><tr><th>Assignment ID</th><th>Course ID</th><th>Week Number</th><th>Due Factor</th><th>Description</th><th>Display</th></tr>\n";
    
foreach ($db_handle->query("SELECT * from assignments WHERE courseID='$courseID'") as $row){
        echo "<tr><td>$row[assignID]</td><td>$row[courseID]</td><td>$row[weeknum]</td><td>$row[duedayfactor]</td><td>$row[descrip]</td><td>$row[displaydate]</td></tr>\n";
}

 echo "</table>\n";

echo"<br>";

//NOTES TABLE

 
echo"<b>Course Notes</b>";  
 echo "<table border=1><tr><th>Note ID</th><th>Course ID</th><th>Note</th></tr>\n";
    
foreach ($db_handle->query("SELECT * from coursenotes WHERE courseID='$courseID'") as $row){
        echo "<tr><td>$row[notesID]</td><td>$row[courseID]</td><td>$row[notes]</td></tr>\n";
}

 echo "</table>\n";



?>
</div>


</body>
</html>