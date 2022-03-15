<?php  
session_start();
include('connect.php');


if(isset($_SESSION['StudentID'])) 
{
	echo "<script>window.location='Student_Dashboard.php'</script>";
}

if(isset($_POST['btnLogin'])) 
{
	$txtUserName=$_POST['txtUserName'];
	$txtPassword=$_POST['txtPassword'];

	$_txtUserName=mysqli_real_escape_string($connection,$txtUserName);
	$_txtPassword=mysqli_real_escape_string($connection,$txtPassword);

	$check="SELECT * FROM student
			WHERE Username='$_txtUserName'
			AND Password='$_txtPassword'
			";
	$ret=mysqli_query($connection,$check);
	$count=mysqli_num_rows($ret);
	$rows=mysqli_fetch_array($ret);

		if ($count < 1) 
		{
			echo "<script>window.alert('Your Username or Password is incorrect. Try again.')</script>";
			echo "<script>window.location='Student_Login.php'</script>";
		}
		else
		{
			$_SESSION['StudentID']=$rows['StudentID'];
			$_SESSION['Name']=$rows['Name'];
			$_SESSION['Email']=$rows['Email'];
			$_SESSION['Username']=$rows['Username'];
			$_SESSION['Password']=$rows['Password'];
			$_SESSION['Address']=$rows['Address'];
			$_SESSION['PhoneNo']=$rows['PhoneNo'];
			$_SESSION['Grade']=$rows['Grade'];
			$_SESSION['Gender']=$rows['Gender'];

			echo "<script>window.alert('SUCCESSFULLY LOGGED IN. SYSTEM IS READY.')</script>";
			echo "<script>window.location='Student_Dashboard.php'</script>";
		}

}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Student Login</title>
		<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
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
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5" style="margin-bottom:50px; background-color:#0A3B75;">
                                    <div class="card-header"><h3 class="text-center text-white font-weight-light my-4">Login as Student</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="txtUserName" id="inputEmail" type="text" placeholder="Username" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="txtPassword" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label text-white" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <a class="small float-right text-white" href="password.html">Forgot Password?</a>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input class="btn text-white" type="submit" name="btnLogin" value="Login" style="background-color:#456C90;"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small" style="color:#958B8B;">Don't have an account yet? <a class="text-white" href="Student_Register.php">Register here.</a></div>
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
                            <div class="text-muted">Copyright &copy; Online Test 2021</div>
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