<?php

/*
    this script will runforever(24*7) in server . basically what is does is :-
    1. checks currently there are two ffmpeg processes are running ? 
        if yes 
            do nothing...
        if no (else)
            run script that creats ffmpeg conversion process 
*/

$con = mysqli_connect("localhost","root","","video_managment");
while(true)
{
    if($con)
    {
        $sql_process = "select * from process where status='converting'";
        $result = mysqli_query($con,$sql_process);

        if($result->num_rows==0)
        {
            $sql = "select * from videos where is_converted=0 limit 2";
            $result = mysqli_query($con,$sql);
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                    $vid = $row["id"];
                    $is_sql = "select * from process where vid=$vid"; // check if video is already in processing ? 
                    $result_sql = mysqli_query($con,$is_sql); // get result
                    if($result_sql->num_rows == 0) // if video is not in process table then create it's process
                    {
                        pclose(popen("start /B php conversion_process.php $vid","r"));
                        echo "starting process for Video :- $vid";
                        $sql_for_insert_process = "insert into process(vid,status) values($vid,'converting')";
                        $result_for_insert_process = mysqli_query($con,$sql_for_insert_process);
                        if($result_for_insert_process)
                        {
                            $video_update = "update videos set is_converted=-1 where id=$vid"; // -1 indicates video is in convertion 
                            $result_video_update = mysqli_query($con,$video_update);
                            if($result_video_update)
                            {

                            }else{
                                echo "Error Updating Video convertion status";
                            }
                        }else{
                            echo "error while inserting process to table for $vid";
                        }
                    }
                    else{
                        //echo "Process Already In DataBase $vid \n";
                    }
                }
            }
        }
        else if($result->num_rows == 1)
        {
            $sql = "select * from videos where is_converted=0 limit 1";
            $result = mysqli_query($con,$sql);
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                    $vid = $row["id"];
                    $is_sql = "select * from process where vid=$vid"; // check if video is already in processing ? 
                    $result_sql = mysqli_query($con,$is_sql); // get result
                    if($result_sql->num_rows == 0) // if video is not in process table then create it's process
                    {
                        pclose(popen("start /B php conversion_process.php $vid","r"));
                        echo "starting process for Video :- $vid";
                        $sql_for_insert_process = "insert into process(vid,status) values($vid,'converting')";
                        $result_for_insert_process = mysqli_query($con,$sql_for_insert_process);
                        if($result_for_insert_process)
                        {
                            $video_update = "update videos set is_converted=-1 where id=$vid"; // -1 indicates video is in convertion 
                            $result_video_update = mysqli_query($con,$video_update);
                            if($result_video_update)
                            {

                            }else{
                                echo "Error Updating Video convertion status";
                            }
                        }else{
                            echo "error while inserting process to table for $vid";
                        }
                    }
                    else{
                        //echo "Process Already In DataBase $vid \n";
                    }
                }
            }
        
        }else{

        }

    }else{
        echo "error while connecting to db";
    }
}



?>