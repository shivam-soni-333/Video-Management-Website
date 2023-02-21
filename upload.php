<?php 
    require("db_con.php");
    session_start();
    if(!isset($_SESSION['sessionid']))
    {   
        header("Location:http://localhost/video_managment_website/index.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        $vnm = $_FILES['video']['name'];
        $pos = strpos($vnm,".");
        $file_nm_without_ext =  substr($vnm,0,$pos); 

        move_uploaded_file($_FILES['video']['tmp_name'],'./uploads/video/user1/'.$vnm);
        // $cmd = "ffmpeg -i \"C:\\xampp\\htdocs\\Video_managment_website\\uploads\\video\\user1\\$vnm\" \"C:\\xampp\\htdocs\\Video_managment_website\\uploads\\video\\user1\\$file_nm_without_ext.mkv\" \"C:\\xampp\\htdocs\\Video_managment_website\\uploads\\video\\user1\\$file_nm_without_ext.avi\" \"C:\\xampp\\htdocs\\Video_managment_website\\uploads\\video\\user1\\$file_nm_without_ext.webm\" ";
        // pclose(popen("start /B $cmd","r"));
        // $insert_q = "insert into video_process(name,userid,base_folder_path,video_name,is_converted) values($_POST['title'],$_SESSION['id'])";
        echo "File Uploaded Successfully!    ";
        die();
    }
    include('header.php');  
    
?>
<br>
    <center> <div class="upload_success" style="display:inline;color:green;margin-top:100px;"></div> </center>
    <div class="container">
        <form >
            <div class="mb-3 w-50">
                <label for="exampleInputEmail1" class="form-label in">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title"  aria-describedby="emailHelp">
            </div>
            <progress value="5" max="100" style="color:green;" id="pro"></progress>
            <div class="mb-3 w-50">
                <label for="video_upload" class="form-lable in">Video:- </label><span></span>
                <input type="file" class="form-control"  name="video" id="video_input" accept="video/*"/>
            </div>

            <button type="button" id="sub" class="btn btn-primary space" name="submit">Submit</button>
          
        </form>

    </div>
            <script>
                var btn = document.getElementById("sub");
                var pro = document.getElementById("pro");
                var frm = document.getElementsByTagName("form")[0];
                btn.addEventListener("click",(e)=>{
                    var xhr = new XMLHttpRequest();
                    xhr.open("post","upload.php",true);
                    var formdata= new FormData();
                    let video = document.getElementById("video_input");
                    formdata.append("video",video.files[0]);
                    xhr.upload.addEventListener("progress",(event)=>{
                        if(event.lengthComputable){
                            const percentage = (event.loaded/event.total)*100;
                            pro.value += percentage;
                        }
                    })
                    xhr.send(formdata);
                    xhr.onreadystatechange = function()
                    {
                        if(this.readyState == 4 && this.status == 200)
                        {
                            var msg = document.getElementsByClassName('upload_success')[0];
                            var mg =  "<p>"+xhr.responseText+"</p>";
                            msg.innerHTML =mg;
                            console.log(mg);
                            frm.reset();
                            pro.value = 0;
                        }
                    }
                });

             
            </script>

        
    </body>
</html>