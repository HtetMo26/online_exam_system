<?php  
	session_start();
	include('connect.php');

    $StudentID = $_SESSION['StudentID'];

	//Check If Logged In

	if(!isset($_SESSION['StudentID'])) 
		{
			echo "<script>window.alert('Please login first to continue.')</script>";
			echo "<script>window.location='Student_Login.php'</script>";
			exit();         
		}

    if(!isset($_GET['TestID'])) 
        {
            echo "<script>window.location='Taken_Test.php'</script>";
            exit();
        }
    else
    {
        $TestID = $_GET['TestID'];

        //Query Result Data from Result Table----------------------------------------------------

        $query="SELECT * FROM result WHERE TestID = $TestID AND StudentID = $StudentID";
        $ret=mysqli_query($connection,$query);
        $count=mysqli_num_rows($ret);
        $rows=mysqli_fetch_array($ret);

        if($count<1)
        {
            echo "<script>window.alert('Your final result for this test is not issued by admin yet.')</script>";
			echo "<script>window.location='Taken_Test.php'</script>";
			exit();
        }

        //Query Test Data from Test Table

        $query2="SELECT * FROM test WHERE TestID = $TestID";
        $ret2=mysqli_query($connection,$query2);
        $rows2=mysqli_fetch_array($ret2);

    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
         <meta name="author" content="" />
        <title>View Result</title>
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
            <a class="navbar-brand ps-3" href="Student_Dashboard.php">Online Test</a>
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
                        <li><a class="dropdown-item" href="Student_Logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">STUDENT</div>
                            <a class="nav-link" href="Student_Dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">ACCOUNT</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                                Your Account
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="Student_Profile.php">View Profile</a>
                                    <a class="nav-link" href="Student_Profile_Update.php">Update Profile</a>
                                </nav>
                            </div>
                            
                            <div class="sb-sidenav-menu-heading">TEST/EXAM</div>
                            <a class="nav-link" href="Available_Test.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                Available Test
                            </a>
                            <a class="nav-link" href="Taken_Test.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                                Taken Test
                            </a>
                           
                            <div class="sb-sidenav-menu-heading">PERFORMANCE</div>
                            <a class="nav-link" href="Performance.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Your Performance
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Student
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 text-white">Result Page</h1>
                        <ol class="breadcrumb mb-4 bg-dark">
                            <li class="breadcrumb-item active text-light"><a class="link text-decoration-none text-white" href="Taken_Test.php">Taken Tests</a> > <?php echo "<a class='link text-decoration-none text-white' href='Result_Page.php?TestID=$TestID'>Result Page</a>" ?></li>
                        </ol>   
                    </div>
					<div class="container-fluid px-4 d-flex justify-content-center">
                        <div class="card shadow p-5" style="width:40rem; margin-top:20px; margin-bottom:50px;">
                            <div class="card-body">
                                <h5 class="card-title">Results for Test ID: <?php echo $TestID ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Final results of your test <b>"<?php echo $rows2['TestName'] ?>"</b></h6>
                                <table class="table">
                                    <tr>
                                        <th>Result ID</th>
                                        <td><?php echo $rows['ResultID'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Test Name</th>
                                        <td><?php echo $rows2['TestName'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Final Score</th>
                                        <td><?php echo $rows['FinalScores'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Grade</th>
                                        <td><?php echo $rows['Grade'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>P/F</th>
                                        <td><?php echo $rows['PassOrFail'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Comment</th>
                                        <td><?php echo $rows['Comment'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Issued Date</th>
                                        <td><?php echo $rows['IssuedDate'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Issued By Admin ID</th>
                                        <td><?php echo $rows['AdminID'] ?></td>
                                    </tr>
                                </table>
                                <a href="Taken_Test.php" class="card-link float-right">Back</a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
