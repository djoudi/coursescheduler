<?php
//THIS PAGE DETERMINES WHICH GROUP THE USER BELONGS TO AND DIRECTS TO
//THAT FOLDER

/*

//FORCE HTTPS
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);   
}


if(isset($_SERVER['REMOTE_USER'])){
	$userID = $_SERVER['REMOTE_USER'];
}else{
	echo "You do not have permission to view this site";
	exit();
	}
*/

$userID="admin";

// The file to be used as the database:
$databasefile = "data/users";

if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
	exit;
    }	


//LOOP THROUGH USERS 
$isAllowed=0;
$x=0;
foreach ($db_handle->query("SELECT * from users") as $row){
	if($row['userID'] == $userID){
		$groups=$row['groups'];
		$isAllowed = 1; //set flag permision level user
		}
	$x++;
}



//IF NOT USER THEN EXIT
if($isAllowed ==0){
header("Refresh: 3; URL=index.php");
echo"<div align='center'><h3>That UserID is not registered. Check UserID or Request New Account.</h3><div>";

	exit();
	}


$date= date("Y.m.d");
//echo $date;
$query1 = $db_handle->exec("UPDATE users SET lastlogin ='$date' WHERE userID = '$userID'");
if(!$query1){echo"no update" . "<br>";}


//close the database connection
    $db_handle = null;


//GO TO options.php
$goto = "group" . $groups . "/options.php";
echo "<script> window.location.href = '$goto' </script>";



?>
