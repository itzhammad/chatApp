<?php
include 'connection.php';
session_start();
$userid = $_SESSION['userid'];
if(isset($_COOKIE['userid']))
{
    $user_id = $_COOKIE['userid'];
    setcookie("userid", $user_id, time()-1);
}
$login_status = 0;
$query1 = "UPDATE `users` SET `login_status`='$login_status' WHERE `user_id`='$userid'";
$result1 = mysqli_query($con,$query1);
session_destroy();
header("location: index.php");
?>