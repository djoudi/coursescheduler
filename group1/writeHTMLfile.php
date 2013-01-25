<?php
//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

$breakweeksfile = "../breakweeks.csv";
$fd = fopen($breakweeksfile, 'r');
$breakweeks1 = fread ($fd, filesize($breakweeksfile));
$breakweeks = explode(',', $breakweeks1);

$springbreak = $breakweeks[0];
$fallbreak = $breakweeks[1];

$courseID = $_POST['courseID'];



$page='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display Course Schedule</title>

<style type="text/css">
body{margin:0px;font-family:Verdana, Arial, Helvetica, sans-serif;}
table { background-color:#FFFFFF; }
#printlink{
	border:solid 1px #000;
	font-size:.8em;
	float:right;
	margin:4px 15px;
	background-color:#ffffff;
	padding:2px 3px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	}

a:link{
	color:#747474;
	text-decoration:none;
	}

';



 $query = $db_handle->query("SELECT * from courses WHERE courseID=$courseID");
    $result = $query->fetch(PDO::FETCH_ASSOC);

$start = $result['startdate'];
$startdate =$result['startdate'];
$courselength=$result['courselength'];
$coursename = $result['coursename'];
$semester = $result['semester'];
$col1name = $result['col1name'];
$col2name = $result['col2name'];
$col3name = $result['col3name'];
$scheme =$result['colorscheme'];

$yr = date('Y',$start);
$title = $coursename . " " . $semester . " Semester " . $yr;

//CREATE NICE FILENAME
$filename= $coursename ;
$filename = strtolower($filename);
$filename = str_replace(" ","",$filename);
$filename = preg_replace("/[^a-zA-Z0-9\s]/", "_", $filename);
$filename = trim($filename);
$filename = preg_replace('/\s\s+/', '_', $filename);

//ADD EXTENSION
$filename = $filename . ".html";


//FINAL PAGE URL
$server_addr = $_SERVER['SERVER_NAME'];
$file_location = $_SERVER['PHP_SELF'];
$file_location = str_replace("writeHTMLfile.php","",$file_location);//remove filename
$pageURL = "http://" . $server_addr . $file_location . "calendarfiles/" . $filename;

// IF ABOVE SCRIPT DOES NOT WORK YOU COULD COMMENT IT OUT AND
//HARD CODE THE $pageURL VARIABLE HERE TO MATCH YOUR SERVER URL
//$pageURL="http://SERVERURL/coursescheduler/group1/calendarfiles/" . $filename;

//WRITE FILE TO THIS RELATIVE PATH LOCATION
$filename = "calendarfiles/" . $filename ;




//COMPUTE STRINGS FOR WEEK DATES
for($weekcount=1; $weekcount <= $courselength; $weekcount++){
	$end = $start + 518400; //add six days
	$formatstart = date("n/d",$start) . " - ";
	$formatend = date("n/d/Y",$end);
	$week[$weekcount] = $formatstart . $formatend;
	$start = $end + 86400; //add one day
	}

