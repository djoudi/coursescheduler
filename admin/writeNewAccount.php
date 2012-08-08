<?php

//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');

$userID = $_POST['userID'];
$userID = strtolower($userID);
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$groups = $_POST['groups'];
$role = $_POST['role'];
$email = $userID . "@psu.edu";

//connect to users db
include('../dbconnectUsers.php');

$date=date("Y.m.d");

$query1 = $db_handle->exec("INSERT INTO users (userID, firstname, lastname, groups,role, email,lastlogin)VALUES ('$userID', '$firstname', '$lastname', '$groups', '$role', '$email','$date')");


$databasefile = "../group" . $groups . "/data/coursescheduler";

if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
echo "no connection";
	exit;
    }
    
//GIVE NEW ACCOUNT ACCESS TO SAMPLE COURSE
$query2 = $db_handle->exec("INSERT INTO usercourses (userID,courseID, owner)VALUES ('$userID','1','admin')");

//GO TO admin.php
$goto = "admin.php";
echo "<script> window.location.href = '$goto' </script>";


?>
