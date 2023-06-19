<?php
include 'header.php';

$conn = mysqli_connect($db_host, $db_id, $db_pw, $db_name);

// 데이터베이스 연결 설정

// 데이터베이스 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 데이터베이스에서 최근 10개의 데이터 가져오기
$query = "SELECT * FROM mic ORDER BY dates DESC LIMIT 10";
$result = mysqli_query($conn, $query);

// 데이터 배열 초기화
$data = array();

// 결과를 배열로 변환
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// 데이터베이스 연결 닫기
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Line Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<canvas id="lineChart" width="900" height="400"></canvas>

<script>
    // 데이터 배열 가져오기
    var data = <?php echo json_encode($data); ?>;

    // 라벨과 값 배열 초기화
    var labels = [];
    var values = [];

    // 데이터에서 라벨과 값을 추출하여 배열에 저장
    data.forEach(function (e) {
        labels.push(e.dates); // dates 값을 라벨로 추가
        values.push(parseInt(e.mic)); // mic 값을 값으로 추가
    });

    // 그래프 그리기
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels, // dates 값을 라벨로 사용
            datasets: [{
                label: 'Mic',
                data: values, // mic 값을 값으로 사용
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Dates'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Mic Value'
                    }
                }
            }
        }
    });
    setInterval(function() {
        location.reload();
    }, 10000); // 10초 = 10000밀리초
</script>
</body>
</html>