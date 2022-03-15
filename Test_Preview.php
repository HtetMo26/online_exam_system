<?php
    session_start();
    include('connect.php');

    if(!isset($_SESSION['AdminID'])) 
    {
        echo "<script>window.alert('Please login first to continue.')</script>";
        echo "<script>window.location='Admin_Login.php'</script>";
        exit();
    }

    if(!isset($_GET['TestID'])) 
    {
        echo "<script>window.alert('You don't have permission for this page.')</script>";
        echo "<script>window.location='Test_Page.php'</script>";
    }
    else{
        $TestID = $_GET['TestID'];

        $query=" SELECT * FROM test
        WHERE TestID='$TestID'";
        $ret=mysqli_query($connection,$query);
        $count=mysqli_num_rows($ret);
        $rows=mysqli_fetch_array($ret);

        $_SESSION['TestID'] = $rows['TestID'];

        $query2 = "SELECT * FROM test_question INNER JOIN question
                   ON test_question.QuestionID = question.QuestionID
                   WHERE test_question.TestID = $TestID";
        $ret2 = mysqli_query($connection,$query2);
        $count2 = mysqli_num_rows($ret2);

    }

    if(isset($_POST['btnUpdate']))
    {
        $TestID = $_GET['TestID'];
        $Status = $_POST['Status'];
        $update = "UPDATE test
                    SET Status='$Status'
                    WHERE TestID=$TestID ";
        $updateret = mysqli_query($connection,$update);

        if ($updateret) 
        {
            echo "<script>window.alert('Test Status is Successfully Updated.')</script>";
            echo "<script>window.location='Test_Preview.php?TestID=$TestID'</script>";
        }
        else
        {
            echo "<p>Something went wrong in Question Update " . mysqli_error($connection) . "</p>";
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
        <title>Test Preview</title>
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
                    <h1 class="mt-4 text-white">Test Preview</h1>
                    <ol class="breadcrumb mb-4 bg-dark">
                        <li class="breadcrumb-item active text-light"><a class="link text-decoration-none text-white" href="Test_Page.php">My Tests</a> > <?php echo "<a class='link text-decoration-none text-white' href='Test_Preview.php?TestID=$TestID'>Test Preview</a>" ?></li>
                    </ol>
                </div>
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card shadow mb-4" >
                                <div class="card-body">
                                    <h5 class="card-title">Test Details</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Test ID: <?php echo $rows['TestID'] ?></h6>
                                    <p class="card-text mb-2 text-muted">Test Name: <?php echo $rows['TestName'] ?></p>
                                    <p class="card-text mb-2 text-muted">Start Time: <?php echo $rows['StartTime'] ?></p>
                                    <p class="card-text mb-2 text-muted">Duration: <?php echo $rows['Duration_Mins'] . " Mins" ?></p>
                                    <p class="card-text mb-2 text-muted">Subject: <?php echo $rows['Subject'] ?></p>
                                    <p class="card-text mb-2 text-muted">Grade: <?php echo $rows['Grade'] ?></p>
                                    <p class="card-text mb-2 text-muted">Total Ques: <?php echo $rows['NoOfQuestions'] ?></p>
                                    <p class="card-text mb-2 text-muted">Total Marks: <?php echo $rows['TotalMarks'] ?></p>
                                    <p class="card-text mb-2 text-muted">Status: <?php echo $rows['Status'] ?></p>
                                    <a href="Update_Test.php" class="card-link">Edit</a>
                                    <a href="Test_Page.php" class="card-link float-right">To test page</a>
                                </div>
                            </div>
                            <div class="card shadow mb-4" >
                                <div class="card-body">
                                    <p>Update Status of Test:</p>
                                    <form method="post">
                                        <select class="form-control border border-dark" name="Status">
                                            <option value="Pending" name="Status" <?php if($rows['Status']=="Pending"){ echo "selected"; } ?>>Pending</option>
                                            <option value="Published" name="Status" <?php if($rows['Status']=="Published"){ echo "selected"; } ?>>Published</option>
                                            <option value="Finished" name="Status" <?php if($rows['Status']=="Finished"){ echo "selected"; } ?>>Finished</option>
                                        </select><br/>
                                        <input type="submit" class="btn btn-primary float-right" name="btnUpdate" value="Update" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            <div class="card shadow p-5" style="margin-bottom:50px;">
                                <p class="text-center mb-4"><i>This is a preview of how the test will appear for the students (except the QuestionIDs).</i></p>
                                <form method="post" enctype="multipart/form-data">
                                    <h2 class="text-center"><?php echo $rows['TestName'];?></h2>
                                    <h6 class="text-center"><?php echo $rows['Grade'];?>, <?php echo $rows['Subject'];?></h6>
                                    <br>
                                    <div class="row">
                                        <?php
                                            for($i=0;$i<$count2;$i++) 
                                            {      
                                                $rows2 = mysqli_fetch_array($ret2); 
                                                $QuestionID = $rows2['QuestionID']; ?>

                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <div class="card-header text-dark">
                                                        <?php echo $rows2['QuestionType']; ?> <a class="link-primary" href="Question_Detail.php?QuestionID=<?php echo $QuestionID ?>"> (QuestionID: <?php echo $QuestionID ?>) </a>
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">No : <?php echo $i+1 ?></li>
                                                        <li class="list-group-item text-dark">Question : <b><?php echo $rows2['Question'] ?></b></li>
                                                    </ul>
                                                    <div class="card-body text-dark">
                                                        Correct Answer : &nbsp;

                                                        <?php if($rows2['QuestionType']=='Multiple Choice'){ 
                                                            $query3 = "SELECT * FROM multiplechoice
                                                                        WHERE QuestionID=$QuestionID";
                                                            $ret3 = mysqli_query($connection,$query3);
                                                            $count3 = mysqli_num_rows($ret3);   

                                                            for ($j=0;$j<$count3;$j++){
                                                                $rows3 = mysqli_fetch_array($ret3);
                                                                
                                                        ?> 
                                                                
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioMC<?php echo $i ?>" id="radioMC1" value="<?php echo $rows3['CorrectAnswer'] ?>"  required />
                                                                <label class="form-check-label" for="radioMC1">
                                                                    <?php echo $rows3['Answer']; ?>
                                                                </label>
                                                            </div>
                                                        <?php } } ?>

                                                        <?php if($rows2['QuestionType']=='Blank Type'){
                                                            $query3 = "SELECT * FROM blank_type
                                                            WHERE QuestionID=$QuestionID";
                                                            $ret3 = mysqli_query($connection,$query3);
                                                            $count3 = mysqli_num_rows($ret3);
                                                            $rows3 = mysqli_fetch_array($ret3);
                                                            $CorrectAnswer = $rows3['Answer'];

                                                            ?>
                                                            <div class="form-group">
                                                                <input class="form-control border-dark rounded" type="text" name="blank<?php echo $i ?>" placeholder="Type answer" required />
                                                            </div>
                                                        <?php } ?>

                                                        <?php if($rows2['QuestionType']=='True or False'){
                                                            $query3 = "SELECT * FROM true_or_false
                                                            WHERE QuestionID=$QuestionID";
                                                            $ret3 = mysqli_query($connection,$query3);
                                                            $count3 = mysqli_num_rows($ret3);
                                                            $rows3 = mysqli_fetch_array($ret3);
                                                            $TrueFalse = $rows3['TrueOrFalse'];

                                                        ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioTF<?php echo $i ?>" id="radioTF1" value="True" required/>
                                                                <lable class="form-check-label" for="radioTF1">
                                                                    True
                                                                </lable>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="radioTF<?php echo $i ?>" id="radioTF1" value="False" required/>
                                                                <lable class="form-check-label" for="radioTF1">
                                                                    False
                                                                </lable>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>                            
                                        <?php } ?>                       
                                    </div>
                                </form>
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
    </body>
</html>




