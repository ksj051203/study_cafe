<?php
  include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="test">
        <div class="test2">
<image src="/image/logo1.png" class="logo" onclick="location.href='index.php'">
    <div class="sign">
    <?php session_start(); // 세션 시작 ?>

    <div style = "font-size:20px;" onclick="location.href='graph.php'">
         <?php echo "graph" ?>
    </div>
    
    <div onclick="location.href='login.php'" style="font-size:20px;margin-left:60px;height:15px;">
        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo $_SESSION['id']."님";
            } else {
            echo "login";
        } ?>
    </div>

    <div style = "font-size:20px;margin-left:60px;height:15px;" onclick="location.href='sign.php'">
            <?php echo "signup"
         ?>
    </div>

    <div style = "font-size:20px;margin-left:60px;" onclick="location.href='logout.php'">
        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo "logout";
            }
            
         ?>
    </div>

  
</div>
    </header>
</body>
</html>

