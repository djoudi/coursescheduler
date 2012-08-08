<html>
<head>
<title>Read Group Course Tables</title>
</head>
<body>

<?php
//THIS INCLUDE FILE CONNECTS TO DATABASE
//AND ASSIGNS $userID FROM WEBACCESS
//ALSO ASSIGNS $role varaible FROM DATABASE
include "../validateUser.php";

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";


//COURSES TABLE

echo"<b>Courses</b>";   
 echo "<table border=1><tr><th>Course ID</th><th>Course Name</th><th>Startdate</th><th>Semester</th><th>Course Length</th><th>col1name</th><th>col2name</th><th>col3name</th><th>Color</th></tr>";
    
foreach ($db_handle->query("SELECT * from courses") as $row){
        echo "<tr><td>$row[courseID]</td><td>$row[coursename]</td><td>$row[startdate]</td><td>$row[semester]</td><td>$row[courselength]</td><td>$row[col1name]</td><td>$row[col2name]</td><td>$row[col3name]</td><td>$row[colorscheme]</td></tr>";
}

 echo "</table>";

echo "<br>";


//USER COURSES TABLE
echo"<b>Users Courses</b>";
echo "<table border=1><tr><th>User ID</th><th>Course ID</th><th>Owner</th></tr>";
    
foreach ($db_handle->query("SELECT * from usercourses ORDER BY userID") as $row){
        echo "<tr><td>$row[userID]</td><td>$row[courseID]</td><td>$row[owner]</td></tr>";
}

 echo "</table>\n"; 

echo "<br>";


//LESSONS TABLE

echo"<b>Lessons</b>";   
 echo "<table border=1><tr><th>Lesson ID</th><th>Course ID</th><th>Week Number</th><th>Lesson Title</th><th>Comments</th></tr>\n";
    
foreach ($db_handle->query("SELECT * from lessons WHERE courseID = 197 ORDER BY courseID") as $row){
        echo "<tr><td>$row[lessonID]</td><td>$row[courseID]</td><td>$row[weeknum]</td><td>$row[lessontitle]</td><td>$row[lessoncomment]</td></tr>\n";
}

 echo "</table>\n";

echo "<br>";


//ASSIGNMENTS TABLE

echo"<b>Assignments</b>";   
 echo "<table border=1><tr><th>Assignment ID</th><th>Course ID</th><th>Week Number</th><th>Due Factor</th><th>Description</th><th>Display</th></tr>\n";
    
foreach ($db_handle->query("SELECT * from assignments WHERE courseID = 197 ORDER BY courseID") as $row){
        echo "<tr><td>$row[assignID]</td><td>$row[courseID]</td><td>$row[weeknum]</td><td>$row[duedayfactor]</td><td>$row[descrip]</td><td>$row[displaydate]</td></tr>\n";
}

 echo "</table>\n";

echo"<br>";

//NOTES TABLE
/*
 
echo"<b>Course Notes</b>";  
 echo "<table border=1><tr><th>Note ID</th><th>Course ID</th><th>Note</th></tr>\n";
    
foreach ($db_handle->query("SELECT * from coursenotes") as $row){
        echo "<tr><td>$row[notesID]</td><td>$row[courseID]</td><td>$row[notes]</td></tr>\n";
}

 echo "</table>\n";
*/


?>

</body>
</html>