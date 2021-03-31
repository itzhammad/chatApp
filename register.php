<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <title>Register</title>
</head>
<body>
    <div class="container">

        <h1 class="purple">Welcome to Chat App</h1>
        <p>The online communicate platform</p>
        <form action="authenticate.php" method="POST" enctype="multipart/form-data">
            <label for="">Username:</label>
            <input type="text" required name="username"><br>
            <label for="">Email:</label>
            <input type="email" required name="email"><br>
            <label for="">Password:</label>
            <input type="password" required name="password"><br>
            <label for="">Confirm Password:</label>
            <input type="password" required name="confirm_password"><br>
            <label for="">Add Your Profile Image: </label>
            <input type="file" name="profile_image"><br>

            <button class="request" type="submit" name="register">Register</button>
            <a class="request" href="index.php" name="login">login</a>
        </form>
        <?php
        if(isset($_GET['id']))
        {
        echo 'Registration done! Your User ID is: '.$_GET['id'].'<br> Press login to go back to login page and login with this id';
        }
        ?>
    </div>
    
</body>
</html>
