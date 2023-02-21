<?php
    session_start();
    session_destroy();
    (isset($_SESSION["sessionid"])?:header("Location:http://localhost/video_managment_website/index.php"));
    require("db_con.php");
    $sid = htmlspecialchars(strip_tags($_SESSION["sessionid"])); // get sessionid into varaible
    $sql = "select * from sessions where sessionid='$sid'";
    $result = mysqli_query($con,$sql);
    if($result)
    {
        while($row=$result->fetch_assoc())
        {
           $db_session_id =  $row["id"];
        }
        $sql = "update sessions set expire='-1' where id=$db_session_id";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            header("Location:http://localhost/video_managment_website/index.php");
        }
        else{
            echo "Error While Logout!!!";
        }
    }
?>