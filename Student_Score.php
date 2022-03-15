<?php
    session_start();
    include('connect.php');

    $AdminID = $_SESSION['AdminID'];

    if(!isset($_SESSION['AdminID'])) 
    {
        echo "<script>window.alert('Please login first to continue.')</script>";
        echo "<script>window.location='Student_Login.php'</script>";
        exit();
    }

    $query = "SELECT * FROM test INNER JOIN student_test
                ON test.TestID = student_test.TestID
                WHERE test.AdminID = $AdminID";
    $ret = mysqli_query($connection,$query);
    $count = mysqli_num_rows($ret);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Student Answers</title>
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
                    <h1 class="mt-4 text-white">Student Answers</h1>
                    <ol class="breadcrumb mb-4 bg-dark">
                        <li class="breadcrumb-item active text-light"><a class="link text-decoration-none text-white" href="Student_Score.php">Student Answers</a></li>
                    </ol>
                </div>
                <div class="container-fluid px-4">
                <div class="table table-responsive">  
                    <table class="table table-hover table-dark" style="margin-top:0px; margin-bottom:35px;">
                        <thead>
                            <tr>
                                <th scope="col">Test ID</th>
                                <th scope="col">Test Name</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Student Name</th>                       
                                <th scope="col">Correct Question IDs</th>
                                <th scope="col">Wrong Question IDs</th>
                                <th scope="col">Result</th>
                            </tr>
                        </thead>
                        <?php
                            for($i=0;$i<$count;$i++) 
                            {
                                $rows=mysqli_fetch_array($ret);
                                $StudentID =$rows['StudentID'];
                                $query2=" SELECT * FROM student
                                WHERE StudentID=$StudentID";
                                $ret2=mysqli_query($connection,$query2);
                                $rows2=mysqli_fetch_array($ret2);

                                $TestID =$rows['TestID'];
                                $query3=" SELECT * FROM answer
                                WHERE StudentID=$StudentID
                                AND TestID=$TestID
                                AND CorrectOrWrong='Correct' ";
                                $ret3=mysqli_query($connection,$query3);
                                $count3=mysqli_num_rows($ret3);

                                $query4=" SELECT * FROM answer
                                WHERE StudentID=$StudentID
                                AND TestID=$TestID
                                AND CorrectOrWrong='Wrong' ";
                                $ret4=mysqli_query($connection,$query4);
                                $count4=mysqli_num_rows($ret4);

                                $query5=" SELECT * FROM result
                                WHERE StudentID=$StudentID
                                AND TestID=$TestID";
                                $ret5=mysqli_query($connection,$query5);
                                $count5=mysqli_num_rows($ret5);
                                
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $rows['TestID'] . "</td>";
                                echo "<td>" . $rows['TestName'] . "</td>";
                                echo "<td>" . $StudentID . "</td>";
                                echo "<td>" . $rows2['Name'] . "</td>";
                                echo "<td>"; for($j=0;$j<$count3;$j++){$rows3=mysqli_fetch_array($ret3); echo "<span class='badge badge-light'>" . $rows3['QuestionID'] . "</span>&nbsp;";} echo "</td>";
                                echo "<td>"; for($x=0;$x<$count4;$x++){$rows4=mysqli_fetch_array($ret4); echo "<span class='badge badge-light'>" . $rows4['QuestionID'] . "</span>&nbsp;";}  echo "</td>";
                                if($count5==1){echo "<td> <i>Issued</i> </td>"; }
                                else {echo "<td>" . "<a href='Issue_Result.php?StudentID=$StudentID&amp;TestID=$TestID' class='btn btn-outline-light' role='button' aria-pressed='true'>Issue Result</a>" . "</td>";}
                                echo "</tr>";
                                echo "</tbody>";
                            }          
                    
                        ?>
                    </table>
            </div>
                </div>
            
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


