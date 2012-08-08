<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display Course Schedule</title>

<style type="text/css">
body{margin:0px;font-family:Verdana, Arial, Helvetica, sans-serif;}
table { background-color:#FFFFFF; }

<?php

//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";


$courseID = $_POST['courseID'];


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
$title = $coursename ;

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
echo"
body{background-color:#345590;color:#333333;}
.shading{background-color:#ECECEC;}
.coursenotes{color:#E3EAF6;}
.comment{color:#940000;font-size:.9em;margin-left:15px;}
#tableborder{border: 2px solid #345590;padding:0px;margin:15px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;color:#FFFFFF;}
.colnames{background-color:#8B9EBE;font-weight:bold;border-bottom: 2px solid #345590;}";

}elseif($scheme==2){
//SCHEME 2 IVY
echo"
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
echo"
body{background-color:#B20E32;color:#000000;}
.shading{background-color:#E5E5E5;}
.coursenotes{color:#E3EAF6;}
.comment{color:#990033;font-size:.9em;margin-left:10px;}
#tableborder{border: 2px solid #000000;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;color:#FFFFFF;}
.colnames{background-color:#A3A1A1;font-weight:bold;}";}

elseif($scheme==4){
//SCHEME 4 Citrus
echo"
body{background-color:#EE5F0C;color:#000000;}
.shading{background-color:#FCF9DB;}
.coursenotes{color:#FCE5D8;}
.comment{color:#79AC1E;font-size:.9em;margin-left:10px;}
#tableborder{border: 2px solid #79AC1E;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;color:#FFFFFF;}
.colnames{background-color:#F9F2AE;font-weight:bold;}";}

elseif($scheme==5){
//SCHEME 5 Spanish
echo"
body{background-color:#ECE0C8;color:#000000;}
.shading{background-color:#F4ECDE;}
.coursenotes{color:#998F7B;}
.comment{color:#EE5F0C;font-size:.9em;margin-left:10px;}
#tableborder{border: 2px solid #000000;padding:0px;margin:10px;}
#coursetitle{font-size:1.3em;font-weight:bold;margin-left:15px;margin-top:10px;margin-bottom:5px;}
.colnames{background-color:#998F7B;font-weight:bold;color:#FFFFFF;}";}



echo"</style></head><body>";

echo "<div id='coursetitle'>" . $title .  "</div>";

//SELECT ALL NOTES FROM SPECIFIED COURSE 
foreach ($db_handle->query("SELECT * from coursenotes WHERE courseID='$courseID'") as $row){
	echo "<div class='coursenotes' style='margin-left:30px;margin-bottom:3px;'>" . $row['notes'] . "</div>";
}


echo "<div id='tableborder'>";
echo "<table  width='100%' cellpadding='5' border='0'>";
echo "<tr class='colnames'><th>$col1name</th><th>$col2name</th><th>$col3name</th></tr>";
for($weekcount=1;$weekcount <= $courselength; $weekcount++){
	//SHADING FOR ALTERNATING ROWS
	if ($weekcount % 2 == 0 ){
		echo "<tr class='shading'>";
	}else{
		echo "<tr>";
	}
	//PRINT WEEK DATES
	//echo "<td width='160' valign='top'><b>Week $weekcount</b> <br>$week[$weekcount]</td>";
	
	//PRINT WEEK DATES
	//THIS REPLACES ABOVE TO CHANGE WEEK NUMBER LABELING
	if(($semester=="Spring") && ($weekcount==9)){
		echo "<td width='160' valign='top'><br>$week[$weekcount]</td>";
		}elseif(($semester=="Spring") && ($weekcount>9)){
			$weekadjusted=$weekcount-1;
			echo "<td width='160' valign='top'><b>Week $weekadjusted</b> <br>$week[$weekcount]</td>";
		}elseif(($semester=="Fall") && ($weekcount==14)){
			echo "<td width='160' valign='top'><br>$week[$weekcount]</td>";
		}elseif(($semester=="Fall") && ($weekcount>14)){
			$weekadjusted=$weekcount-1;
			echo "<td width='160' valign='top'><b>Week $weekadjusted</b><br>$week[$weekcount]</td>";
		}else{
			echo "<td width='160' valign='top'><b>Week $weekcount</b> <br>$week[$weekcount]</td>";
	 }		
	
	//PRINT ROW FOR FALL OR SPRING BREAKS
	if(($semester=="Spring") && ($weekcount==9)){
		echo "<td width='350'><b>Spring Break!!</b></td><td></td></tr>";
	}elseif(($semester=="Fall") && ($weekcount==14)){
		echo "<td width='250'><b>Thanksgiving Break!!</b></td><td></td></tr>";
	}else{	
	
	//GET LESSON TITLES
	echo "<td width='350' valign='top'>";
	foreach ($db_handle->query("SELECT * from lessons WHERE courseID='$courseID' AND weeknum='$weekcount'") as $row){
	echo "<div class='title'>" . $row['lessontitle'] . "<div>";
	if($row['lessoncomment']!="") echo "<div class='comment'>" . $row['lessoncomment'] . "</div>";
	}
	 echo "</td>";
	
//GET ASSIGNMENTS
	echo "<td width='*' valign='top'>";
	foreach ($db_handle->query("SELECT * from assignments WHERE courseID='$courseID' AND weeknum='$weekcount' ORDER BY duedayfactor ASC") as $row){
	$baseAssignDate = $startdate + $row['duedayfactor'];
	$assignDate = date("l n/d/Y",$baseAssignDate);
if($row['displaydate']!= "nodate"){
	echo "<b>". $row['displaydate'] . " " . $assignDate . "</b><br>";}
	echo $row['descrip'] . "<br>";
	}
	echo "</td></tr>";
}
}
echo "</table></div>";

?>

</body>
</html>