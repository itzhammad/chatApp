<?php
include 'connection.php';
session_start();
$query ="SELECT * FROM `friend_requests` WHERE `receiver` = '".$_SESSION['userid']."' and `active` = 1";
$result = mysqli_query($con,$query);
$number_of_requests = mysqli_num_rows($result);
if($result)
{
    $query1 = "SELECT users.username, users.user_id FROM users INNER JOIN friend_requests ON users.user_id = friend_requests.sender WHERE friend_requests.receiver = '".$_SESSION['userid']."' and `active` = 1";
    $result1= mysqli_query($con,$query1);
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
                <?php echo "<td colspan='5'>Pending: <span class='blue'>".$number_of_requests."</span></td>"?>
                <td> </td>
                <td> </td>
            </tr>
        <?php
        while ($row= mysqli_fetch_array($result1))
        {
        echo "
            <tr>
                <td colspan='5'>".$row['username']."</td>
                <td><a class='request' href='accept.php?id=".$row['user_id']."'>Accept</a></td>
                <td><a class='request' href='deny.php?id=".$row['user_id']."'>Deny</a></td>
            </tr>
        ";
        }
        ?>
        </table>
        </div>
    </div>
</body>
</html>