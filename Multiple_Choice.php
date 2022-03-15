<?php  
    session_start();
    include('connect.php');

    if(!isset($_SESSION['AdminID'])) 
    {
        echo "<script>window.alert('Please login first to continue.')</script>";
        echo "<script>window.location='Admin_Login.php'</script>";
        exit();
    }

    $QuestionID=$_SESSION['QuestionID'];
    $_QuestionID=mysqli_real_escape_string($connection,$QuestionID);
    $QuestionNo=$_SESSION['QuestionNo'];
    $_QuestionNo=mysqli_real_escape_string($connection,$QuestionNo);
    $TestID=$_SESSION['TestID'];
    $Question=$_SESSION['Question'];
    $_Question=mysqli_real_escape_string($connection,$Question);

    $select = "SELECT * FROM Question
               WHERE QuestionID='$_QuestionID' ";

    $query2 = mysqli_query($connection,$select);

    $rows = mysqli_fetch_array($query2);


        if(isset($_POST['btnAddOption'])) 
            {

                //Connect Test Table and Question Table--------------------------------------------------------------------------

                $check = "SELECT * FROM test_question
                WHERE QuestionID=$QuestionID";
                $exist = mysqli_query($connection,$check);
                $count = mysqli_num_rows($exist);

                    if (($count == 0) || ($count < 1))
                    {

                    $query3 = "INSERT INTO test_question
                    (QuestionID, TestID)
                    VALUES ($QuestionID,$TestID)" ;

                    $result3 = mysqli_query($connection,$query3);

                    }

                        //Insert MC Data into MC Table------------------------------------------------------------------------------------

                        $txtOptionA = $_POST['txtOptionA'];
                        $txtOptionB = $_POST['txtOptionB'];
                        $txtOptionC = $_POST['txtOptionC'];
                        $txtOptionD = $_POST['txtOptionD'];
                        $txtOptionE = $_POST['txtOptionE'];
                        $CorrectAnswer = $_POST['CorrectAnswer'];

                        $option = array();
                        $option [1] = $txtOptionA;
                        $option [2] = $txtOptionB;
                        $option [3] = $txtOptionC;
                        $option [4] = $txtOptionD;
                        $option [5] = $txtOptionE;

                        foreach ($option as $key => $optionValue){
                            if ($optionValue != ''){
                                if ($CorrectAnswer == $key){
                                    $query = "INSERT INTO multiplechoice
                                    (QuestionNo,Answer,QuestionID,CorrectAnswer)
                                    VALUES('$_QuestionNo','$optionValue','$_QuestionID','1')";
                                }
                                else{
                                    $query = "INSERT INTO multiplechoice
                                    (QuestionNo,Answer,QuestionID,CorrectAnswer)
                                    VALUES('$_QuestionNo','$optionValue','$_QuestionID','0')";
                                }

                                $insertOption = mysqli_query($connection,$query);                        

                            }
                        }

                            if ($insertOption){
                                echo "<script>window.alert('Multiple Choice added successfully.')</script>";
                                echo "<script>window.location='Add_Question.php'</script>";
                            }
                            else{
                                echo "<script>window.alert('Something went wrong in adding the question. Please try agian.')</script>";
                                echo "<script>window.location='Multiple_Choice.php'</script>";
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
        <title>Multiple Choice</title>
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
                        <h1 class="mt-4 text-white">Multiple Choice</h1>
                        <ol class="breadcrumb mb-4 bg-dark">
                            <li class="breadcrumb-item active text-light"><a class="link text-decoration-none text-white" href="Test_Page.php">Tests</a> > <a class="link text-decoration-none text-white" href="New_Test.php">New Test</a> > <a class="link text-decoration-none text-white" href="Add_Question.php">Add Question</a> > <a class="link text-decoration-none text-white" href="Multiple_Choice.php">Multiple Choice</a></li>
                        </ol>   
                    </div>
                    <div class="container-fluid px-4 d-flex justify-content-center">
                        <div class="card p-5" style="width:50rem; margin-top:20px; margin-bottom:50px;">
                            <div class="card-body">
                                <form id="addmc" method="post" enctype="multipart/form-data">
                                    <div class="form-group">                         
                                        <label for="Question">Question No:</label>                   
                                        <input type="number" class="form-control border border-dark" id="Question" name="txtQuestionNo" value="<?php echo $QuestionNo ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="Question">Question:</label>
                                        <textarea rows="4" class="form-control border border-dark" id="Question" name="txtQuestion" readonly><?php echo $rows['Question'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="OptionA">Option A:</label>
                                        <input type="text" class="form-control border border-dark" id="OptionA" name="txtOptionA" placeholder="Answer for Option A" required />
                                    </div>
                                    <div class="form-group">                               
                                        <label for="OptionB">Option B:</label>
                                        <input type="text" class="form-control border border-dark" id="OptionB" name="txtOptionB" placeholder="Answer for Option B" required />
                                    </div>
                                    <div class="form-group"> 
                                        <label for="OptionC">Option C:</label>
                                        <input type="text" class="form-control border border-dark" id="OptionC" name="txtOptionC" placeholder="Answer for Option C" required />
                                    </div>
                                    <div class="form-group">                                        
                                        <label for="OptionD">Option D:</label>
                                        <input type="text" class="form-control border border-dark" id="OptionD" name="txtOptionD" placeholder="Answer for Option D" required />
                                    </div>
                                    <div class="form-group">         
                                        <label for="OptionE">Option E:</label>                                       
                                        <input type="text" class="form-control border border-dark" id="OptionE" name="txtOptionE" placeholder="Answer for Option E" required />
                                    </div>
                                    <div class="form-group">    
                                        <label for="Correct">Number of Correct Option: (e.g, Option A = 1, Option B = 2, etc.)</label>
                                        <input type="number" class="form-control border border-dark" id="Correct" name="CorrectAnswer" placeholder="If Option A is correct, type '1'." required />	
                                    </div>   
                                    <input type="submit" class="btn btn-dark float-right" name="btnAddOption" value="Save" />                                   
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