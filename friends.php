<?php
include 'connection.php';
session_start();
if(isset($_SESSION['userid']) || isset($_COOKIE['userid']))
{
$login_status = 1;
$query ="SELECT users.username,users.user_id FROM users INNER JOIN friends ON (users.user_id = friends.user_one OR users.user_id = friends.user_two) AND users.user_id NOT IN ('".$_SESSION['userid']."')";
$result = mysqli_query($con,$query);
$friends = mysqli_num_rows($result);
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
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
    <div class="color">
        <div class="top">
            <?php echo "<p>Welcome! <span class='cyan'>".$_SESSION['username']."</span> Let's start chatting with friends.</p>" ?> 
            <a class="logout" href="logout.php">Logout</a>
        </div>
        <div class="button-bar">
        <span>Friends: </span>
            <a href="online.php">Online</a>
            <a href="friends.php">Friend List</a>
            <a href="pending.php">Pending</a>
            <a href="add_new_friends.php">Add new friends</a>
        </div>
        </div>
        <div>
        <table>
            <tr>
                <?php echo "<td colspan='5'>Friends: <span class='blue'>".$friends."</span></td>"?>
                <td> </td>
                <td> </td>
            </tr>
        <?php
        while ($row= mysqli_fetch_array($result))
        {
        echo "
            <tr>
                <td colspan='5'>".$row['username']."</td>
                <td><a class='request' href='chat.php?id=".$row['user_id']."'>Chat</a></td>
            </tr>
        ";
        }
        ?>
        </table>
        </div>
    </div>
</body>
</html>