<?php
session_start(); // 세션 시작
include 'db.php';

// id와 password 입력
$id = $_POST['id'];
$password = $_POST['password'];

// DB 연동
$conn = mysqli_connect($db_host, $db_id, $db_pw, $db_name);

// 입력한 password를 암호화
$encrypted_passwd = password_hash($password, PASSWORD_DEFAULT);

// 해당 id의 암호화된 password를 가져오기
$query = "SELECT encrypted_passwd FROM login WHERE id = '$id'";
$result = mysqli_query($conn, $query);

// 값이 있다면
if ($result) {
  $row = mysqli_fetch_assoc($result);
  // 암호화 된 비밀번호를 가져오기
  $hashed_passwd_from_db = $row['encrypted_passwd'];

  if (password_verify($password, $hashed_passwd_from_db)) {
    // 로그인 성공 시 세션 변수 설정
    $_SESSION['logged_in'] = true;
    $_SESSION['id'] = $id;

    echo "로그인에 성공하였습니다!";
    echo "아이디: " . $_SESSION['id'];
  } else {
    echo "로그인에 실패하였습니다!";
  }
} else {
  echo "쿼리 실행 실패: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<meta http-equiv="refresh" content="0; url=index.php">