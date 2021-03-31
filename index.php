<?php
session_start();
if(isset($_SESSION['userid']) || isset($_COOKIE['userid']))
{
  header('location: online.php');
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <title>Login</title>
</head>
<body>
    <div class="container">

        <h1 class="purple">Welcome to Chat App</h1>
        <p>The online communicate platform</p>


        <form action="authenticate.php" method="POST">
            <label for="">User ID:</label>
            <input type="text" required name="user_id"><br>
            <label for="">Password:</label>
            <input type="password" required name="password"><br>
            <input type="checkbox" name="remember"> Remember your login status <br>
            <button class="request" type="submit" name="login">Login</button>
            <a class="request" href="register.php" name="register">Register</a>
        </form>

    </div>
    
</body>
</html>
<?php
}
?>