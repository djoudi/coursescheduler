<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Schedule Creator</title>

<?php

$courseID = $_POST['courseID'];
$week = $_POST['week'];
 
    
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

<h2>Add Lesson to Week <?php echo $week; ?></h2>

<form id="form1" name="form1" method="post" action="writeLessons.php">
<input type="hidden" value="<?php echo $courseID; ?>" name="courseID">
<input type="hidden" value="<?php echo $week; ?>" name="week">
<div style="float:right;width:350px;font-size:.8em;">Bold<input name="bold" type="radio" value="bold" />Normal<input name="bold" type="radio" value="" checked/></div>
  Lesson Title:<br />
  <input type="text" name="lessontitle"  size="65"/><br />
  
 Comments:<br />
 <textarea name="lessoncomment" cols="64" rows="10"></textarea>
 <br />
 
 <input type="submit" value="Add Lesson" />
 
</form>

</div>
</body>
</html>
