<?php
    include 'header.php'
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
<div class="login">
    <h2 style="font-size : 15">로그인</h2>
  
    <form method=post action=login_ing.php>
        아이디 <input type=text name=id><BR>
        비밀번호 <input type=password name=password><BR>
        <input type=submit value=로그인>
    </form>
</div>
</body>
</html>