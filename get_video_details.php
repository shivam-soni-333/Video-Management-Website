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
                $is_watermarked = $row["is_watermarked"];
                $watermarked_video_path = $row["watermark_video_nm"];
            }
            $folder_name = $_SESSION["folder_name"];
            $video_nm_without_ext = substr($video_nm,0,strpos($video_nm,"."));
            $webm = "./uploads/video/".$folder_name."/".$video_nm_without_ext.".webm";
           
            $mkv = "./uploads/video/".$folder_name."/".$video_nm_without_ext.".mkv";
            
            $ogg = "./uploads/video/".$folder_name."/".$video_nm_without_ext.".ogg";
        }
        else{
            echo "<p style='margin-left:35%;color:red;font-size:30px'>You are not owner of this video!</p>";
            die();
        }
    }else{
        echo "<p style='color:red;'>Please give video id!</p>";
    }
?>
    <?php if($is_watermarked == 0){?>
        <button class="btn btn-warning" id="modal_button" type="button" data-toggle="modal" data-target="#exampleModal" style="margin-top:80px;margin-right:520px;margin-bottom:4px;float:right;background-color:white;color:#F99417;">Add Watermark on video</button>
    <?php }elseif($is_watermarked == -1){
        echo "<span style='margin-left:620px;color:#AD7BE9;'>video is in process of watermarking ! wait for some time</span>";
    }else{?>
    <button id="show_watermarked_video"  class="btn btn-primary" style="margin-top:80px;margin-right:520px;margin-bottom:4px;float:right;background-color:white;color:#F99417;" value="<?=$watermarked_video_path?>">Show WaterMarked Video</button>
    <?php }?>
    <span id="msg" style="margin-left:500px;"></span>
        <video id="video" src="./uploads/video/<?=$folder_name?>/<?=$video_nm?>" width="500" heigt="500" style="margin-left:600px;margin-top:20px;" controls></video>
    <br>
    <input type="hidden" id="video_id" value="<?=$video_id?>">
    <span style="margin-left:44%;background-color:#AD7BE9;padding:10px">
        <span style="color:#F0EEED">Video Title :- </span><span style="color:#F0EEED;"><?=$video_title;?></span>
    </span>
    <br>
    <div class="btn" id="btn" style="width:50%;margin-left:400px;margin-top:40px;border:none">
        <input type="hidden" id="is_conveted" value="<?=$is_converted?>"></input>
        <button class="change_play_format btn btn-primary" value="<?=$webm?>">WEBM Format</button>
        <button class="change_play_format btn btn-success" value="<?=$mkv?>" >MKV Format</button>
        <button class="change_play_format btn btn-info" style="color:white;" value="<?=$ogg?>">OGG Format</button>
    </div>

    <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add watermark to this video</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Watermark Text</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Small" id="watermark_text" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close_modal_btn" data-dismiss="modal">Close</button>
                <button type="button" id="add_watermark"class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
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
        $(document).ready(function(){

            $("#modal_button").click((e)=>{
                    $('#exampleModal').modal('show');
                    
                $("#close_modal_btn").click((e)=>{
                    $("#exampleModal").modal('hide');
                });
     
                $(".close").click((e)=>{
                    $("#exampleModal").modal('hide');
                });
            });
        })
        function close()
        {
            $("#exampleModal").modal('hide');   
        }
        
        $("#add_watermark").click((e)=>{
            const video_id = document.getElementById("video_id").value;
            const watermark_text = document.getElementById("watermark_text").value;
            const xhr = new XMLHttpRequest();
            xhr.open("post","add_watermark.php",true);
            var formdata = new FormData();
            formdata.append("video_id",video_id);
            formdata.append("watermark_text",watermark_text);
            xhr.send(formdata);
            location.reload();
            xhr.onreadystatechange = function()
            {
                const msg = document.getElementById("msg");
                if(xhr.responseText == "true"){
                    console.log(xhr.responseText);
                    $("#exampleModal").modal('hide');   
                    msg.innerHTML= "Adding watermark process is on going it will take some time"; 
                    location.reload();  
                }else{
                    
                    console.log(xhr.responseText);
                    msg.innerHTML =xhr.responseText;
                }
            }

          
        });

        $("#show_watermarked_video").click((e)=>{
                    var video_tag = document.getElementById("video");
                    video_tag.src = document.getElementById("show_watermarked_video").value;
        });

    </script>
</html>
</body>