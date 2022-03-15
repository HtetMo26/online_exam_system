<?php
    session_start();
    include('connect.php');

    if(!isset($_GET['TestID'])) 
    {
        echo "<script>window.alert('You don't have permission for this page.')</script>";
        echo "<script>window.location='Available_Test.php'</script>";
    }
    else
    {
        $TestID = $_GET['TestID'];

        $query=" SELECT * FROM test
        WHERE TestID='$TestID'";
        $ret=mysqli_query($connection,$query);
        $count=mysqli_num_rows($ret);
        $rows=mysqli_fetch_array($ret);
        
        $duration = $rows['Duration_Mins'];
        
        $_SESSION["duration"] = $duration;
        $_SESSION["start_time"] = date("Y-m-d H:i:s");

        $end_time = date('Y-m-d H:i:s', strtotime('+'.$_SESSION["duration"].'minutes', strtotime($_SESSION["start_time"])));

        $_SESSION["end_time"] = $end_time;
            
    }

?>

<script type="text/javascript">
window.location = "Take_Test.php";
</script>