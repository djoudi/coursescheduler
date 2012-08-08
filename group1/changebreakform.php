<!DOCTYPE html>
<?php 



$breakweeksfile = "../breakweeks.csv";
$fd = fopen($breakweeksfile, 'r');
$breakweeks1 = fread ($fd, filesize($breakweeksfile));
$breakweeks = explode(',', $breakweeks1);

$currentspringbreak = $breakweeks[0];
$currentfallbreak = $breakweeks[1];


?>


<html lang="en">
<head>
<meta charset="utf-8" />
<title></title>

<style type="text/css">
body{background-color:#3A4F5A;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto; width:800px;background-color:#FFFFFF;padding:15px;}
</style>

</head>

<body>
<div id="container">
<div style='float:right;'><a href="../admin/admin.php">Return to Admin</a></div>
<h3>Course Scheduler</h3>

<strong>Changing the Week Placement of Fall or Spring Breaks</strong><br/>
This software inserts either a Fall or Spring Break week if either of those semesters are chosen. To do this all dated assignments must be modified programmatically. Almost always PSU's Spring break is at week 9 and Fall break is at week 14. Initially this was hard coded into the software. In 2012, because there are 5 Thursdays in November, Fall break fell in the 13 week. This script makes it possible to change the week placement for these breaks.
<br/><br/> 

The current Spring Break is at Week <?php echo $currentspringbreak; ?><br/>

The current Fall Break is at Week <?php echo $currentfallbreak; ?><br/><br/>

<form method="post" action="changebreak.php">

<strong>Change only one semester value at a time.</strong><br/>
Spring Break <input type="text" name="changespringbreak" value="<?php echo $currentspringbreak; ?>"/>
<br/>
Fall Break<input type="text" name="changefallbreak" value="<?php echo $currentfallbreak; ?>"/><br/>
<input type="submit" value="Update Files to New Break Schedule">
</form>

</div>
</body>
</html>