<?php 
    $con = mysqli_connect("localhost","root","","video_managment");
    if($con)
    {
       
        $vid =  $argv[1];
        $sql = "select * from videos where id=$vid";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            while($row=$result->fetch_assoc())
            {
                $fid = $row["folder_id"];
                $video_name = $row["video_nm"];
            }
            $video_name_without_extension = substr($video_name,0,strpos($video_name,"."));
        
            $sql_for_foldernm = "select * from base_folder where id=$fid";
            $result_for_foldernm = mysqli_query($con,$sql_for_foldernm);
            if($result_for_foldernm)
            {
                while($row2=$result_for_foldernm->fetch_assoc())
                {
                    $folder_name = $row2["folder_name"];
                }

                $folder_path = ".\\uploads\\video\\$folder_name\\";
                $source_video = ($folder_path.$video_name);
                $destination_video_mkv =  ($folder_path.$video_name_without_extension.".mkv");
                $destination_video_webm =  ($folder_path.$video_name_without_extension.".webm");
                $destination_video_ogg =  ($folder_path.$video_name_without_extension.".ogg");
                exec('ffmpeg -i '.$source_video.' '.$destination_video_mkv.' '.$destination_video_ogg.' '.$destination_video_webm.' > nul 2>&1 ',$output,$exit_code);
                if($exit_code ==0)// means success
                {
                    $update_sql_process_status = "update process set status='done' where vid=$vid";
                    $update_result = mysqli_query($con,$update_sql_process_status);
                    if($update_result)
                    {
                        $sql_for_update_video_status = "update videos set is_converted=1 where id=$vid";
                        $result_for_video_status = mysqli_query($con,$sql_for_update_video_status);
                        if($result_for_video_status)
                        {
                            echo "done";
                        }else{
                            echo "error while updating video status";
                        }
                    }else{
                        echo "error while updating process status";
                    }
                }

            }else{
                echo "error while fetching folder";
            }
        }
    }else{
        die("Connection failed");
    }

?>