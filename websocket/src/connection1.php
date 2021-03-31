<?php
class connection1{
    function getuserName(int $userid)
    {
        $con = mysqli_connect("localhost","root","","chatapp");
        $query ="SELECT * FROM `users` WHERE `user_id`= '$userid'";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_array($result);
        return $row['username'];
    }
}
?>