<?php
include 'db.php';

$id = $_POST['id'];
$password = $_POST['password'];

$conn = mysqli_connect($db_host, $db_id, $db_pw, $db_name);

// 비밀번호 암호화
$encrypted_passwd = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO login (ID, encrypted_passwd) VALUES ('$id', '$encrypted_passwd');";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "회원가입이 완료되었습니다!";
} else {
    echo "회원가입에 실패하였습니다!" . mysqli_error($conn);
}

mysqli_close($conn);
?>
<meta http-equiv="refresh" content="0; url=login.php">
