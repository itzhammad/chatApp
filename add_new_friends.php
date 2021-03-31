<?php
include 'connection.php';
session_start();
if(isset($_SESSION['userid']) || isset($_COOKIE['userid']))
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Add New Friends</title>
</head>

<body>
    <div class="container">
    <div class="color">
        <div class="top">
            <?php echo "<p>Welcome! <span class='cyan'>".$_SESSION['username']."</span> Let's start chatting with friends.</p>" ?>
            <a class="logout" href="logout.php">Logout</a>
        </div>
        <div class="button-bar">
            <a href="online.php">Online</a>
            <a href="friends.php">Friend List</a>
            <a href="pending.php">Pending</a>
            <a href="add_new_friends.php">Add new friends</a>
        </div>
        </div>
        <div>
            <h4 class="h4">You can add a friend with their user id: </h4>
            <form action="add_new_friends.php" method="POST" >
                <input class="search" type="text" name="search_user" size="35" placeholder="Enter user id"> <button class="request" type="submit" name="send">Send Request</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if(isset($_POST['send']))
{
$search_user = $_POST['search_user'];
$query ="SELECT * FROM `users` WHERE `user_id`='$search_user' and `user_id` not in ('".$_SESSION['userid']."') ";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) == 1)
{
    $q1 = "SELECT * FROM `friend_requests` WHERE (sender = '".$_SESSION['userid']."' and receiver = '$search_user') OR ( receiver = '".$_SESSION['userid']."' and sender = '$search_user') and active = 1";
    $r1 = mysqli_query($con,$q1);
    if(mysqli_num_rows($r1) >= 1)
    {
        echo "<p class='grey' >Request is in pending, Please Wait for Confirmation</p>";
    }
    // $q2 = "SELECT * FROM `friends` WHERE (user_one = '".$_SESSION['userid']."' and user_two = '$search_user') OR ( user_two = '".$_SESSION['userid']."' and user_one = '$search_user') and active = 1";
    // $r2 = mysqli_query($con,$q2);
    // elseif(mysqli_num_rows($r2) >= 1)
    // {
    //     echo "<p>You're already friends with this person</p>";
    // }
    else
    {
        $query1 ="INSERT INTO `friend_requests`(`sender`, `receiver`, `active`) VALUES ('".$_SESSION['userid']."' , '$search_user', 1 )";
        $result1 = mysqli_query($con,$query1);
        echo "<p class='grey'>Sent request to user id is '$search_user'<br>Waiting to Accept</p>";
    }
}
else
{
    echo "<p class='grey'>User id not found, please enter a valid user id</p>";
}
}
}
else
{
    header('location: index.php');
}
?>