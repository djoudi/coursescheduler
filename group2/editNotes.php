<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$courseID = $_POST['courseID'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Notes</title>

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

<h2>Edit Notes for Course</h2>

<?php
//SELECT ALL NOTES FROM SPECIFIED COURSE 
foreach ($db_handle->query("SELECT * from coursenotes WHERE courseID='$courseID'") as $row){
echo "<div style='border:solid 1px;padding:5px;'>";
echo "<form  method='post' action='writeEditNotes.php'>";
echo "<input type='hidden' value='" . $row['notesID'] . "' name='notesID'>";
echo "<input type='hidden' name='courseID'  value='$courseID'>";
echo "Note:<br /><textarea name='notes' cols='60' rows='6'>" . strip_tags($row['notes']) . "</textarea><br />";
echo "<input type='submit' value='Save Changes' />"; 
echo "</form> ";
	echo "<form method='post' action='deleteNote.php'>";
	echo "<input type='hidden' value='" . $row['notesID'] . "' name='notesID'>";
	echo "<input type='hidden' name='courseID'  value='$courseID'>";
	echo "<input type='submit' value='Delete Note' /> </form></div><br>";
}
?>

</div>
</body>
</html>
