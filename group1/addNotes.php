<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Schedule Creator</title>

<?php

$courseID = $_POST['courseID'];
 
    
?>

<style type="text/css">
body{background-color:#CCCC99;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto; width:600px;background-color:#FFFFFF;padding:15px;}
.style1{font-size:1.2em;font-weight:bold;margin-bottom:5px;}
.comment{margin-top:5px;}
#form1{padding:10px;border:solid 1px #660033;}
.style2 {color: #CC6600;margin-left:25px;margin-bottom:5px;}
</style>
</head>

<body>
<div id="container">

<h2>Add Note Beneath Course Title </h2>

<form id="form1" name="form1" method="post" action="writeNotes.php">
<input type="hidden" value="<?php echo $courseID; ?>" name="courseID">
   
 New note:<br />
 <textarea name="notes" cols="60" rows="10"></textarea>
 <br />
 
 <input type="submit" value="Add Note" />
 
</form>

</div>
</body>
</html>
