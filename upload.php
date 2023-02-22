<?php 
    require("db_con.php");
    if(session_id() == '')
    {
        session_start();
    }
    if(!isset($_SESSION['sessionid']))
    {   
        header("Location:http://localhost/video_managment_website/index.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        if(isset($_FILES["video"]) and isset($_POST["title"]) and isset($_POST["thumbnail"])  and count($_FILES) == 1  )
        {
            if($_POST["title"] !="" )
            {
                $title = htmlspecialchars(strip_tags($_POST['title']));
                $thumbnail = ($_POST["thumbnail"]=="")?"./default_thumbnail.jpg":htmlspecialchars(strip_tags($_POST["thumbnail"]));
               
                $video_nm = htmlspecialchars(strip_tags($_FILES["video"]["name"]));
                $tmp_name = htmlspecialchars(strip_tags($_FILES["video"]["tmp_name"]));
                $type = htmlspecialchars(strip_tags($_FILES["video"]["type"]));
                $uid = $_SESSION['user_id']; // user id 
                $username = $_SESSION["username"];
                if($type=='video/mp4')
                {
                    $sql_for_folder = "select * from base_folder where(user_id=$uid)"; // get folder of particular user
                    $result_of_folder = mysqli_query($con,$sql_for_folder); // execute query
                   
                    if($result_of_folder) // if query returns folder 
                    {
                        while($row = $result_of_folder->fetch_assoc()) 
                        {
                           $folder_id= $row["id"] ; //get folder id
                           $folder_name = $row["folder_name"] ; // get folder name
                        }
                        $folder_path = ".\\uploads\\video\\".$folder_name."\\";
                       
                        $uploaded_video_nm = $uid."_".$username."_video_".time().".mp4"; // generate random video name 
                        $uploaded_video_nm_without_ext = substr($uploaded_video_nm,0,strpos($uploaded_video_nm,"."));
                      
                        if( move_uploaded_file($tmp_name,($folder_path.$uploaded_video_nm)))
                        {
                                $cmd = 'ffmpeg -ss 00:01:30 -t 10 -i "'.$folder_path.$uploaded_video_nm.'" "'.$folder_path.$uploaded_video_nm_without_ext.'.gif"';
                                $output_ffmpeg = array();
                                exec($cmd,$output_ffmpeg,$exit_code);
                                $gif_nm = $uploaded_video_nm_without_ext.".gif";
                                if($exit_code == 0)
                                {
                                    $insert_video_details_query = "insert into videos(title,user_id,folder_id,thumbnail_nm,gif_nm,video_nm,is_converted)values('$title',$uid,$folder_id,'$thumbnail','$gif_nm','$uploaded_video_nm','false')";
                                    $result_of_video_details_query = mysqli_query($con,$insert_video_details_query);  
                                    if($result_of_video_details_query)
                                    {
                                        echo "true";// video uploaded succesfully!
                                    }else{ // if we cannot able to insert video details then simply discard it from server 
                                        echo "error while inserting video details into database";
                                       if(unlink(($folder_path.$uploaded_video_nm)))
                                       {
                                            echo "Video Deleted Succesfully";
                                       }
                                       if(unlink(($folder_path.$gif_nm)))
                                       {
                                            echo "Gif Deleted Succesfully";
                                       }
                                    }
                                }else{ // if we can't make gif then delete video from server ! 
                                    echo "Error while Creating GIF of video";
                                    if(unlink(($folder_path.$uploaded_video_nm)))
                                    {
                                        echo "File Deleted Succesfully";
                                    }
                                }
                                die();
                        }
                        else{
                            echo "error while moving video";
                        }
                    }
                    else{
                        echo "error while fetching folder";
                    }

                }else{
                    echo "Video Format is not Supported";
                }

            }else{
                echo "Title Cannot Be Blank";
            }

        }else{
            echo "Give All Required Fields";
        }
        die();
    }   
    include('header.php');  
    
?>
<br>
    
    <div class="container">
    <center> <div class="upload_success" style="color:green;margin-top:2px;width:30%"></div> </center>
   
        <span id="msg" style="color:red;"></span><br>
        <form >
            <div class="mb-3 w-50">
                <label for="title" class="form-label in">Title</label>
                <input type="text" class="form-control" id="title" name="title"  aria-describedby="emailHelp">
            </div>
            <div class="mb-3 w-50">
                <label for="thumbnail" class="form-label in">Thumbnail</label>
                <input type="file" class="form-control" accept="image/*" id="thumbnail" name="title"  aria-describedby="emailHelp">
            </div>
                <small>VideoUpload Progress Bar</small><br>
                <progress value="5" max="100" style="color:green;" id="pro"></progress>
            <div class="mb-3 w-50">
                <label for="video_upload" class="form-lable in">Video:- </label><span></span>
                <input type="file" class="form-control"  name="video" id="video_input" accept="video/*"/>
            </div>

            <button type="button" id="sub" class="btn btn-primary space" name="submit">Submit</button>
          
        </form>

    </div>
            <script>
                var btn = document.getElementById("sub"); // for submit
                var pro = document.getElementById("pro"); // for progressbar
                var frm = document.getElementsByTagName("form")[0]; // form 
                
                btn.addEventListener("click",(e)=>{
                    var xhr = new XMLHttpRequest();
                    xhr.open("post","upload.php",true);
                    var formdata= new FormData();
                    let video = document.getElementById("video_input");
                    let title = document.getElementById("title").value;
                    let thumbnail = document.getElementById("thumbnail").value;

                    if(title!="" && video.files[0] != "" )
                    {
                        formdata.append("video",video.files[0]);
                        formdata.append("title",title);
                        formdata.append("thumbnail",thumbnail);

                        xhr.upload.addEventListener("progress",(event)=>{
                            if(event.lengthComputable){
                                const percentage = (event.loaded/event.total)*100;
                                pro.value += percentage;
                            }
                        });

                        xhr.send(formdata);
                        xhr.onreadystatechange = function()
                        {
                            if(this.readyState == 4 && this.status == 200)
                            {
                                if(xhr.responseText == "true")
                                {
                                    var msg = document.getElementsByClassName('upload_success')[0];
                                    var mg =  "<p>Video Uploaded Succesfully!</p>";
                                    msg.innerHTML =mg;
                                    console.log(mg);
                                    frm.reset();
                                    pro.value = 0;
                                    document.getElementById("msg").innerHTML="";
                                }else{
                                    console.log(xhr.responseText);
                                    document.getElementById("msg").innerHTML=xhr.responseText;
                                    pro.value = 0;
                                    var msg = document.getElementsByClassName('upload_success')[0];
                                  msg.innerHTML="";
                                }
                               
                            }
                        }
                    }else{
                        alert("Please Supply all required fields");
                    }
                   
                }); // close btn click event

             
            </script>

        
    </body>
</html>