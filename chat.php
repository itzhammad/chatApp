<?php
include 'connection.php';
session_start();
if(isset($_SESSION['userid']) || isset($_COOKIE['userid']))
{
$login_status = 1;
$second_user = $_GET['id'];
$query ="SELECT * FROM `users` WHERE `user_id`= '".$_SESSION['userid']."'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
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
            
                if($row1['login_status'] ==  1)
                {
                    echo "
                     <a id='green'>Online Status</a>";
                }
                else
                {
                    echo "
                    <a id='red'>Online Status</a>";
                }
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
        </tbody>
        </table>
        <form action="" method="POST">
            <?php
             echo '<input type="hidden" id="userId" name="userId" value="'.$_SESSION['userid'].'">';
            ?>
            <textarea name="msg" id="msg" placeholder="enter message" class="text" ></textarea>
            <button type="button" class="request" value="send" id="send" name="send">Send</button>
        </form>
        </div>
    </div>
</body>
<?php
if(isset($_POST['send']))
{
$_SESSION['scnd']=$_GET['id'];
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		var conn = new WebSocket('ws://localhost:8080');
		conn.onopen = function(e) {
		    console.log("Connection established!");
		};

		conn.onmessage = function(e) {
		    console.log(e.data);
            var data = JSON.parse(e.data);
            var row = '<tr><td valign="top"><div><strong>'+data.from+'</strong></div><div>'+data.msg+'</div><td align="right" valign="top">'+data.dt+'</td></tr>';
            $('#chats > tbody').append(row);
		};

		$("#send").click(function(){
			var userId 	= $("#userId").val();
			var msg 	= $("#msg").val();
			var data = {
				userId: userId,
				msg: msg
			};
			conn.send(JSON.stringify(data));
		});
		});

</script>
</html>