<?php  
    session_start();
    include('connect.php');

    $duration = $_SESSION['Duration'];

    header('Refresh:' . $duration*60 . '; URL=Student_Dashboard.php');

    $StudentID = $_SESSION['StudentID'];
    $TestID = $_SESSION['TestID'];


        $query=" SELECT * FROM test
        WHERE TestID='$TestID'";
        $ret=mysqli_query($connection,$query);
        $count=mysqli_num_rows($ret);
        $rows=mysqli_fetch_array($ret);

        $_SESSION['Grade']=$rows['Grade'];

        $query2 = "SELECT * FROM test_question INNER JOIN question
                   ON test_question.QuestionID = question.QuestionID
                   WHERE test_question.TestID = $TestID";
        $ret2 = mysqli_query($connection,$query2);
        $count2 = mysqli_num_rows($ret2);  

        $_SESSION['NoOfQues'] = $count2;

        if(isset($_POST['btnFinish']))
        {
            $query5 = "INSERT INTO student_test
            (TestID,StudentID)
            VALUES ($TestID,$StudentID)";
            $ret5 = mysqli_query($connection,$query5);
        }

?>

<script type="text/javascript">
    setInterval(function(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","response.php",false);
        xmlhttp.send(null);
        document.getElementById("response").innerHTML="Timer : " + xmlhttp.responseText;
    }, 1000);
</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Test Paper</title>
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
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="Student_Logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>          
        <main>
            <div class="container-fluid px-4" style="margin-top: 80px;">
                <ol class="breadcrumb mb-4 bg-dark">
                    <li class="breadcrumb-item active text-light">Answer all the questions. Do not leave or reload this page until you finish the test.</li>
                </ol>   
            </div>
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="card shadow p-5" style="margin-bottom:50px;">
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
                                                    <?php echo $rows2['QuestionType']; ?>
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

                                                        if(isset($_POST['btnFinish'])) 
                                                                {
                                                                    $radioMC = $_POST['radioMC'.$i];
                                                                    if ($radioMC == 1){
                                                                        $query4 = "INSERT INTO answer
                                                                        (StudentID,CorrectOrWrong,TestID,QuestionID)
                                                                        VALUES ($StudentID,'Correct',$TestID,$QuestionID)";
                                                                    }
                                                                    else{
                                                                        $query4= "INSERT INTO answer
                                                                        (StudentID,CorrectOrWrong,TestID,QuestionID)
                                                                        VALUES ($StudentID,'Wrong',$TestID,$QuestionID)";
                                                                    }
                                                                    
                                                                    $ret4 = mysqli_query($connection,$query4);

                                                                    if ($ret4){
                                                                        echo "<script>window.alert('Test finished successfully.')</script>";
                                                                        echo "<script>window.location='Test_Score.php'</script>";
                                                                    }
                                                                    else{
                                                                        echo "<script>window.alert('Something went wrong in the test. Try again.')</script>";
                                                                        echo "<script>window.location='Test_Score.php'</script>";
                                                                    }
                                                                    
                                                                }

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

                                                        if(isset($_POST['btnFinish'])) 
                                                        {
                                                            $answer = $_POST['blank'.$i];
                                                            if ($answer == $CorrectAnswer){
                                                                $query4 = "INSERT INTO answer
                                                                (StudentID,CorrectOrWrong,TestID,QuestionID)
                                                                VALUES ($StudentID,'Correct',$TestID,$QuestionID)";
                                                            }
                                                            else{
                                                                $query4= "INSERT INTO answer
                                                                (StudentID,CorrectOrWrong,TestID,QuestionID)
                                                                VALUES ($StudentID,'Wrong',$TestID,$QuestionID)";
                                                            }
                                                            
                                                            $ret4 = mysqli_query($connection,$query4);

                                                            if ($ret4){
                                                                echo "<script>window.alert('Test finished successfully.')</script>";
                                                                echo "<script>window.location='Test_Score.php'</script>";
                                                            }
                                                            else{
                                                                echo "<script>window.alert('Something went wrong in the test. Try again.')</script>";
                                                                echo "<script>window.location='Test_Score.php'</script>";
                                                            }
                                                        }
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

                                                        if(isset($_POST['btnFinish'])) {
                                                            $radioTF = $_POST['radioTF'.$i];
                                                            if ($radioTF == $TrueFalse){
                                                                $query4 = "INSERT INTO answer
                                                                (StudentID,CorrectOrWrong,TestID,QuestionID)
                                                                VALUES ($StudentID,'Correct',$TestID,$QuestionID)";
                                                            }
                                                            else{
                                                                $query4= "INSERT INTO answer
                                                                (StudentID,CorrectOrWrong,TestID,QuestionID)
                                                                VALUES ($StudentID,'Wrong',$TestID,$QuestionID)";
                                                            }
                                                            
                                                            $ret4 = mysqli_query($connection,$query4);

                                                            if ($ret4){
                                                                echo "<script>window.alert('Test finished successfully.')</script>";
                                                                echo "<script>window.location='Test_Score.php'</script>";
                                                            }
                                                            else{
                                                                echo "<script>window.alert('Something went wrong in the test. Try again.')</script>";
                                                                echo "<script>window.location='Test_Score.php'</script>";
                                                            }

                                                        } ?>
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
                                <input type="submit" class="btn btn-success float-right" name="btnFinish" value="Finish" />
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card shadow" style="margin-bottom:50px;">
                            <div class="card-header"><?php echo $rows['Subject'] ?> - <?php echo date("Y/m/d") ?></div>
                            <div class="card-body">
                                <h3 class="card-title"><span id="response" class="badge badge-secondary"></span></h3>
                                <h5 class="card-text"><span class="badge badge-info">Duration : <?php echo $rows['Duration_Mins'] ?> Mins</span></h5>                       
                                <h5 class="card-text"><span class="badge badge-info">Total Marks : <?php echo $rows['TotalMarks'] ?> </span></h5>
                                <h5 class="card-text"><span class="badge badge-info">Total Questions : <?php echo $rows['NoOfQuestions'] ?> </span></h5>
                            </div>                                    
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
