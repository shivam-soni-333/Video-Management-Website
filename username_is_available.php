<?php 
    require("db_con.php");
    if(isset($_POST['username']))
    {
   
        $unm = htmlspecialchars(strip_tags($_POST['username']));
        $result = mysqli_query($con,"select * from users where username='$unm'");
        
        if($result->fetch_row() > 0)
        {
            echo "false";
        }else{
            echo "true";
        }
    }
?>