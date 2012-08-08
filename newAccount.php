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

// The file to be used as the database:
$databasefile = "data/users";

if(! $db_handle = new PDO("sqlite:$databasefile")){
   echo $sqlite_error;
	exit;
    }	

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


//JAVASCRIPT FUNCTIONS

//FUNCTION CALLED ON SUBMIT
echo"
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
";

?>


</script>

</head>
<body>
<div id="container">
<h3>Course Schedule Creator</h3>


<form style="margin:auto;border: 1px solid #000099;padding:10px;width:380px;text-align:left;" name="register" method="post" onsubmit="return checkit()" action="writeNewAccount.php">
<strong>Create New Account</strong><br />
User ID: <input name="userID" type="text" size="20"/>
<div class="smallorange">This will be used by others to share files with you. For convenience you could use your PSU User ID but there is no connection to PSU's user/password system.</div>

Group: 
<select name="groups">
<option value="1">Liberal Arts Outreach</option>
<!--THESE OPTIONS WHICH WOULD BE GROUP1 AND GROUP2 ARE REMOVED UNTIL NEEDED.
<option value="2">Individual</option>
<option value="3">Other</option>
-->

</select>
<div class="smallorange">You can only share files with other members within the same group.</div>
<input type="submit" value="Create New Account"/>
</form>


</div>

</body>
</html>


