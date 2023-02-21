<?php
    $con = new mysqli("localhost","root","","video_managment");
    if(mysqli_connect_errno()){
        echo "failed to connect";
        exit();
    }
   
?>