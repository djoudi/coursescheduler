<?php
//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$courseID = $_POST['courseID'];
$week = $_POST['week'];
$lessontitle = htmlentities($_POST['lessontitle'], ENT_QUOTES);
$bold = $_POST['bold'];
$lessoncomment = htmlentities($_POST['lessoncomment'], ENT_QUOTES);
$lessoncomment = nl2br($lessoncomment);

if($bold=="bold"){
$lessontitle="<b>" . $lessontitle . "</b>";
}


$query = $db_handle->exec("INSERT INTO lessons (courseID,weeknum,lessontitle, lessoncomment)VALUES ('$courseID','$week','$lessontitle','$lessoncomment')");

 if(!$query){
 echo "Failed";}


//GO TO newcourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";



?>
