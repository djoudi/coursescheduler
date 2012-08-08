<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Schedule Creator</title>

<?php
//THIS INCLUDE FILE RETURNS $userID & $role
include ("../validateUser.php");

$courseID = $_POST['courseID'];
$week = $_POST['week'];
$weekdates = $_POST['weekdates'];
$current_year = $_POST['current_year'];
	    
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

<div> <span style="font-size:1.4em;">Add Assignment to Week <?php echo $week . " </span><span style='font-size:1.0em;'>" . $weekdates . "</span>";?></div>

<form id="form1" name="form1" method="post" action="writeAssignment.php">
<input type="hidden" value="<?php echo $courseID; ?>" name="courseID">
<input type="hidden" value="<?php echo $week; ?>" name="week">
Date:
<select name="month">
<option value=01>January</option>
<option value=02>February</option>
<option value=03>March</option>
<option value=04>April</option>
<option value=05>May</option>
<option value=06>June</option>
<option value=07>July</option>
<option value=08>August</option>
<option value=09>September</option>
<option value=10>October</option>
<option value=11>November</option>
<option value=12>December</option>
</select>
<select name="day">
<option value=01>1</option>
<option value=02>2</option>
<option value=03>3</option>
<option value=04>4</option>
<option value=05>5</option>
<option value=06>6</option>
<option value=07>7</option>
<option value=08>8</option>
<option value=09>9</option>
<option value=10>10</option>
<option value=11>11</option>
<option value=12>12</option>
<option value=13>13</option>
<option value=14>14</option>
<option value=15>15</option>
<option value=16>16</option>
<option value=17>17</option>
<option value=18>18</option>
<option value=19>19</option>
<option value=20>20</option>
<option value=21>21</option>
<option value=22>22</option>
<option value=23>23</option>
<option value=24>24</option>
<option value=25>25</option>
<option value=26>26</option>
<option value=27>27</option>
<option value=28>28</option>
<option value=29>29</option>
<option value=30>30</option>
<option value=31>31</option>
</select>
<select name="year">
<?php
	
echo "<option value='" . $current_year . "'>" . $current_year . "</option>";
	
?>

</select>  

<span class="style2">Display date as </span>
<select name="displaydate">
<option value="Due" selected>Due</option>
<option value="On">On</option>
<option value="Available">Available</option>
<option value="Beginning">Beginning</option>
<option value="Ending">Ending</option>
<option value="">No prefix</option>
<option value="nodate">No date displayed</option>
</select>
<br><br>

<?php
echo "<div style='float:right;width:250px;font-size:.8em;'>Text Styles";
echo"<input type='checkbox' name='textstyle[]' value='bold'/><strong>Bold</strong> &nbsp;&nbsp;";
echo"<input type='checkbox' name='textstyle[]' value='red'/><span style='color:#CC0000;'>Red</span> &nbsp;&nbsp;";
echo"<input type='checkbox' name='textstyle[]' value='italic'/><i>Italic </i>";
echo"</div>";
?>
  
 Assignment Description:<br />
 <textarea name="descrip" cols="70" rows="5"></textarea>
 <br />
 
 <input type="submit" value="Add Assignment" />
 
</form>

</div>
</body>
</html>
