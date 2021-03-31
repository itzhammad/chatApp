<?php
class chatRoom{
    function insert_data(int $userid, string $msg, string $datee)
    {
        $con = mysqli_connect("localhost","root","","chatapp");
        $query ="INSERT INTO `chat_history`(`user_id` , `msg`, `date_time`) VALUES ('$userid','$msg','$datee')";
        $result = mysqli_query($con,$query);
    }
}
?>