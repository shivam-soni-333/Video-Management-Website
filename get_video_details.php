<?php 
    require("db_con.php");
    include("header.php");

    if(!isset($_SESSION["sessionid"]))
    {
        header("Location:http://localhost/video_managment_website/index.php");
    }

    if(isset($_GET["video_id"]))
    {
        $video_id = htmlspecialchars(strip_tags($_GET["video_id"]));
        $user_id = $_SESSION['user_id'];
        $get_video_details_sql = "select * from videos where id=$video_id and user_id=$user_id";
        $result=mysqli_query($con,$get_video_details_sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                $video_id = $row["id"]; 
                $video_title = $row["title"];
                $video_nm = $row["video_nm"];
                $is_converted = $row["is_converted"];
            }
            $folder_name = $_SESSION["folder_name"];
            $video_nm_without_ext = substr($video_nm,0,strpos($video_nm,"."));
            $webm = "./uploads/video/".$folder_name."/".$video_nm_without_ext.".webm";
           
            $mkv = "./uploads/video/".$folder_name."/".$video_nm_without_ext.".mkv";
            
            $ogg = "./uploads/video/".$folder_name."/".$video_nm_without_ext.".ogg";
        }
    }else{
        echo "<p style='color:red;'>Please give video id!</p>";
    }
?>
    <video id="video" src="./uploads/video/<?=$folder_name?>/<?=$video_nm?>" width="500" heigt="500" style="margin-left:530px;margin-top:100px;" controls></video>
    <br>
    <div class="btn" style="width:50%;margin-left:400px;margin-top:40px">
        <input type="hidden" id="is_conveted" value="<?=$is_converted?>"></input>
        <button class="change_play_format btn btn-primary" value="<?=$webm?>">WEBM Format</button>
        <button class="change_play_format btn btn-success" value="<?=$mkv?>" >MKV Format</button>
        <button class="change_play_format btn btn-info" style="color:white;" value="<?=$ogg?>">OGG Format</button>
    </div>
    <script>
        var is_converted = document.getElementById("is_conveted").value;
        if(is_converted == 1)
        {
            var  change_format = document.getElementsByClassName("change_play_format");
            for(let i =0;i<change_format.length;i++)
            {
                change_format[i].addEventListener("click",(e)=>{
                    var video_tag = document.getElementById("video");
                    video_tag.src = change_format[i].value;
                })
            }
        }else{
            alert("Convertion is in progress");
        }
        

    </script>
</html>
</body>