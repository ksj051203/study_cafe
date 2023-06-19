
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
  <?php
  include 'header.php'
?>
<div class="main"> 
  <div class="box1"  onclick="location.href='view.php?page=1'">
      <img src="../image/plane-tickets.png" style="width : 14vw; height : 25vh; margin-left : 30px;">
    <div class="text" onclick="location.href='insert.php?page=1'">이용권구매</div>
  </div>

  <div class="box2" onclick="location.href='view.php?page=2'">
    <img src="../image/log-out.png" style="width : 14vw; height : 25v;  margin-left : 30px;">
    <div class="text">퇴실하기</div>
  </div>

  <div class="box3" onclick="location.href='view.php?page=3'">
    <img src="../image/clock.png" style="width : 14vw; height : 25vh; margin-left : 5px;">
    <div class="text">연장하기</div>
  </div>
</div>
</body>
</html>