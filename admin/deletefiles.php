<?php
//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');

$deletefiles = $_POST['deletefiles'];

$n = count($deletefiles);

if(empty($deletefiles)){
	 echo "<script LANGUAGE='JAVASCRIPT' TYPE='TEXT/JAVASCRIPT'>
	 alert('You did not select a file.');
	 </script>";
	 }else{
	 for($x=0; $x< $n; $x++){
	//change permission so file can be deleted
	if (!chmod($deletefiles[$x],0777)){echo "Fail chmod";}
		if(!unlink($deletefiles[$x])){
		echo "Failed to delete file";
		}
	}
 }
	 
//GO TO admin.php
$goto = "admin.php";
echo "<script> window.location.href = '$goto' </script>";

?>

