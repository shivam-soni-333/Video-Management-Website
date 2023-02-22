<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="./css/header.css" rel="stylesheet">
    <link  rel="stylesheet" href="./css/header.css">

    <?php if (basename($_SERVER['PHP_SELF']) === 'index.php') { ?>
      <link rel="stylesheet" href="./css/index.css">
    <?php }elseif(basename($_SERVER['PHP_SELF']) === 'upload.php')  {?>
      <link rel="stylesheet" href="./css/upload.css">
      <?php } ?>
    
</head>
<?php 
  if(session_id() == "")
  {  
    session_start();
  }
?>
<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php if(isset($_SESSION["sessionid"]))
        { ?>
         

          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="upload.php">Upload</a>
          </li>

          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="my_videos.php">My Videos</a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
          
        <?php }else{?>
        
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li> 
        <?php } ?>          
        
      
    </ul>