//WRITE STYLING DEPENDING ON COLORSCHEME VALUE
if($scheme==1){
//SCHEME 1
$page= $page . "
body{background-color:#345590;color:#333333;}
.shading{background-color:#ECECEC;}
.coursenotes{color:#E3EAF6;}
.comment{color:#940000;font-size:.9em;margin-left:15px;}
#tableborder{border: 2px solid #345590;padding:0px;margin:15px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;color:#FFFFFF;}
.colnames{background-color:#8B9EBE;font-weight:bold;border-bottom: 2px solid #345590;}";

}elseif($scheme==2){
//SCHEME 2 IVY
$page= $page ."
body{background-color:#679A67;color:#043704;}
.shading{background-color:#E1E7E1;}
.coursenotes{color:#E7EFE7;}
.comment{color:#728F72;font-size:.9em;margin-left:10px;}
#tableborder{border: 2px solid #000000;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;color:#FFFFFF;}
.colnames{background-color:#728F72;font-weight:bold;border-bottom: 2px solid #000000;}";
}

elseif($scheme==3){
//SCHEME 3 CANADA
$page= $page ."
body{background-color:#B20E32;color:#000000;}
.shading{background-color:#E5E5E5;}
.coursenotes{color:#E3EAF6;}
.comment{color:#990033;font-size:.9em;margin-left:10px;}
#tableborder{border: 2px solid #000000;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;color:#FFFFFF;}
.colnames{background-color:#A3A1A1;font-weight:bold;}";}

elseif($scheme==4){
//SCHEME 4 Citrus
$page= $page ."
body{background-color:#EE5F0C;color:#000000;}
.shading{background-color:#FCF9DB;}
.coursenotes{color:#FCE5D8;}
.comment{color:#79AC1E;font-size:.9em;margin-left:10px;}
#tableborder{border: 2px solid #79AC1E;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;color:#FFFFFF;}
.colnames{background-color:#F9F2AE;font-weight:bold;}";}

elseif($scheme==5){
//SCHEME 5 Spanish
$page= $page ."
body{background-color:#ECE0C8;color:#000000;}
.shading{background-color:#F4ECDE;}
.coursenotes{color:#998F7B;}
.comment{color:#EE5F0C;font-size:.9em;margin-left:10px;}
#tableborder{border: 2px solid #000000;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;}
.colnames{background-color:#998F7B;font-weight:bold;color:#FFFFFF;}";}



$page= $page . "</style>";

//JAVASCRIPT FOR PRINT WINDOW
$page= $page . '<SCRIPT LANGUAGE="JAVASCRIPT" TYPE="TEXT/JAVASCRIPT">
<!--hide script from old browsers

function printWindow(){
	printWindow=window.open("' . $pageURL . '","printWindow", "width=800,height=500,scrollbars");
}

function pageLoaded(){
	if(window.name == "printWindow"){
	document.getElementById("printlink").innerHTML ="Print This Page";
	document.getElementById("printlink").href= "javascript:window.print();"
	}
}

//-->
</script>';


$page= $page . "</head><body onload=pageLoaded();>";

$page= $page . "<a id='printlink' href='javascript:printWindow()'>Print Friendly Version</a>";

$page= $page .  "<h1 id='coursetitle'>Course Calendar for " . $coursename .  "</h1>";

//SELECT ALL NOTES FROM SPECIFIED COURSE 
foreach ($db_handle->query("SELECT * from coursenotes WHERE courseID='$courseID'") as $row){
	$page= $page .  "<div class='coursenotes' style='margin-left:30px;margin-bottom:3px;'>" . $row['notes'] . "</div>";
}


$page= $page .  "<div id='tableborder'>";
$page= $page .  "<table  summary='Listing of lessons and due dates of assignments.' width='100%' cellpadding='5' border='0'>";
$page= $page .  "<tr class='colnames'><th>$col1name</th><th>$col2name</th><th>$col3name</th></tr>";
for($weekcount=1;$weekcount <= $courselength; $weekcount++){
	//SHADING FOR ALTERNATING ROWS
	if ($weekcount % 2 == 0 ){
		$page= $page .  "<tr class='shading'>";
	}else{
		$page= $page .  "<tr>";
	}
	//PRINT WEEK DATES
	//$page= $page .  "<td width='160' valign='top'><b>Week $weekcount</b> <br>$week[$weekcount]</td>";
	
	if(($semester=="Spring") && ($weekcount == $springbreak)){
		$page= $page . "<td width='160' valign='top'><br>$week[$weekcount]</td>";
		}elseif(($semester=="Spring") && ($weekcount > $springbreak)){
			$weekadjusted=$weekcount-1;
			$page= $page . "<td width='160' valign='top'><b>Week $weekadjusted</b> <br>$week[$weekcount]</td>";
		}elseif(($semester=="Fall") && ($weekcount == $fallbreak)){
			$page= $page . "<td width='160' valign='top'><br>$week[$weekcount]</td>";
		}elseif(($semester=="Fall") && ($weekcount> $fallbreak)){
			$weekadjusted=$weekcount-1;
			$page= $page . "<td width='160' valign='top'><b>Week $weekadjusted</b><br>$week[$weekcount]</td>";
		}else{
			$page= $page . "<td width='160' valign='top'><b>Week $weekcount</b> <br>$week[$weekcount]</td>";
	 }		
	
	//PRINT ROW FOR FALL OR SPRING BREAKS
	if(($semester=="Spring") && ($weekcount== $springbreak)){
		$page= $page .  "<td width='350'><b>Spring Break!!</b></td><td></td></tr>";
	}elseif(($semester=="Fall") && ($weekcount== $fallbreak)){
		$page= $page .  "<td width='250'><b>Thanksgiving Break!!</b></td><td></td></tr>";
	}else{	
	
	//GET LESSON TITLES
	$page= $page .  "<td width='350' valign='top'>";
	foreach ($db_handle->query("SELECT * from lessons WHERE courseID='$courseID' AND weeknum='$weekcount'") as $row){
	$page= $page .  "<div class='title'>" . $row['lessontitle'] . "<div>";
	if($row['lessoncomment']!="") $page= $page .  "<div class='comment'>" . $row['lessoncomment'] . "</div>";
	}
	 $page= $page .  "</td>";
	
//GET ASSIGNMENTS
	$page= $page .  "<td width='*' valign='top'>";
	foreach ($db_handle->query("SELECT * from assignments WHERE courseID='$courseID' AND weeknum='$weekcount' ORDER BY duedayfactor ASC") as $row){
	$baseAssignDate = $startdate + $row['duedayfactor'];
	$assignDate = date("l n/d/Y",$baseAssignDate);
if($row['displaydate']!= "nodate"){
	$page= $page .  "<b>". $row['displaydate'] . " " . $assignDate . "</b><br>";}
	$page= $page .  $row['descrip'] . "<br>";
	}
	$page= $page .  "</td></tr>";
}
}
$page= $page .  "</table></div>";


$page= $page . "</body></html>";

$fp = fopen("$filename", "w");
if (!$fp) die ("Cannot open file");

fwrite($fp, $page);
fclose($fp);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Schedule Creator</title>


<style type="text/css">
body{background-color:#3A4F5A;font-family:Verdana, Arial, Helvetica, sans-serif;}
#container{margin:auto; width:800px;background-color:#FFFFFF;padding:15px;}
.style1{font-size:1.3em;font-weight:bold;margin-bottom:5px;}
.comment{margin-top:5px;}

#form3{padding:10px;border:solid 1px #660033;}
.style2 {color: #CC6600;margin-left:25px;margin-bottom:5px;}
.style3 {
	color: #CC6600
}
</style>


</head>

<body>
<div id="container">

<?php

echo"<h3>Your calendar/schedule has been saved as an HTML page to this URL:</h3>";
echo "<a href=" .$pageURL . ">" . $pageURL . "</a><br>";
?>
<br/>To display this page under the calendar tab in Angel:<br/>
<blockquote><ul><li>Go to Manage > Tab Settings</li>
<li>Paste this URL in provided box next to Tab ID-Calendar</li>
<li>Save</li></ul></blockquote>
This file will remain until the course schedule is deleted. It is overwritten each time the schedule is Saved as HTML Page. Editing the schedule will not effect this page until it is Saved again.
<br/><br/>
<div style="text-align:center;"><a href="options.php">Return to Options page.</a></div>
</div>
</body>
</html>