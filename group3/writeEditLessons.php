<?php
//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$lessonID = $_POST['lessonID'];
$courseID = $_POST['courseID'];
$lessontitle = $_POST['lessontitle'];
$lessontitle = strip_tags($lessontitle);
$lessontitle = htmlentities($lessontitle, ENT_QUOTES);
$bold = $_POST['bold'];
$lessoncomment = htmlentities($_POST['lessoncomment'], ENT_QUOTES);
$lessoncomment = nl2br($lessoncomment);

if($bold =="bold"){
$lessontitle="<b>" . $lessontitle . "</b>";
}


$query = $db_handle->exec("UPDATE lessons SET lessontitle='$lessontitle', lessoncomment='$lessoncomment' WHERE lessonID = '$lessonID'");

if(!$query)echo "You fail";

//CLOSE DATABASE
$db_handle = null;

//GO TO newcourse.php
$goto = "editCourse.php?courseID=" . $courseID;
echo "<script> window.location.href = '$goto' </script>";

?>
