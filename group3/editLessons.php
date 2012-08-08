<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$courseID = $_POST['courseID'];
$week = $_POST['week'];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Lessons</title>

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

<h2>Edit Lesson to Week <?php echo $week; ?></h2>

<?php

//SELECT ALL LESSONS FROM SPECIFIED COURSE AND WEEK
foreach ($db_handle->query("SELECT * from lessons WHERE courseID='$courseID' AND weeknum='$week'") as $row){
echo "<div style='border:solid 1px;padding:5px;'>";
echo "<form  method='post' action='writeEditLessons.php'>";
echo "<input type='hidden' value='" . $row['lessonID'] . "' name='lessonID'>";
echo "<input type='hidden' name='courseID'  value='$courseID'>";
echo " <div style='float:right;width:350px;font-size:.8em;'>";

if(preg_match("<b>",$row['lessontitle'])){
echo"Bold<input name='bold' type='radio' value='bold' checked/>";
echo"Normal<input name='bold' type='radio' value=''/></div>";
}else{
echo"Bold<input name='bold' type='radio' value='bold'/>";
echo"Normal<input name='bold' type='radio' value='' checked/></div>";
}

echo "Lesson Title:<br> <input type='text' name='lessontitle'  size='40' value='" . strip_tags($row['lessontitle']) . " '><br>";
echo "Comments:<br /><textarea name='lessoncomment' cols='60' rows='6'>" . strip_tags($row['lessoncomment']) . "</textarea><br />";
echo "<input type='submit' value='Save Changes' />"; 
echo "</form> ";
	echo "<form method='post' action='deleteLessons.php'>";
	echo "<input type='hidden' value='" . $row['lessonID'] . "' name='lessonID'>";
	echo "<input type='hidden' name='courseID'  value='$courseID'>";
	echo "<input type='submit' value='Delete Lesson' /> </form></div><br>";
}
?>

</div>
</body>
</html>
