<?php
include 'connection.php';
session_start();
if(isset($_SESSION['userid']) || isset($_COOKIE['userid']))
{
$user_id = $_GET['id'];
$query1 = "UPDATE `friend_requests` SET `active`= 0 WHERE `sender`='$user_id' and `receiver`='".$_SESSION['userid']."'";
$result1 = mysqli_query($con,$query1);
if($result1)
{
$query = "INSERT INTO `friends`(`user_one`, `user_two`,`active`) VALUES ('$user_id','".$_SESSION['userid']."', 1)";
$result = mysqli_query($con,$query);
echo "<script>window.location.href='pending.php';</script>";
}
else{
    echo "error";
}
}
else
{
    header('location: index.php');
}
?>