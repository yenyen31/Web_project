<?php
session_start();

# 체크박스로 선택된 회원들의 정보를 삭제하는 기능 
if (!isset($_SESSION["userlevel"]) || $_SESSION["userlevel"] != 1) {
  echo "<script>alert('관리자 권한이 필요합니다.'); history.go(-1);</script>";
  exit;
}

if (!isset($_POST["member_ids"])) {
  echo "<script>alert('삭제할 회원을 선택해주세요.'); history.go(-1);</script>";
  exit;
}

// 선택된 회원 ID 배열
$member_ids = $_POST["member_ids"];

$con = mysqli_connect("localhost", "user1", "12345", "sample");

# 선택된 유저들 삭제
# sql 처리
foreach ($member_ids as $num) {
  $sql = "DELETE FROM members WHERE num = $num";
  mysqli_query($con, $sql);
}

mysqli_close($con);

echo "<script>alert('선택된 회원이 삭제되었습니다.'); location.href = 'admin.php';</script>";
