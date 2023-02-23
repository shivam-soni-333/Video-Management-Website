<?php 
    require("db_con.php");
    include("header.php");
    if(!isset($_SESSION["sessionid"]))
    {
        header("Location:http://localhost/video_managment_website/index.php");
    }
    $user_id = $_SESSION["user_id"];
    $get_videos_from_db_sql  = "select * from videos where user_id=$user_id";
    $result_get_videos_from_db = mysqli_query($con,$get_videos_from_db_sql);
    if($result_get_videos_from_db->num_rows >0)
    {
        $get_folder_details = "select * from base_folder where user_id=$user_id";
        $result_of_folder_details = mysqli_query($con,$get_folder_details);
        if($result_of_folder_details->num_rows>0)
        {
            
            while($row = $result_of_folder_details->fetch_assoc())
            {
                $folder_name = $row["folder_name"];
            }
           
        }
        else{
            echo "Error while fetching folder of user";
            
        }
        ?> 
     <div class="container">
        <div class="row">
    
    <?php // get video from database and loop over bootstrap container
        while($get_video_details = $result_get_videos_from_db->fetch_assoc())
        {
            $video_id = $get_video_details["id"];
            $video_title = $get_video_details["title"];
            $folder_id = $get_video_details["folder_id"];
            $thumbnail = $get_video_details["thumbnail_nm"];
            $gif_nm  = $get_video_details["gif_nm"];
            $video_nm = $get_video_details["video_nm"]; 

            if($thumbnail =="./default_thumbnail.jpg")
            {
                $thumbnail_full_path = $thumbnail;
            }else{
                $thumbnail_full_path = "./uploads/video/$folder_name/$thumbnail";
            }
            
            $gif_path = "./uploads/video/".$folder_name."/".$gif_nm;
          ?>
   
                <div class="col-sm-4">  
                    <div class="card" style="width: 18rem;">
                        <img src="<?=(isset($thumbnail_full_path))?$thumbnail_full_path:"#"?>" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title"><?=$video_title?></h5>
                        <a href="http://localhost/video_managment_website/get_video_details.php?video_id=<?=$video_id?>" class="btn btn-primary">Get Video Details</a>
                        <input type="hidden"  id="gif_path" value="<?=$gif_path?>">
                        <input type="hidden"  id="img_path" value="<?=$thumbnail_full_path?>">
                        </div>
                    </div>
                </div>
                
            
                <?php   
        }
       
    }else{  
        echo "Error While Fetching videos  From db";
    }
  
?>           
            </div> <!-- end row class-->
        </div> <!-- end container-->
    <script>
        var ele = document.getElementsByClassName("col-sm-4");
       for(let i=0;i<ele.length;i++)
       {
           ele[i].addEventListener('mouseover',(e)=>{
                if(!ele[i].classList.contains('hov'))
                {
                    ele[i].className +=' hov';
                    let card = ele[i].getElementsByClassName('card')[0];        
                    var img = card.getElementsByTagName('img')[0];
                  
                    var gif_path = card.getElementsByTagName("input")[0];
                    img.setAttribute('src',gif_path.value); 
                    img.setAttribute('height','150px');

                }else{
                 
                }
           });
       }
       
       for(let i=0;i<ele.length;i++)
       {
           ele[i].addEventListener('mouseout',(e)=>{
            if(ele[i].classList.contains('hov'))
            {
                ele[i].classList.remove('hov');
                let card = ele[i].getElementsByClassName('card')[0];
                let img  = card.getElementsByTagName('img')[0];
                var img_path =card.getElementsByTagName("input")[1];
                img.setAttribute('src',img_path.value);
                img.removeAttribute('height');
            }});
       }
    </script>
    </body>
</html>