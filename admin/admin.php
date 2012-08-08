<?php

//THIS INCLUDE FILE RETURNS $userID & $role
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
#container{margin:auto; width:800px;background-color:#FFFFFF;padding:15px;}
.style1{font-size:1.3em;font-weight:bold;margin-bottom:5px;}
.comment{margin:5px 15px;}
.box{padding:10px;border:solid 1px #660033;}
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

//GET USER INFO FROM USER TABLE
include('../dbconnectUsers.php');

echo"<div class='style1'>Course Scheduler Administration</div>";
echo"<div><strong>Admin: $name</strong></div>";
echo "<table border=1><tr><th>User ID</th><th>Name</th><th>Group</th><th>Role</th><th>Email</th><th>Last Login</th><th>Delete</th></tr>";
    
foreach ($db_handle->query("SELECT * from users") as $row){
        echo "<tr><td><a href='../group". $row['groups'] . "/userCourses.php?thisUser=" . $row['userID'] . "'>" .  $row['userID'] ."</a></td><td>" . $row['firstname'] . " " . $row['lastname'] . "</td><td>" . $row['groups'] . "</td><td>" . $row['role'] . "</td><td>" . $row['email'] . "</td><td>" . $row['lastlogin'] . "</td>";
        echo"<td><form name='deleteuser' method='post'  action='deleteUser.php'>
<input name='userID' type='hidden'  value='" . $row['userID'] . "'/>
<input name='groups' type='hidden'  value='" . $row['groups'] . "'/>
<input type='submit' value='Delete User'/>
</form></td></tr>";
        
}

 echo "</table>"; 

//CLOSE DATABASE
$db_handle=null;

echo"<a href='newAccount.php'>Add new user</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click userID to see courses created by user.<br><br>";

 
// GROUP 1 LISTING *****************************

// The file to be used as the database:
$databasefile = "../group1/data/coursescheduler";

if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
	exit;
    }
    
$x=0;

//GET COURSES
foreach ($db_handle->query("SELECT * from courses ORDER BY coursename") as $row){
	$coursedata[$x][0] = $row['courseID'];
	$coursedata[$x][1] = $row['coursename'];
	$coursedata[$x][2] = $row['semester'];

	$x++;
}  

//SAVE NUMBER OF COURSES FOUND FOR DISPLAY LOOP 
$numcourses=$x;

$db_handle=null;

?>


<strong>Group 1 Courses</strong>
<div class="box">
	<div style="float:right;font-size:.8em;"><a href="../group1/options.php">Group 1 Options Page</a><br/>
	<a href="readCalendarfiles.php?group=1">Saved HTML Files</a><br/>
	<a href="../group1/changebreakform.php">Change Spring or Fall Break</a><br/>
	</div>
<form id="group1" name="group1" method="post" action="courseData.php">
<div class="style3">Display Data Tables for Course from Group 1 <span style="font-size:.8em;">(<?php echo $numcourses; ?> Courses)</span></div>
<select name="courseID">

<?php
for($x=0;$x<$numcourses;$x++){
echo "<option value='" . $coursedata[$x][0] . "'>" . $coursedata[$x][1] . "</option>";
}
?>

</select>
<input name="group" type="hidden" value="1" />
<input type="submit" name="submit" value="GO" />
</form>
<br />

<p><a href="courseScheduleListing.php?group=1">Course Schedule Listing for Group 1</a></p>

</div>



</div>    
</body>
</html>
