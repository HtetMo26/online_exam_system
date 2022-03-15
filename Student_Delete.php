<?php  
session_start();
include('connect.php');

$StudentID=$_GET['StudentID'];

$Delete="DELETE FROM Student WHERE StudentID='$StudentID' ";
$result=mysqli_query($connection,$Delete);

if ($result) 
{
	echo "<script>window.alert('Student Acccount Successfully Deleted.')</script>";
	echo "<script>window.location='Student_Profiles.php'</script>";
}
else
{
	echo "<p>Something went wrong in Student Delete " . mysqli_error($connection) . "</p>";
}
?>