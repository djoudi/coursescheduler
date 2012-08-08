<?php
//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$userID = $_POST['userID'];
$password = $_POST['password'];
$email = $_POST['email'];


$date=date("Y.m.d");

//NOTE THIS UPDATE IS SUCCESSFUL
$query1 = $db_handle->exec("UPDATE users SET password='$password', email = '$email' WHERE userID = '$userID'");


//GO TO options.php
$goto = "options.php";
echo "<script> window.location.href = '$goto' </script>";


?>
