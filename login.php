<?php 
 
    require("db_con.php");
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $data = json_decode(file_get_contents("php://input"),true);
      
        if(count($data)==2 and isset($data["username"]) and isset($data["password"]) and $data["username"] !="" and $data["password"]!="")
        {
            
       
            $username = htmlspecialchars(strip_tags($data["username"])).trim(" ");
            $password = htmlspecialchars(strip_tags($data["password"])).trim(" ");
    
            $sql = " select * from users where (username='$username' and password = '$password') or (email = '$username' and password='$password')";
            $result = mysqli_query($con,$sql);
         
            if($result->num_rows > 0)
            {
               while($row= $result->fetch_assoc())
               {
                   $password = $row["password"]; // password 
                   $username = $row["username"]; // username 
                   $id = $row["id"];
                   $role = $row["role"];
               }
               $ts = time()+3600;
               $sessionid = bin2hex(random_bytes(16)); // generate random bytes and convert it to hex
               $sql = "insert into sessions(user_id,sessionid,expire) values($id,'$sessionid','$ts')"; // insert session into sessions table 
               $result = mysqli_query($con,$sql); // fire insert query
               if($result)
               {
                    session_start();
                    $_SESSION["sessionid"] = $sessionid;
                    setcookie("sessionid",$sessionid,$ts);
                    echo true;
               }else{
                echo "cannot able to create session";
               }
                
            }
            else{
                echo "Invalid Username and password"; 
            }
        }
        else{
            echo "Please Supply username or password";
         
        }
        die();
    }
    include("header.php");
   
?>
    <div class="container" style="margin-left:30%;margin-top:15%;border:2px solid #F99417;width:40%;padding:20px;padding-left:10%">
        <span id="response_msg" style="color:red;"></span>
        <div class="form-group w-50">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div><br>
        <div class="form-group w-50">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div><br>
        
        
            <button type="submit" id="submit" class="btn btn-primary">Submit</button>   
    </div>
    <script>
        
       

        var btn = document.getElementById("submit");
        btn.addEventListener("click",(e)=>{
            var unm = document.getElementById("email");
            var password = document.getElementById("password");
            unm = unm.value;
            password = password.value.trim(" ");
            if(unm !="" && password !="")
            {
                data = {"username":unm,"password":password};
                const xhr = new XMLHttpRequest();
                xhr.open("post","login.php",true);
                xhr.send(JSON.stringify(data));
                xhr.onreadystatechange = function()
                {
                    if(xhr.responseText == 1)
                    {
                        window.location.href="http://localhost/video_managment_website/index.php";
                    }
                    
                    document.getElementById("response_msg").innerHTML = ("<p>"+xhr.responseText+"</p>");
                }
            }else{
                document.getElementById("response_msg").innerHTML = ("<p>Blank</p>");
            }
          
        });
    </script>
</body>
</html>