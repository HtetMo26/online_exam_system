<?php
session_start();
session_destroy();
echo "<script>window.alert('You are logged out.')</script>";
echo "<script>window.location='Admin_Login.php'</script>";
?>