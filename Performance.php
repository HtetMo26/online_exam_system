<?php
    session_start();
    include('connect.php');

    if(!isset($_SESSION['StudentID'])) 
    {
        echo "<script>window.alert('Please login first to continue.')</script>";
        echo "<script>window.location='Student_Login.php'</script>";
        exit();
    }

    $StudentID = $_SESSION['StudentID'];
    
    $query = "SELECT * FROM result
    WHERE PassOrFail='Pass'
    AND StudentID = $StudentID";
    $ret = mysqli_query($connection,$query);
    $count = mysqli_num_rows($ret);

    $query1 = "SELECT * FROM result
    WHERE PassOrFail='Fail'
    AND StudentID = $StudentID";
    $ret1 = mysqli_query($connection,$query1);
    $count1 = mysqli_num_rows($ret1);

    $query2 = "SELECT * FROM result
    WHERE PassOrFail='Pass'";
    $ret2 = mysqli_query($connection,$query2);
    $count2 = mysqli_num_rows($ret2);

    $query3 = "SELECT * FROM result
    WHERE PassOrFail='Fail'";
    $ret3 = mysqli_query($connection,$query3);
    $count3 = mysqli_num_rows($ret3);

    $query4 = "SELECT * FROM result
    WHERE Grade='A+'
    AND StudentID = $StudentID";
    $ret4 = mysqli_query($connection,$query4);
    $count4 = mysqli_num_rows($ret4);

    $query5 = "SELECT * FROM result
    WHERE Grade='A'
    AND StudentID = $StudentID";
    $ret5 = mysqli_query($connection,$query5);
    $count5 = mysqli_num_rows($ret5);

    $query6 = "SELECT * FROM result
    WHERE Grade='A-'
    AND StudentID = $StudentID";
    $ret6 = mysqli_query($connection,$query6);
    $count6 = mysqli_num_rows($ret6);

    $query7 = "SELECT * FROM result
    WHERE Grade='B+'
    AND StudentID = $StudentID";
    $ret7 = mysqli_query($connection,$query7);
    $count7 = mysqli_num_rows($ret7);

    $query8 = "SELECT * FROM result
    WHERE Grade='B'
    AND StudentID = $StudentID";
    $ret8 = mysqli_query($connection,$query8);
    $count8 = mysqli_num_rows($ret8);

    $query9 = "SELECT * FROM result
    WHERE Grade='B-'
    AND StudentID = $StudentID";
    $ret9 = mysqli_query($connection,$query9);
    $count9 = mysqli_num_rows($ret9);

    $query10 = "SELECT * FROM result
    WHERE Grade='C+'
    AND StudentID = $StudentID";
    $ret10 = mysqli_query($connection,$query10);
    $count10 = mysqli_num_rows($ret10);

    $query11 = "SELECT * FROM result
    WHERE Grade='C'
    AND StudentID = $StudentID";
    $ret11 = mysqli_query($connection,$query11);
    $count11 = mysqli_num_rows($ret11);

    $query12 = "SELECT * FROM result
    WHERE Grade='C-'
    AND StudentID = $StudentID";
    $ret12 = mysqli_query($connection,$query12);
    $count12 = mysqli_num_rows($ret12);

    $query13 = "SELECT * FROM result
    WHERE Grade='D'
    AND StudentID = $StudentID";
    $ret13 = mysqli_query($connection,$query13);
    $count13 = mysqli_num_rows($ret13);

    $query14 = "SELECT * FROM result
    WHERE Grade='F'
    AND StudentID = $StudentID";
    $ret14 = mysqli_query($connection,$query14);
    $count14 = mysqli_num_rows($ret14);

    $queryc = "SELECT * FROM answer
    WHERE CorrectOrWrong='Correct'
    AND StudentID = $StudentID";
    $retc = mysqli_query($connection,$queryc);
    $countc = mysqli_num_rows($retc);

    $queryw = "SELECT * FROM answer
    WHERE CorrectOrWrong='Wrong'
    AND StudentID = $StudentID";
    $retw = mysqli_query($connection,$queryw);
    $countw = mysqli_num_rows($retw);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
         <meta name="author" content="" />
        <title>Dashboard - Student</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>

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
                        <h1 class="mt-4 text-white">Performance</h1>
                        <ol class="breadcrumb bg-dark mb-4">
                            <li class="breadcrumb-item active text-light"><a class="link text-decoration-none text-white" href="Performance.php">Performance</a></li>
                        </ol>
                    </div>
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Pass Vs Fail (You)
                                    </div>
                                    <div class="container d-flex justify-content-center"><div class="col-6 card-body"><canvas id="myChart1" width="100%" height="40"></canvas></div></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Pass Vs Fail (All students)
                                    </div>
                                    <div class="container d-flex justify-content-center"><div class="col-6 card-body"><canvas id="myChart2" width="100%" height="40"></canvas></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Number of correct and wrong answers that you made
                                    </div>
                                    <div class="container d-flex justify-content-center"><div class="col-6 card-body"><canvas id="myChart3" width="100%" height="40"></canvas></div></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card p-5 mb-4">
                                    <div class="card-header">
                                        Number of tests that you achieved these grades
                                    </div>
                                    <table class="table" border="1">
                                        <tr><th>Grade<th><th>Number of tests</th></tr>
                                        <tr><th>A+<th><td><?php echo $count4 ?></td></tr>
                                        <tr><th>A<th><td><?php echo $count5 ?></td></tr>
                                        <tr><th>A-<th><td><?php echo $count6 ?></td></tr>
                                        <tr><th>B+<th><td><?php echo $count7 ?></td></tr>
                                        <tr><th>B<th><td><?php echo $count8 ?></td></tr>
                                        <tr><th>B-<th><td><?php echo $count9 ?></td></tr>
                                        <tr><th>C+<th><td><?php echo $count10 ?></td></tr>
                                        <tr><th>C<th><td><?php echo $count11 ?></td></tr>
                                        <tr><th>C-<th><td><?php echo $count12 ?></td></tr>
                                        <tr><th>D<th><td><?php echo $count13 ?></td></tr>
                                        <tr><th>F<th><td><?php echo $count14 ?></td></tr>
                                    </table>
                                </div>
                            </div>                     
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
        <script>
           const ctx = document.getElementById('myChart1').getContext('2d');
            const myChart1 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Pass','Fail'],
                    datasets: 
                    [
                        {
                            label: "Dataset 1",
                            data: [<?= $count; ?>,<?= $count1; ?>],
                            borderColor: ['rgba(54, 162, 235, 1)','rgba(255, 99, 132, 1)'],                       
                            backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.2)'],
                        }
                    ]
                },
                
                options: {
                    responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Pass / Fail'
                    }
                }
            }
            });

            const ctx1 = document.getElementById('myChart2').getContext('2d');
            const myChart2 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ['Pass','Fail'],
                    datasets: 
                    [
                        {
                            label: "Dataset 1",
                            data: [<?= $count2; ?>,<?= $count3; ?>],
                            borderColor: ['rgba(54, 162, 235, 1)','rgba(255, 99, 132, 1)'],                       
                            backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.2)'],
                        }
                    ]
                },
                
                options: {
                    responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Pass / Fail'
                    }
                }
            }
            });

            const ctx2 = document.getElementById('myChart3').getContext('2d');
            const myChart3 = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Correct','Wrong'],
                    datasets: 
                    [
                        {
                            label: "Dataset 1",
                            data: [<?= $countc; ?>,<?= $countw; ?>],
                            borderColor: ['rgba(54, 162, 235, 1)','rgba(255, 99, 132, 1)'],                       
                            backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.2)'],
                        }
                    ]
                },
                
                options: {
                    responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Correct / Wrong'
                    }
                }
            }
            });
        </script>
    </body>
</html>


