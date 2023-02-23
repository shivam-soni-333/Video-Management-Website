<?php 
    require("db_con.php");
    include("header.php");

    if(!isset($_SESSION["sessionid"]))
    {
        header("Location:http://localhost/video_managment_website/login.php");
    }

    if(isset($_GET["video_id"]))
    {
        $video_id = htmlspecialchars(strip_tags($_GET["video_id"]));
        $user_id = $_SESSION['user_id'];
        $get_video_details_sql = "select videos.id,title,videos.user_id,thumbnail_nm,gif_nm,video_nm,is_converted,folder_name from videos inner join base_folder on videos.folder_id=base_folder.id where videos.id=$video_id;";
        $result=mysqli_query($con,$get_video_details_sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                $video_id = $row["id"];
                $video_title = $row["title"];
                $video_user_id = $row["user_id"];
                $thumbnail_nm = $row["thumbnail_nm"];
                $gif_nm = $row["gif_nm"];
                $video_nm = $row["video_nm"];
                $folder_nm = $row["folder_name"];
                $is_converted = $row["is_converted"];
                $folder_path = "./uploads/video/".$folder_nm."/";
                if($thumbnail_nm  == "./default_thumbnail.jpg")
                {
                   
                }else{
                    $thumbnail_nm = $folder_path . $thumbnail_nm;
                }
                $gif_path = $folder_path.$gif_nm;

                $video_nm_without_ext = substr($video_nm,0,strpos($video_nm,"."));
                $webm = "./uploads/video/".$folder_nm."/".$video_nm_without_ext.".webm";
           
                $mkv = "./uploads/video/".$folder_nm."/".$video_nm_without_ext.".mkv";
                
                $ogg = "./uploads/video/".$folder_nm."/".$video_nm_without_ext.".ogg";
            }
           
           
        }
    }else{
        echo "<p style='color:red;'>Please give video id!</p>";
    }
?>
    <video id="video" src="./uploads/video/<?=$folder_nm?>/<?=$video_nm?>" width="500" heigt="500" style="margin-left:530px;margin-top:100px;" controls></video>
    <br><br>
    <span class="user_details" style="margin-left:42%;border:2px solid #F99417;color:#AD7BE9;background-color:#F0EEED; padding:10px">
        <?php 
            $get_user_details = "select * from users where id=$video_user_id";
            $result_get_user_details= mysqli_query($con,$get_user_details);
            if($result_get_user_details->num_rows>0)
            {
                while($user_result = $result_get_user_details->fetch_assoc())
                { ?>
                  This Video is uploaded By  :- <?=$user_result["username"]?>
               <?php }
            }else {
                echo "Error Fetching User Details";
            }
        ?>
        
    </span>
    <br>
    <div class="btn" id="btn" style="width:50%;margin-left:400px;margin-top:40px;border:none">
        <input type="hidden" id="is_conveted" value="<?=$is_converted?>"></input>
        <button class="change_play_format btn btn-primary" value="<?=$webm?>">WEBM Format</button>
        <button class="change_play_format btn btn-success" value="<?=$mkv?>" >MKV Format</button>
        <button class="change_play_format btn btn-info" style="color:white;" value="<?=$ogg?>">OGG Format</button>
    </div>
    <script>
        var is_converted = document.getElementById("is_conveted").value;
        var btn = document.getElementById("btn");
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
            btn.innerHTML = "<p>Convertion of this video is in progress wait some times to see in different quality.</p>";
           
        }
        

    </script>
</html>
</body>