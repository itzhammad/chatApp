<?php
include 'connection.php';
session_start();
if(isset($_SESSION['userid']) || isset($_COOKIE['userid']))
{
 
$second_user = $_GET['id'];
$query ="SELECT users.username, chat_history.msg, chat_history.date_time
FROM users
INNER JOIN chat_history ON users.user_id = chat_history.user_id	";
$result = mysqli_query($con,$query);
// $row = mysqli_fetch_array($result);
$query1 ="SELECT * FROM `users` WHERE `user_id`= '$second_user'";
$result1 = mysqli_query($con,$query1);
$row1 = mysqli_fetch_array($result1);
}
else
{
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Chat Room</title>
</head>
<body>
    <div class="container">
        <div class="color">
        <div class="button-bar">
        <?php echo'
            <span style="font-size: 1.5em;">'.$row1['username'].'<img style="height: 80px; width: 80px; padding:15px;" src="'.$row1['profile_image'].'" alt=""></span>';
            ?>
            <?php
             echo ' <a href="chat_history.php?id='.$_GET['id'].'">Chat History</a>';
            ?>
            <a href="online.php">Back</a>
        </div>
        </div>
        <div class="message">
        <table id="chats">
           <tbody>
               <?php 
               while($row=mysqli_fetch_array($result))
               {
               echo '
           <tr><td valign="top"><div><strong>"'.$row['username'].'"</strong></div><div>"'.$row['msg'].'"</div><td align="right" valign="top">"'.$row['date_time'].'"</td></tr>';
            }
                
           ?>
        </tbody>
        </table>
        </div>
    </div>
</body>
</html>