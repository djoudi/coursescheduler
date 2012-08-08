<?php
//THIS INCLUDE FILE GIVES $userID & $role
include ("../validateUser.php");

//IS ADMIN?
include('validateAdmin.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Course Scheduler New Account</title>
<style type="text/css">
body{background-color:#3A4F5A;font-family:Verdana, Arial, Helvetica, sans-serif;}

#container{margin:auto;background-color:#FFFFFF;width:430px;padding:10px;}

.smallorange{font-size:.8em;color:#CC6600;margin-bottom:8px;margin-left:8px;}
</style>

<?php
//connect to users db
include('../dbconnectUsers.php');

//CREATE JAVASCRIPT ARRAY
echo"<script LANGUAGE='JAVASCRIPT' TYPE='TEXT/JAVASCRIPT'>";
echo"var users = new Array();";

//LOOP THROUGH USERS - PLACE IN JAVASCRIPT ARRAYS
$x=0;
foreach ($db_handle->query("SELECT * from users") as $row){
	echo"users[" . $x . "]='" . $row['userID'] ."';";
	$x++;
}
echo "var allusers = users.length;";
?>


function checkit(){

	var x = 0;
	for(x=0;x < allusers; x++){
	if(document.forms[0].elements[0].value== users[x]){
	alert('This User ID has been previously selected. Please choose a different User ID.');
	return false;
	}
	}

return true;
}


</script>

</head>
<body>
<div id="container">
<h3>Course Scheduler New Account</h3>


<form style="margin:auto;border: 1px solid #000099;padding:10px;width:380px;text-align:left;" name="register" method="post" onsubmit="return checkit()" action="writeNewAccount.php">
<strong>Create New Account</strong><br />
<p>PSU User ID: <input name="userID" type="text" size="20"/></p>

<p>Firstname: <input name="firstname" type="text" size="20"/></p>

<p>Lastname: <input name="lastname" type="text" size="20"/></p>

Group: 
<select name="groups">
<option value="1">Group 1</option>
<!--<option value="2">Group 2</option>
<option value="3">Group 3</option>-->
</select>
<div class="smallorange">You can only share files with other members within the same group.</div><br/>

Role:
<select name="role">
<option value="instructor">Instructor</option>
<option value="admin">Admin</option>
</select>
<br/><br/>
<input type="submit" value="Create New Account"/>
</form>


</div>

</body>
</html>


