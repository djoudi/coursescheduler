<html>
<head>
<title>Read Group Course Tables</title>
</head>
<body>

<?php

//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";

//USER COURSES TABLE
echo"<b>Users Courses</b>";
echo "<table border=1><tr><th>User ID</th><th>Course ID</th><th>Owner</th></tr>";
    
foreach ($db_handle->query("SELECT * from usercourses WHERE owner = 'kem32' ORDER BY courseID") as $row){
        echo "<tr><td>$row[userID]</td><td>$row[courseID]</td><td>$row[owner]</td></tr>";
}

 echo "</table>\n"; 

echo "<br>";

?>

</body>
</html>