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
    <?php session_start(); // 세션 시작    
        $selectedSeat = $_POST['selectedSeat'];
        $pageNumber = $_POST['pageNumber'];
    ?>

    <div class="notice1">
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo $_SESSION['id'] . "님 시간을 선택해주세요!";
        } else {
            echo "?님 시간을 선택해주세요";
        }
        ?>
    </div>

    <form method="post" action="insert.php" id = "time">
        <!-- 시간 선택하기 -->
        <div class="grid1">
            <div id="onehour" class="time" value="1">1시간</div>
            <div id="twohour" class="time" value="2">2시간</div>
            <div id="threehour" class="time" value="3">3시간</div>
            <div id="fourhour" class="time" value="4">4시간</div>
            <div id="fivehour" class="time" value="5">5시간</div>
            <div id="sixhour" class="time" value="6">6시간</div>
        </div>
    </form>
    <script>
        selectedTime = 0;
        function timeClickHandler(event) {
            var timeNumber = event.target.getAttribute("value");
            selectedTime = timeNumber;
            var sessionId = "<?php echo $_SESSION['id'] ?>";

            var check =<?php echo $selectedSeat ?>+"번 좌석에 "+selectedTime+"시간을 추가하시겠습니까?";

            alert(check);

            var myForm = document.getElementById("time");
            myForm.action = "insert.php"; // 선택적으로 action 속성 설정
            myForm.method = "post"; // 선택적으로 method 속성 설정


            // 숨겨진 필드 생성 및 값 설정
                var selectedTimeField = document.createElement("input");
                selectedTimeField.setAttribute("type", "hidden");
                selectedTimeField.setAttribute("name", "selectedTime");
                selectedTimeField.setAttribute("value", selectedTime);
                myForm.appendChild(selectedTimeField);

                var selectedSeatField = document.createElement("input");
                selectedSeatField.setAttribute("type", "hidden");
                selectedSeatField.setAttribute("name", "selectedSeat");
                selectedSeatField.setAttribute("value", <?php echo $selectedSeat ?>);
                myForm.appendChild(selectedSeatField);

                var pageNumberField = document.createElement("input");
                pageNumberField.setAttribute("type", "hidden");
                pageNumberField.setAttribute("name", "pageNumber");
                pageNumberField.setAttribute("value", <?php echo $pageNumber ?>);
                myForm.appendChild(pageNumberField);

                var sessionIdField = document.createElement("input");
                sessionIdField.setAttribute("type", "hidden");
                sessionIdField.setAttribute("name", "sessionId");
                sessionIdField.setAttribute("value", sessionId);
                myForm.appendChild(sessionIdField);

                myForm.submit();
        }

        var onehour = document.getElementById("onehour");
        var twohour = document.getElementById("twohour");
        var threehour = document.getElementById("threehour");
        var fourhour = document.getElementById("fourhour");
        var fivehour = document.getElementById("fivehour");
        var sixhour = document.getElementById("sixhour");

        onehour.addEventListener("click", timeClickHandler);
        twohour.addEventListener("click", timeClickHandler);
        threehour.addEventListener("click", timeClickHandler);
        fourhour.addEventListener("click", timeClickHandler);
        fivehour.addEventListener("click", timeClickHandler);
        sixhour.addEventListener("click", timeClickHandler);
    </script>
</body>
</html>