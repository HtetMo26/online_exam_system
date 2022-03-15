<?php  
session_start();
include('connect.php');

if(isset($_POST['btnRegister'])) 
{
	$txtName=$_POST['txtName'];
	$txtEmail=$_POST['txtEmail'];
	$txtUsername=$_POST['txtUsername'];
	$txtPassword=$_POST['txtPassword'];
	$txtAddress=$_POST['txtAddress'];
    $txtPhoneNo=$_POST['txtPhoneNo'];
    $txtGrade=$_POST['txtGrade'];                                                                                               
    $rdoGender=$_POST['rdoGender'];

    //Image Upload Code--------------------------------------------------------------------
	$FilUserImage=$_FILES['FilUserImage']['name']; //***.jpg
	$Folder="UserImage/";
	

	$FileName=$Folder . '_' . $FilUserImage; // UserImage/_***.jpg

	$copied=copy($_FILES['FilUserImage']['tmp_name'], $FileName);

		if(!$copied) 
		{
			echo "<p>Profile Image Cannot Be Uploaded.</p>";
			exit();
		}

		//Check Student Email already exit or not------------------------------------------------
		$check="SELECT * FROM Student
				WHERE Email='$txtEmail' ";
		$result=mysqli_query($connection,$check);
		$count=mysqli_num_rows($result);

			if ($count > 0 ) 
			{
				echo "<script>window.alert('This Email Address $txtEmail Already Exists!')</script>";
				echo "<script>window.location='Student_Register.php'</script>";
				exit();
			}
			
			//Insert Student Data to Student Table-----------------------------------------------------
			$query="INSERT INTO Student
					(Name,Email,Username,Password,Address,PhoneNo,Grade,Gender,ProfilePicture)
					VALUES 
					('$txtName','$txtEmail','$txtUsername','$txtPassword','$txtAddress','$txtPhoneNo','$txtGrade','$rdoGender','$FilUserImage')";
			$result=mysqli_query($connection,$query);

				if ($result) 
				{
					echo "<script>window.alert('Student Acccount Successfully Created.')</script>";
					echo "<script>window.location='Student_Login.php'</script>";
				}
				else
				{
					echo "<p>Something went wrong. Try again. " . mysqli_error($connection) . "</p>";
				}
	}

?>

<!DOCTYPE html>
<html>
	<head>
	<title>Student Account Creation</title>
	</head>
		<body>
			<form action="Student_Register.php" method="post" enctype="multipart/form-data">
				<fieldset>
				<legend>Enter Your Information :</legend>
					<table cellpadding="4px">
					<tr>
						<td>Name</td>
						<td>
							<input type="text" name="txtName" placeholder="Full Name" required />
						</td>
						</tr>
						<tr>
						<td>Gmail</td>
						<td>
						<input type="email" name="txtEmail" placeholder="***@gmail.com" required />
						</td>
					</tr>
					<tr>
						<td>Username</td>
						<td>
						<input type="text" name="txtUsername" placeholder="User Name" required />	
						</td>
					</tr>
					<tr>
						<td>Password</td>
						<td>
						<input type="password" name="txtPassword" placeholder="Password" required />	
						</td>
					</tr>
					<tr>
						<td>Address</td>
						<td>
						<textarea rows="4" cols="50" name="txtAddress"></textarea>
						</td>
					</tr>
					<tr>
						<td>Phone No</td>
						<td>
						<input type="text" name="txtPhoneNo" placeholder="Phone No" required />	
						</td>
					</tr>
					<tr>
						<td>Grade</td>
						<td>
						<select name="txtGrade" required/>
							<option value="Year 10">Year 10</option>
							<option value="Year 11">Year 11</option>
							<option value="Year 12">Year 12</option>
							<option value="Year 13">Year 13</option>
						</select>	
						</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>
							<input type="radio" name="rdoGender" value="male" id="male" required />
							<label for="male">Male</label>	

							<input type="radio" name="rdoGender" value="female" id="female" required />
							<label for="female">Female</label>	
						</td>
					</tr>
					<tr>
						<td>Upload Profile Picture</td>
						<td>
						<input type="file" name="FilUserImage" />	
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<input type="submit" name="btnRegister" value="Register" />
							<input type="reset" value="Clear" />
						</td>
					</tr>
					</table>

				</fieldset>
				<a href="Student_Login.php">Go back to student login</a>
			</form>
		</body>
</html>