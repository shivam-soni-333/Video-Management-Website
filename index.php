<?php
    require("db_con.php");
    include('header.php');
?>
        <div class="container">
            <div class="row"> 
            <?php
                $sql_for_fetch_video="select videos.id,title,videos.user_id,thumbnail_nm,gif_nm,video_nm,folder_name from videos inner join base_folder on videos.folder_id=base_folder.id;";
                $result_for_fetch_videos = mysqli_query($con,$sql_for_fetch_video);
                if($result_for_fetch_videos)
                {
                    while($row=$result_for_fetch_videos->fetch_assoc())
                    {  
                        $video_id = $row["id"];
                        $video_title = $row["title"];
                        $video_user_id = $row["user_id"];
                        $thumbnail_nm = $row["thumbnail_nm"];
                        $gif_nm = $row["gif_nm"];
                        $video_nm = $row["video_nm"];
                        $folder_nm = $row["folder_name"];
                        
                        $folder_path = "./uploads/video/".$folder_nm."/";
                        if($thumbnail_nm  == "./default_thumbnail.jpg")
                        {
                           
                        }else{
                            $thumbnail_nm = $folder_path . $thumbnail_nm;
                        }
                        $gif_path = $folder_path.$gif_nm;

                        ?>

                        <div class="col-sm-4">  
                            <div class="card" style="width: 18rem;">
                                <img src="<?=$thumbnail_nm?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title"><?=$video_title?></h5>
                                <a href="video_details.php?video_id=<?=$video_id?>" class="btn btn-primary">Play Video</a>
                                <input type="hidden"  id="gif_path" value="<?=$gif_path?>">
                                <input type="hidden"  id="img_path" value="<?=$thumbnail_nm?>">
                                </div>
                            </div>
                        </div>

                <?php       }
                }else{
                    echo "<p style='color:red'>Error while feteching video</p>";
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