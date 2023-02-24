<?php
    require("db_con.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"]== "POST")
    {
       
        $video_id = $_POST["video_id"];
        $user_id = $_SESSION["user_id"];
        $watermark_text = $_POST["watermark_text"];
        $sql_for = "select * from videos where id=$video_id and user_id=$user_id";
        $result_of_video = mysqli_query($con,$sql_for);
        if($result_of_video->num_rows>0)
        {
            while($row=$result_of_video->fetch_assoc())
            {
               $video_name= $row["video_nm"];
               $folder_id = $row["folder_id"];
            }
            $folder_name = $_SESSION["folder_name"];
            $folder_path = "./uploads/video/".$folder_name."/";
            $input_video_name = $folder_path.$video_name;
            $watermark_video_name = substr($video_name,0,strpos($video_name,"."))."_watermarked_".time().".mp4";
            $output_video_name = $folder_path.$watermark_video_name ; 
            
            $sql_for_validation = "select * from videos where id=$video_id";
            $result_for_validation = mysqli_query($con,$sql_for_validation);
            if($result_for_validation->num_rows>0){
                while($row=$result_for_validation->fetch_assoc())
                {
                    $is_watermarked=$row["is_watermarked"];
                    if($is_watermarked == -1)
                    {
                        echo "Video is already in process of watermark";
                    }else{
                        $cmd = "php add_watermark_background_process.php $video_id $input_video_name $output_video_name \"$watermark_text\"";
                        pclose(popen("start /B $cmd","r"));
                        
                        // pclose(popen("start /B $cmd","r"));
                        // echo "true";
                    }
                }
            }
          
            
            
        }else{
            echo "no record";
        }
    }
    else{
        echo "no post method";
    }

// pclose(popen('ffmpeg -i'. $input_video_name.' -vf "drawtext=text\'this is sample text\':x=10:y=H-th-10:fontfile=C:\xampp\htdocs\Video_managment_website\font.ttf:fontsize=12:fontcolor=red" '.$output_video_name.''));
?>