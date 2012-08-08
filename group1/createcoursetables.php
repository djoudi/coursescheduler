<html>
<body>

<?php
echo"This file is run on set up of this software to set up initial tables in the database. Running this deletes all information in any existing course tables. As a precaution comment tags have been inserted to prevent accidental deletion. If you are certain you want to run this file you must open the file in a text editor and delete the comment tags and save the file before running it from your browser.";

/*
//CONNECT TO COURSESHCEDULER DB
include "../dbconnectSchedules.php";


//CREATE courses TABLE
$query1 = $db_handle->exec( "DROP TABLE courses");
$query2 = $db_handle->exec("CREATE TABLE courses (courseID integer primary key,coursename varchar(150), startdate int, semester varchar, courselength int, col1name varchar, col2name varchar, col3name varchar, colorscheme int)");
$query3 = $db_handle->exec( "INSERT INTO courses (coursename,startdate,semester,courselength,col1name,col2name,col3name,colorscheme)VALUES ('Sample Course Schedule','1200330000','Spring',16,'DATES','LESSONS','ASSIGNMENTS','1')");
   
echo "The COURSES table is created.<br>";

//CLEAR QUERY
$query1=null;
$query2=null;
$query3=null;

//CREATE USER COURSES TABLE
$query1 = $db_handle->exec("DROP TABLE usercourses");
$query2 = $db_handle->exec("CREATE TABLE usercourses (userID varchar, courseID integer(5), owner varchar)");

$query3 = $db_handle->exec("INSERT INTO usercourses (userID,courseID,owner)VALUES ('admin1','1','admin')");

echo "The USER table has been created.<br>";

//CLEAR QUERY
$query1=null;
$query2=null;
$query3=null;

//CREATE lessons TABLE
$query1 = $db_handle->exec("DROP TABLE lessons");

$query2 = $db_handle->exec("CREATE TABLE lessons (lessonID integer primary key,courseID integer, weeknum integer, lessontitle varchar, lessoncomment varchar)");
$query3 = $db_handle->exec("INSERT INTO lessons (courseID,weeknum,lessontitle, lessoncomment)VALUES (1,1,'Lesson 1 How to Begin','This is the easy part')");
 
echo "The LESSONS table has been created.<br>";

//CLEAR QUERY
$query1=null;
$query2=null;
$query3=null;


//CREATE assignments TABLE
$query1 = $db_handle->exec("DROP TABLE assignments");

$query2 = $db_handle->exec("CREATE TABLE assignments (assignID integer primary key,courseID integer, weeknum integer, duedayfactor integer, descrip text,displaydate varchar)");
$query3 = $db_handle->exec("INSERT INTO assignments (courseID,weeknum,duedayfactor, descrip, displaydate)VALUES (1,1,'950400','Lesson 1 Quiz', 'Due')");

echo "The ASSIGNMENTS table is created.<br>";

//CLEAR QUERY
$query1=null;
$query2=null;
$query3=null;

//CREATE coursenotes TABLE
$query1 = $db_handle->exec("DROP TABLE coursenotes");

$query2 = $db_handle->exec("CREATE TABLE coursenotes (notesID integer primary key,courseID integer, notes text)");
$query3 = $db_handle->exec("INSERT INTO coursenotes (notesID,courseID,notes)VALUES (1,1,'This is a note for the course')");

echo "The COURSENOTES table is created.";
*/
?>

</body>
</html>