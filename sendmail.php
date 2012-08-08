

<?php
  
  $message = $_POST['message'] ;
  $message = sqlite_escape_string($message);
  $message = strip_tags($message);
  $message = nl2br($message);
  $name = $_POST['name'];
  $userID = $_POST['userID'];
  
  $message= "Name: " .$name . "  UserID: " . $userID . "  Message: " . $message;
  
  mail( "srt142@psu.edu", "Course Schedule Account Request",
    $message );
    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECON 002 Course File Upload</title>

<style type="text/css">
body{background-color:#233A47;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto;background-color:#FFFFFF;width:520px;padding:10px;}
</style>


</head>
<body>
<div id="container">


<div align='center'><h3>Thank you. <br/>Your request has been submitted.</h3></div>

<script type="text/javascript">
setTimeout('goto()', 3000);
function goto()
history.go(-2);
</script>

 

</div>

</body>
</html>