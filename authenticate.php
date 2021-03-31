<?php
include "connection.php";

if(isset($_POST['login']))
{
    $user_id = $_POST['user_id'];
    $pass = $_POST['password'];
    $query = "select * from users where user_id ='$user_id' and password = '$pass' ";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) == 1)
    {
        if($_POST['remember'])
        {
            setcookie("userid",$user_id,time()+60*60*7);
        }
        session_start();
        $login_status = 1;
        $last_login = date('Y-m-d h:i:s A');
        $query1 = "UPDATE `users` SET `login_status`='$login_status',`last_login`='$last_login' WHERE `user_id`='$user_id'";
        $result1 = mysqli_query($con,$query1);
        $_SESSION['userid']=$user_id;
        $_SESSION["username"] = $row['username'];
        header("location:online.php");
    }

    else{
        echo "<script>alert('Invalid Username or Password');
        window.location.href='index.php';</script>";
    }
}
elseif(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];
    $file = $_FILES['profile_image'];
    if($pass==$cpass)
    {
    $file_name = $_FILES['profile_image']['name'];
    $file_tmpname = $_FILES['profile_image']['tmp_name'];
    $file_error = $_FILES['profile_image']['error'];
    // $file_size = $_FILES['profile_image']['size'];
    // $file_type = $_FILES['profile_image']['type'];
    $file_ext = explode(".",$file_name);
    $file_check = strtolower(end($file_ext));
    $file_ext_wanted= array('png','jpg','jpeg');
    if(in_array($file_check,$file_ext_wanted)){
        $file_path = 'uploads/'.$file_name;
        move_uploaded_file($file_tmpname,$file_path);
        // print_r ($file_ext);
        $query = "INSERT INTO `users`(`username`, `email`, `password`, `confirm_password`, `profile_image`) VALUES ('$username','$email','$pass','$cpass','$file_path')";
        $result = mysqli_query($con,$query);
        if($result)
        {
            $query = "select * from users where username ='$username' and password = '$pass'";
            $result = mysqli_query($con,$query);
            $row =mysqli_fetch_array($result);
            // session_start();
            // $_SESSION['userid'] = $row['user_id'];
            header("location:register.php?id='".$row['user_id']."'");
        }
    }
}
else
{
    echo "<script>alert('Passwords Donot Match');
        window.location.href='register.php';</script>";
}
   
}

else
{
    header("location:index.php");
}
?>