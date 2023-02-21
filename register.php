<?php

    require("db_con.php"); 
  
    mysqli_select_db($con,"video_managment");
        
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data = json_decode(file_get_contents('php://input'),true);
        if(count($data) == 4 and $data["name"] != "" and $data["email"] != "" and $data["password"] != "" && $data["username"] !="")
        {
            $name =  htmlspecialchars(strip_tags($data['name'])).trim(' ');
            $email =  htmlspecialchars(strip_tags($data['email'])).trim(' ');
            $password = htmlspecialchars(strip_tags($data['password'])).trim(' ');
            $username = htmlspecialchars(strip_tags($data["username"])).trim(' ');
            $role ="user";
            $pattern = "/^[a-zA-Z0-9_]+$/"; // regex for validating username contains only a-z A-Z 0-9 and underscore
            $is_match =preg_match($pattern,$username); // regex matching function
            if($is_match == 1)
            {
                $sql ="select * from users where username='$username'";
                $result = mysqli_query($con,$sql);
                if($result->fetch_row() > 0) // result > 0 means username is already exists 
                {
                    echo "UserName is not Available ";
                    die();
                }else{ // username is not exists so we can create username
                    $sql = "insert into users(name,email,password,role,username)values('$name','$email','$password','$role','$username')";
                    $response_of_db = mysqli_query($con,$sql);
                    if($response_of_db)
                    {
                        $user_id = mysqli_insert_id($con); // get user  id of above query
                        $fnm = $username."_".$user_id;
                        
                        $is_folder_created = mkdir("./uploads/video/$fnm"); // creates dedicated folder 
                        if($is_folder_created) // if it is true then folder is created
                        {
                            $sql = "insert into base_folder(user_id,folder_name)values($user_id,'$fnm')";//create dedicated folder for user 
                            $result = mysqli_query($con,$sql);
                            if($result)
                            {
                                echo "User Registered Succesfully!";
                            }else{
                                echo "Error While Creating User";
                            }
                        }else{
                            echo "errro while creating user";
                        }
                     
                    }else{
                        echo "Error while creating user";
                    }
                }          
            }else{
                echo "Username does not statisfy criteria";
                die();
            }
            
        }else{
            echo "Please Supply All the Values of registration form";
        }
        die();
    }
    include("header.php");
?>
    <div style='margin-left:450px;margin-top:70px;border:2px solid #F99417;width:50%;padding-left:250px;padding-top:20px;padding-bottom:20px;'>
      
            <span id="response_msg" style="color:green;"></span>
            <div class="form-group w-50">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="input_nm" aria-describedby="emailHelp" placeholder="Enter Name">
            </div><br>
            <div class="form-group w-50">
                <label for="exampleInputEmail1">UserName</label>
                <input type="text" class="form-control" id="input_unm" aria-describedby="emailHelp" placeholder="Enter UserName">
                <small id="js_msg" class="form-text" style="color:red;"></small>
            </div><br>
            <div class="form-group w-50">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="input_email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div><br>
            <div class="form-group w-50">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="input_password" placeholder="Password">
            </div>
            <br>
        <span style="margin-left:65px;">  <button type="submit" id="submit" class="btn btn-primary" >Submit</button><br> </span>
        
    </div>
    <script>
        const btn = document.getElementById("submit");
        const unm = document.getElementById("input_unm");
        const js_msg = document.getElementById("js_msg");
        const pattern = /^[a-zA-Z0-9_]+$/;

        function validateusername(username)
        {
            return pattern.test(username);
        }
     
        
        unm.addEventListener("change",(e)=>{
            var username = unm.value;
            var is_space = (username.search(" "));
            const found = validateusername(username);
             
            if(is_space == -1 && found == true )
            {
                js_msg.innerHTML = "";   
                const xhr = new XMLHttpRequest();
                xhr.open("post","username_is_available.php",true);
                var formdata = new FormData();
                formdata.append("username",username);
                xhr.send(formdata);
                xhr.onreadystatechange = function()
                {
                    if(xhr.readyState == 4 && xhr.status == 200)
                    {
                        console.log(xhr.responseText);
                       if(xhr.responseText == "true"){
                        js_msg.innerHTML = "";
                       }else{
                        js_msg.innerHTML = "Username is not Availble";
                       }
                    }
                }
            }else{
                js_msg.innerHTML = "only [a-z] [A-Z] [0-9] and underscore(_) are allowed.";
            }
        });

        btn.addEventListener("click",(e)=>{
            e.preventDefault();
            btn.setAttribute("disabled",true);
            var name = document.getElementById("input_nm").value;
            var email = document.getElementById("input_email").value;
            var password = document.getElementById("input_password").value;
            var username = unm.value;
            const found = validateusername(username);
            if (found == true)
            {
                var xhr = new XMLHttpRequest();
                var data = {"name":name,"email":email,"password":password,"username":username};
                data = JSON.stringify(data); // convert datascript object(dict) to json
                xhr.open('post','register.php',true);
                xhr.send(data);
            
                xhr.onreadystatechange =function()
                {
                    if(this.readyState == 4 && this.status == 200)
                    {
                        document.getElementById("response_msg").innerHTML=`${xhr.responseText}`;
                        console.log(`${xhr.responseText}`);
                    }
                }
                clear();
            }else{
                js_msg.innerHTML = "only [a-z] [A-Z] [0-9] and underscore(_) is allowed";
                btn.removeAttribute('disabled');
            }
          
        });
        function clear()
        {
            document.getElementById("input_nm").value='';
            document.getElementById("input_email").value='';
            document.getElementById("input_password").value='';
            unm.value="";
            document.getElementById("submit").removeAttribute("disabled");
        }

       
    </script>
</body>
</html>