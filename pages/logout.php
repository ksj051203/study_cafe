
<?php
    session_start(); // 세션 시작

// 세션 변수 초기화
    $_SESSION = array();
    session_destroy();
?>

<meta http-equiv="refresh" content="0; url=index.php">