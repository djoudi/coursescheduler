<?php

//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');

$userID = $_POST['userID'];
$groups = $_POST['groups'];

//DELETE USERID FROM USERS TABLE 

include('../dbconnectUsers.php');


$query1 = $db_handle->exec("DELETE FROM users WHERE userID = '$userID'");
if(!$query1){echo"no go";}

$db_handle = null;

//DELETE USERID FROM USERCOURSES TABLE 
// The file to be used as the database:
$databasefile = "../group" . $groups . "/data/coursescheduler";


if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
	exit;
    }
    
$query1 = $db_handle->exec("DELETE FROM usercourses WHERE userID = '$userID'");
if(!$query1){echo"no go";}

$db_handle = null;


//GO TO options.php
$goto = "admin.php";
echo "<script> window.location.href = '$goto' </script>";


?>
