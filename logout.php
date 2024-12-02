<?php
session_start();
if (!isset($_SESSION["userid"])) {
  echo "<script>alert('로그인 상태가 아닙니다.'); location.href = 'login_form.php';</script>";
  exit;
}

echo "<script>
    if (confirm('로그아웃 하시겠습니까?')) {
        location.href = 'logout_process.php';
    } else {
        history.go(-1);
    }
</script>";
