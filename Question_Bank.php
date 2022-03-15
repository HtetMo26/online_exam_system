<?php
    session_start();
    include('connect.php');

    //Check log in------------------------------------------------

    if(!isset($_SESSION['AdminID'])) 
    {
        echo "<script>window.alert('Please login first to continue.')</script>";
        echo "<script>window.location='Admin_Login.php'</script>";
        exit();
    }

    $query=" SELECT * FROM question";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);

    //Search question---------------------------------------------------------------

    if(isset($_POST['btnSearch'])) 
    {
        $AdminID = $_SESSION['AdminID'];
        $QuestionType = $_POST['selectQuestionType'];
        $Question = $_POST['selectQuestion'];

        if($QuestionType=="All"&&$Question=="All")
        {
            $query=" SELECT * FROM question";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);
        }
        else if($QuestionType=="Multiple Choice"&&$Question=="All")
        {
            $query=" SELECT * FROM question
            WHERE QuestionType = 'Multiple Choice'";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);
        }
        else if($QuestionType=="True or False"&&$Question=="All")
        {
            $query=" SELECT * FROM question
            WHERE QuestionType = 'True or False'";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);
        }
        else if($QuestionType=="Blank Type"&&$Question=="All")
        {
            $query=" SELECT * FROM question
            WHERE QuestionType = 'Blank Type'";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);
        }
        else if($QuestionType=="Multiple Choice"&&$Question=="You")
        {
            $query=" SELECT * FROM question
            WHERE QuestionType = 'Multiple Choice'
            AND AdminID = $AdminID ";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);
        }
        else if($QuestionType=="True or False"&&$Question=="You")
        {
            $query=" SELECT * FROM question
            WHERE QuestionType = 'True or False'
            AND AdminID = $AdminID ";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);
        }
        else if($QuestionType=="Blank Type"&&$Question=="You")
        {
            $query=" SELECT * FROM question
            WHERE QuestionType = 'Blank Type'
            AND AdminID = $AdminID ";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);
        }
        else
        {
            $query=" SELECT * FROM question
            WHERE AdminID = $AdminID";
            $ret=mysqli_query($connection,$query);
            $count=mysqli_num_rows($ret);
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
        <title>Question Bank</title>
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
                        <h1 class="mt-4 text-white">Question Bank</h1>
                        <ol class="breadcrumb mb-4 bg-dark">
                            <li class="breadcrumb-item active text-light"><a class="link text-decoration-none text-white" href="Question_Bank.php">Question Bank</a></li>
                        </ol>
                    </div>
                    <div class="container-fluid px-4">
                        <form method="post">
                            Question Type:&nbsp;
                            <select name="selectQuestionType">
                                <option value="All">All</option>
                                <option value="Multiple Choice">Multiple Choice</option>
                                <option value="True or False">True or False</option>
                                <option value="Blank Type">Blank Type</option>
                            </select>&nbsp;
                            Question:&nbsp;
                            <select name="selectQuestion">
                                <option value="All">All</option>
                                <option value="You">Created by you</option>
                            </select>&nbsp;
                            <input type="submit" name="btnSearch" value="Search">
                            <a href="New_Question.php" class="btn btn-info float-right" role="button"><i class="fas fa-plus"></i> New Question</a>
                        </form>          
                        <div class="table table-responsive rounded">  
                            <table class="table table-hover table-light" style="margin-top:20px; margin-bottom:35px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Difficulty</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <?php
                                    for($i=0;$i<$count;$i++) 
                                    {
                                        $rows=mysqli_fetch_array($ret);
                                        $QuestionID =$rows['QuestionID'];
                                        echo "<tbody>";
                                        echo "<tr>";
                                        echo "<td>" . $QuestionID . "</td>";
                                        echo "<td>" . $rows['Question'] . "</td>";
                                        echo "<td>" . $rows['QuestionType'] . "</td>";
                                        echo "<td>" . $rows['Subject'] . "</td>";
                                        echo "<td>" . $rows['Grade'] . "</td>";
                                        echo "<td>" . $rows['Difficulty'] . "</td>";
                                        echo "<td>" . "<a href='Question_Detail.php?QuestionID=$QuestionID' class='btn btn-outline-dark' role='button' aria-pressed='true'>View & Edit</a>" . "</td>";
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


