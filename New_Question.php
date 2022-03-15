<?php  
    session_start();
    include('connect.php');

    if(!isset($_SESSION['AdminID'])) 
    {
        echo "<script>window.alert('Please login first to continue.')</script>";
        echo "<script>window.location='Admin_Login.php'</script>";
        exit();
    }

    $AdminID=$_SESSION['AdminID'];
    $_AdminID=mysqli_real_escape_string($connection,$AdminID);

    if(isset($_POST['btnCreateQues'])) 
    {
        $txtQuestion = $_POST['txtQuestion'];
        $selectQuestionType = $_POST['selectQuestionType'];
        $txtSubject = $_POST['txtSubject'];
        $selectGrade = $_POST['selectGrade'];
        $CreatedDate = $_POST['CreatedDate'];
        $selectCategory = $_POST['selectCategory'];
        $selectDifficulty = $_POST['selectDifficulty'];

        //Check if Question Already Exists-----------------------------------------------------

        $check="SELECT * FROM Question
        WHERE Question='$txtQuestion' ";
        $ret = mysqli_query($connection,$check);
        $count = mysqli_num_rows($ret);

        if ($count > 0 ) 
            {
                echo "<script>window.alert('The Same Question Already Exists in Question Bank! Add it from the Question Bank or Create a Different Question.')</script>";
                echo "<script>window.location='New_Question.php'</script>";
                exit();
            }
        
        else 
        {

            //Insert Question Data into Question Table-----------------------------------------------------
            
            $query = "INSERT INTO Question
            (Question,QuestionType,Subject,Grade,CreatedDate,Category,Difficulty,AdminID)
            VALUES('$txtQuestion','$selectQuestionType','$txtSubject','$selectGrade','$CreatedDate','$selectCategory','$selectDifficulty','$_AdminID')";
            
            $result=mysqli_query($connection,$query);
            if ($result)
            {
                echo "<script>window.alert('Question created successfully.')</script>";

                //Go to Chosen Question Type------------------------------------------
                if ($selectQuestionType=="Multiple Choice"){
                echo "<script>window.location='MC_QuestionBank.php'</script>";
                }
                else if($selectQuestionType=="Blank Type"){
                    echo "<script>window.location='BT_QuestionBank.php'</script>";
                }
                else{
                    echo "<script>window.location='TF_QuestionBank.php'</script>";
                }
            }

            else{
                echo mysqli_error($connection);
            }

        }

        $query2= "SELECT * FROM Question WHERE AdminID='$_AdminID' AND Question='$txtQuestion' ";
        $ret2 = mysqli_query($connection,$query2);

        $rows = mysqli_fetch_array($ret2);
        
        $_SESSION['QuestionID'] = $rows['QuestionID'];
        $_SESSION['Question'] = $rows['Question'];
        $_SESSION['QuestionType'] = $rows['QuestionType'];
        $_SESSION['Subject'] = $rows['Subject'];
        $_SESSION['Grade'] = $rows['Grade'];
        $_SESSION['CreatedDate'] = $rows['CreatedDate'];
        $_SESSION['Category'] = $rows['Category'];
        $_SESSION['Difficulty'] = $rows['Difficulty'];

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
        <title>New Question</title>
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
                        <h1 class="mt-4 text-white">New Question</h1>
                        <ol class="breadcrumb mb-4 bg-dark">
                            <li class="breadcrumb-item active text-light"><a class="link text-decoration-none text-white" href="Question_Bank.php">Question Bank</a> > <a class="link text-decoration-none text-white" href="New_Question.php">New Question</a></li>
                        </ol>   
                    </div>
                    <div class="container-fluid px-4 d-flex justify-content-center">
                        <div class="card p-5" style="width:50rem; margin-top:20px; margin-bottom:50px;">
                            <div class="card-body">
                                <form id="addques" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="Question">Question<br/>(If it is a blank type question, type underscores '___' for blank.)<br/>e.g. The result of 1 + 1 is ___.</label>
                                        <textarea rows="4" class="form-control border border-dark" name="txtQuestion" id="Question" placeholder="What is 1+1?" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="SelectType">Question Type</label>
                                        <select class="form-control border border-dark" name="selectQuestionType" id="SelectType" form="addques">
                                            <option value="Multiple Choice">Multiple Choice</option>
                                            <option value="True or False">True or False</option>
                                            <option value="Blank Type">Blank Type</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Subject">Subject</label>
                                        <input type="text" class="form-control border border-dark" name="txtSubject" id="Subject"/>	
                                    </div>
                                    <div class="form-group">                                   
                                        <label for="Grade">Grade</label>
                                        <select class="form-control border border-dark" name="selectGrade" id="Grade" form="addques">
                                            <option value="Year 10">Year 10</option>
                                            <option value="Year 11">Year 11</option>
                                            <option value="Year 12">Year 12</option>
                                            <option value="Year 13">Year 13</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="CDate">Created Date</label>
                                        <input type="date" class="form-control border border-dark" name="CreatedDate" id="CDate" value="<?php echo date('Y-m-d'); ?>" readonly />
                                    </div>
                                    <div class="form-group">		
                                        <label for="Category">Category</label>
                                        <select class="form-control border border-dark" name="selectCategory" id="Category" form="addques">
                                            <option value="Test">Test/Exam</option>
                                            <option value="Quiz">Quiz</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Difficulty">Difficulty</label>
                                        <select class="form-control border border-dark" name="selectDifficulty" id="Difficulty" form="addques">
                                            <option value="Easy">Easy</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Hard">Hard</option>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-dark float-right" name="btnCreateQues" value="Continue" />
                                </form>
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
