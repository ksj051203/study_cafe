<?php
    include 'header.php';

    $seat1 = $_GET['seat1'];
    $seat2 = $_GET['seat2'];
    $mic = intval($_GET['mic']);

    echo $seat1;
    echo $seat2;
    echo $mic;

    date_default_timezone_set('Asia/Seoul');
    $date_data = date('H:i:s',time());

    $conn = mysqli_connect($db_host,$db_id, $db_pw, $db_name);
    // row 없을 때 insert
    // 1이상이면 Update
    $query2 = "insert into mic(mic, dates) values($mic, '$date_data');";
    mysqli_query($conn, $query2); 
    $query = "select * from sensor";
    $result2 = mysqli_query($conn, $query); 
    $count = mysqli_num_rows($result2);
    
    if($count == 0){
        echo $seat1;
        echo $seat2;
        $query = "insert into sensor(seat1, seat2) values('$seat1', '$seat2')";
        $result = mysqli_query($conn, $query);
        echo "삽입 성공";
    }else{
        echo $seat1;
        echo $seat2;
        $query = "update sensor set seat1 = '$seat1', seat2 = '$seat2';";
        $result = mysqli_query($conn, $query);
        echo "업데이트 성공";
    }
?>