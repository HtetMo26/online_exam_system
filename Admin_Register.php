<?php  
session_start();
include('connect.php');

if(isset($_POST['btnSave'])) 
{
	$txtName=$_POST['txtName'];
	$txtEmail=$_POST['txtEmail'];
	$txtUsername=$_POST['txtUsername'];
	$txtPassword=$_POST['txtPassword'];
	$txtPassword2=$_POST['txtPassword2'];
	$txtAddress=$_POST['txtAddress'];
    $txtPhoneNo=$_POST['txtPhoneNo'];
    $selectGender=$_POST['Gender'];


	//Check Admin Email already exit or not------------------------------------------------
	$check="SELECT * FROM Admin
			WHERE Email='$txtEmail' ";
	$result=mysqli_query($connection,$check);
	$count=mysqli_num_rows($result);

		if ($count > 0 ) 
		{
			echo "<script>window.alert('This Gmail Address $txtEmail Already Exists!')</script>";
			echo "<script>window.location='Admin_Register.php'</script>";
			exit();
		}
	
        //Check password match-------------------------------------------------------------------
		if ($txtPassword !== $txtPassword2)
		{
			echo "<script>window.alert('Error: The password and confirm password did not match.')</script>";
			echo "<script>window.location='Admin_Register.php'</script>";
			
		}
		else
		{
			//Insert Admin Data to Admin Table-----------------------------------------------------
			$query="INSERT INTO Admin
					(Name,Email,Username,Password,Address,PhoneNo,Gender)
					VALUES 
					('$txtName','$txtEmail','$txtUsername','$txtPassword','$txtAddress','$txtPhoneNo','$selectGender')";
			$result=mysqli_query($connection,$query);

			if ($result) 
			{
				echo "<script>window.alert('Admin Acccount Successfully Created.')</script>";
				echo "<script>window.location='Admin_Login.php'</script>";
			}
			else
			{
				echo "<p>Something went wrong. Try again. " . mysqli_error($connection) . "</p>";
			}
		}
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Register</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400&display=swap" rel="stylesheet">
    </head>
    <body style="font-family: 'Quicksand', sans-serif; background-color:#B6BDC6;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5" style="margin-bottom:50px; background-color:#0A3B75;">
                                    <div class="card-header"><h3 class="text-center text-white font-weight-light my-4">Register as Admin</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" type="text" name="txtName" placeholder="Enter your first name" required />
                                                        <label for="inputFirstName">Full name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" name="txtUsername" placeholder="Enter your last name" required />
                                                        <label for="inputLastName">Username</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="txtEmail" placeholder="name@blabla.com" required />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" name="txtPassword" placeholder="Create a password" required />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="txtPassword2" placeholder="Confirm password" required />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-floating mb-3">
												<textarea class="form-control" placeholder="Leave a comment here" id="inputAddress" name="txtAddress" style="height: 90px" required></textarea>
                                                <label for="inputAddress">Address</label>
                                            </div>
											<div class="form-floating mb-3">
                                                <input class="form-control" id="PhoneNo" type="number" name="txtPhoneNo" placeholder="+95097787967" min="0" required />
                                                <label for="PhoneNo">Phone No</label>
                                            </div>
											<div class="form-floating mb-3">
												<select class="form-select" id="Gender" name="Gender" aria-label="Floating label select gender" required>
													<option selected>Choose your gender</option>
													<option value="male">Male</option>
													<option value="female">Female</option>
													<option value="other">Other</option>
												</select>
												<label for="Gender">Gender</label>
											</div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input class="btn text-white" type="submit" name="btnSave" value="Register" style="background-color:#456C90;"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small" style="color:#958B8B;">Already have an account? <a class="text-white" href="Admin_Login.php">Login now.</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
