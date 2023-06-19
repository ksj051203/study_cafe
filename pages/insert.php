<?php
include 'db.php';
  
  $page = $_POST['pageNumber'];
  $id = $_POST['sessionId'];

  $conn = mysqli_connect($db_host, $db_id, $db_pw, $db_name);

  switch ($page) {
    case 1:
      $seat = $_POST['selectedSeat'];
      $time = $_POST['selectedTime'];
      $query = "INSERT INTO `user` (seat_id, user_id, times) VALUES ('$seat', '$id', CONCAT('$time', ':00:00'));";
      $successMessage = "입실에 성공하였습니다!";
      break;
      case 2:
        $query = "DELETE FROM `user` WHERE user_id='$id';";
        $successMessage = "퇴실에 성공하였습니다!";
        break;
    case 3:
      $time = $_POST['selectedTime'];
      $query =  "UPDATE `user` SET times = SEC_TO_TIME(TIME_TO_SEC(times) + TIME_TO_SEC('$time:00:00')) WHERE user_id = '$id';";
      $successMessage = "시간 추가에 성공하였습니다.";
      break;
    default:
      break;
  }


  $result = mysqli_query($conn, $query);

  if (!$result) {
    echo "쿼리 실행 에러: " . mysqli_error($conn);
  } else {
    if ($page == 1 || $page == 2 || $page == 3) {
      echo $query;
      echo $successMessage;
      echo "<script>alert('$successMessage'); window.location.href='index.php';</script>";
    } else {
      echo "잘못된 페이지입니다.";
    }
  }

  mysqli_close($conn);
