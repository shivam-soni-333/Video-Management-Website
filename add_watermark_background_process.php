<?php 
    if(isset($argv))
    {
        require("db_con.php");
           $video_id = $argv[1];
           $input_video_name = $argv[2];
           $output_video_name = $argv[3];
           $watermark_text = $argv[4];
           $sql_update_video_status = "update videos set is_watermarked=-1 where id=$video_id";
           $result_video_update = mysqli_query($con,$sql_update_video_status);
           if($result_video_update)
           {
                exec("ffmpeg -i $input_video_name -vf \"drawtext=text='$watermark_text':x=10:y=30:fontsize=60:fontcolor=red\" -y   $output_video_name",$output,$exit_code);
                if($exit_code == 0) // it means success
                { 
          
                    $sql_for_update_video_row = "update videos SET is_watermarked='1',watermark_text=\"$watermark_text\",watermark_video_nm='$output_video_name' where id=$video_id";
            
                    $result_for_sql = mysqli_query($con,$sql_for_update_video_row);
                    if($result_for_sql)
                    {
                        echo "done";
                    }else{
                        echo "error while updating video row";
                    }

                }else{
                    echo "ffmpeg error";
                    print_r($output);
                    print_r($exit_code);
                }
           }else{
            echo "error while -1";
           }
    }else{
        echo "command line argument  not found";
    }
?>