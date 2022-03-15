<?php
session_start();
include('connect.php');

if(!isset($_SESSION['AdminID'])) 
{
    echo "<script>window.alert('Please login first to continue.')</script>";
    echo "<script>window.location='Admin_Login.php'</script>";
    exit();
}

//Query Admin Data from Admin Table--------------------

	$AdminID=$_SESSION['AdminID'];
	$_AdminID=mysqli_real_escape_string($connection,$AdminID);

	$query="SELECT * FROM Admin WHERE AdminID='$_AdminID' ";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);

//----------------------------------------------------------------

if(isset($_POST['btnUpdate'])) 
{
    $txtCurrentPassword = $_POST['txtCurrentPassword'];
    $txtNewPassword = $_POST['txtNewPassword'];
    $txtNewPassword2 = $_POST['txtNewPassword2'];
    $txtAdminID=$_POST['txtAdminID'];
	$txtName=$_POST['txtName'];
	$txtEmail=$_POST['txtEmail'];
	$txtUsername=$_POST['txtUsername'];
	$txtAddress=$_POST['txtAddress'];
    $txtPhoneNo=$_POST['txtPhoneNo'];
    $rdoGender=$_POST['rdoGender'];

    if(($txtCurrentPassword == $rows['Password']) && ($txtNewPassword==$txtNewPassword2) )
    {
        $query2="UPDATE Admin
                SET
                Name='$txtName',
                Email='$txtEmail',
                Username='$txtUsername',
                Password='$txtNewPassword',
                Address='$txtAddress',
                PhoneNo='$txtPhoneNo',
                Gender='$rdoGender'
                WHERE AdminID='$txtAdminID'
			";
        $result=mysqli_query($connection,$query2);
        if ($result) 
		{
			echo "<script>window.alert('Password Successfully Updated.')</script>";
			echo "<script>window.location='Admin_Profile.php'</script>";
		}
		else
		{
			echo "<p>Something went wrong in Password Update" . mysqli_error($connection) . "</p>";
		}
    }
    elseif($txtCurrentPassword !== $rows['Password'])
    {
        echo "<script>window.alert('Error: The password you typed did not match with the current one.')</script>";
		echo "<script>window.location='Update_Password.php'</script>";
    }
    elseif($txtNewPassword !== $txtNewPassword2)
    {
        echo "<script>window.alert('Error: New password in the two fields did not match.')</script>";
		echo "<script>window.location='Update_Password.php'</script>";
    }
    else{
        echo "<script>window.alert('Error: Something went wrong. Try again.')</script>";
		echo "<script>window.location='Update_Password.php'</script>";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
         <meta name="author" content="" />
        <title>Update Password</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

    </head>
    <body class="sb-nav-fixed" style="background-color:#0A3B75; font-family: 'Quicksand', sans-serif;">
        <nav class="sb-topnav navbar navbar-expand navbar-light bg-white">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="Admin_Dashboard.php">Online Test</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="Admin_Logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">ADMIN</div>
                            <a class="nav-link" href="Admin_Dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">ACCOUNT</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                                Admin
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="Admin_Profile.php">View Profile</a>
                                    <a class="nav-link" href="Admin_Update.php">Update Profile</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="Student_Profiles.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-graduate"></i></div>
                                Student
                            </a>
                            <div class="sb-sidenav-menu-heading">TEST/EXAM</div>
                            <a class="nav-link" href="Test_Page.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                Test
                            </a>
                            <a class="nav-link" href="Student_Score.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                Issue Result
                            </a>
                            <a class="nav-link" href="Issued_Result.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-pen"></i></div>
                                Edit Result
                            </a>

                            <div class="sb-sidenav-menu-heading">QUESTION</div>
                            <a class="nav-link" href="Question_Bank.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Question Bank
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
					<div class="container-fluid px-4">
                        <h1 class="mt-4 text-white">Update Password</h1>
                        <ol class="breadcrumb mb-4 bg-dark">
                            <li class="breadcrumb-item active text-light"><a class="link text-decoration-none text-white" href="Admin_Profile.php">Your Profile</a> > <a class="link text-decoration-none text-white" href="Update_Password.php">Update Password</a></li>
                        </ol>
                    </div>
                    <div class="container-fluid px-4 d-flex justify-content-center">
                        <div class="card" style="width: 28rem; margin-top:20px;">
                            <div class="card-body">
                                <form action="" method="post">
                                    <h3 align="center"><i class="fas fa-pen-square"></i>&nbsp;&nbsp;Update Your Password</h3><br>
                                    <table cellpadding="4px">
                                        <tr>
                                            <td>Current Password</td>
                                            <td>
                                            <input type="password" name="txtCurrentPassword" required />	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Enter New Password</td>
                                            <td>
                                            <input type="password" name="txtNewPassword" required />	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Re-enter New Password</td>
                                            <td>
                                            <input type="password" name="txtNewPassword2" required />	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="hidden" name="txtAdminID" value="<?php echo $rows['AdminID'] ?>" />
                                                <input type="hidden" name="txtName" value="<?php echo $rows['Name'] ?>" />
                                                <input type="hidden" name="txtEmail" value="<?php echo $rows['Email'] ?>" />
                                                <input type="hidden" name="txtUsername" value="<?php echo $rows['Username'] ?>" />
                                                <input type="hidden" name="txtAddress" value="<?php echo $rows['Address'] ?>" />
                                                <input type="hidden" name="txtPhoneNo" value="<?php echo $rows['PhoneNo'] ?>" />
                                                <input type="hidden" name="rdoGender"value="<?php echo $rows['Gender'] ?>" />
                                                <input type="submit" class="btn btn-primary" name="btnUpdate" value="Update" />&nbsp;
                                                <a href="Admin_Profile.php" class="card-link">Back</a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>						
                    </div>                     
                	<br/>         
                </main>
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
