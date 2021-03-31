<?php
include 'connection.php';
session_start();
if(isset($_SESSION['userid']) || isset($_COOKIE['userid']))
{
$user_id = $_GET['id'];
$query = "UPDATE `friend_requests` SET `active`= 0 WHERE `sender`='$user_id' and `receiver`='".$_SESSION['userid']."'";
$result = mysqli_query($con,$query);
echo "<script>window.location.href='pending.php';</script>";
}
else
{
    header('location: index.php');
}
?>