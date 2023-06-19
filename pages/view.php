<?php
    include 'header.php';
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
    <?php
        session_start(); // 세션 시작

        $page = $_GET['page'];

        // DB 연동
        $conn = mysqli_connect($db_host, $db_id, $db_pw, $db_name);

        // DB에 저장되어있는 센서값 하나마나 가져오기
        $query = "SELECT * FROM sensor LIMIT 1;";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        // 좌석이 비었는지 찼는지 확인
        $seat1 = $row["seat1"];
        $seat2 = $row["seat2"];

        $backColor1 = $seat1 ? "#EDEDED" : "white";
        $backColor2 = $seat2 ? "#EDEDED" : "white";

        $pointerNone = "pointer-events: none;";
        $Change = "background-color: red";

    ?>

    <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        echo '<script>alert("로그인이 필요합니다"); window.location.href="index.php"</script>';
    } ?>

    <div class="notice">
        <?php
        switch ($page) {
            case 1:
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    echo $_SESSION['id'] . "님 좌석을 선택해주세요!";
                }
                break;
            case 2:
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    echo $_SESSION['id'] . "님 퇴실할 좌석을 선택해주세요!";
                }
                break;
            case 3:
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    echo $_SESSION['id'] . "님 시간을 추가할 좌석을 선택해주세요!";
                }
                break;
            default:
                break;
        }
        ?>
    </div>

    <?php
    if ($page == 2) {
        $formAction = "insert.php";
    } else {
        $formAction = "time.php";
    }

    $none1 = $seat1 ? $pointerNone : '';
    $none2 = $seat2 ? $pointerNone : '';
    ?>

    <form method="post" action="<?php echo $formAction; ?>" id="view">
        <div class="grid">
            <div id="seat1" class="seat" value="1" style="<?php echo $none1 ?> background-color: <?php echo $backColor1; ?>;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1<br><?php
    $query1 = "SELECT `times`, `user_id` FROM `user` WHERE `seat_id` = '1';";

    $result = mysqli_query($conn, $query1);

    // 결과 출력
    while ($row = mysqli_fetch_assoc($result)) {
        echo "User ID: " . $row['user_id'] . " <br> Time: " . $row['times'] . "<br>";
    }
    ?></div>
            <div id="seat2" class="seat" value="2" style="<?php echo $none2 ?> background-color: <?php echo $backColor2; ?>;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2<br><?php
    $query1 = "SELECT `times`, `user_id` FROM `user` WHERE `seat_id` = '2';";

    $result = mysqli_query($conn, $query1);

    // 결과 출력
    while ($row = mysqli_fetch_assoc($result)) {
        echo "User ID: " . $row['user_id'] . " <br> Time: " . $row['times'] . "<br>";
    }
    ?>
        </div>
            <input type="hidden" id="page" value="<?php echo $page; ?>">
        </div>
    </form>


    <script>
        var seat1 = document.getElementById("seat1");
        var seat2 = document.getElementById("seat2");

        setTimeout(function() {
            location.reload();
        }, 1000);

        var selectedSeat = 0;

        function seatClickHandler(event) {
            var seatNumber = event.target.getAttribute("value");
            selectedSeat = seatNumber;
            var pageNumber = document.getElementById("page").value;

            var myForm = document.getElementById("view");
            myForm.action = <?php echo ($page == 2) ? "'insert.php'" : "'time.php'"; ?>;
            myForm.method = "post";

            var selectedSeatField = document.createElement("input");
            selectedSeatField.setAttribute("type", "hidden");
            selectedSeatField.setAttribute("name", "selectedSeat");
            selectedSeatField.setAttribute("value", selectedSeat);
            myForm.appendChild(selectedSeatField);

            var pageNumberField = document.createElement("input");
            pageNumberField.setAttribute("type", "hidden");
            pageNumberField.setAttribute("name", "pageNumber");
            pageNumberField.setAttribute("value", pageNumber);
            myForm.appendChild(pageNumberField);

            var sessionId = "<?php echo $_SESSION['id']; ?>";

            var sessionIdField = document.createElement("input");
            sessionIdField.setAttribute("type", "hidden");
            sessionIdField.setAttribute("name", "sessionId");
            sessionIdField.setAttribute("value", sessionId);
            myForm.appendChild(sessionIdField);

            myForm.submit();
        }

        seat1.addEventListener("click", seatClickHandler);
        seat2.addEventListener("click", seatClickHandler);
    </script>
</body>
</html>
