<?php
/*	
if(isset($_SERVER['REMOTE_USER'])){
	$userID = $_SERVER['REMOTE_USER'];
}else{
	echo "You do not have permission to view this site";
	exit();
	}
*/

$userID="srt142";
$userID=strtolower($userID);


// The file to be used as the database:
$databasefile = "../data/users";

if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
	exit;
    }	

//LOOP THROUGH USERS 
$isAllowed=0;
$x=0;
foreach ($db_handle->query("SELECT * from users") as $row){
	if($row['userID'] == $userID){
		$name = $row['firstname'] . " " . $row['lastname'];
		$groups = $row['groups'];
		$role = $row['role'];
		$isAllowed = 1; //set flag permision level user
		}
	$x++;
}

//CLOSE DATABASE
$db_handle=null;

//IF NOT USER THEN EXIT
if($isAllowed == 0){
echo "<div style='text-align:center;'><h3>You do not have permission to view this site.<br/>If you think this in error contact your site administrator.</h3></div>";
	exit();
	}


?>