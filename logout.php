<?php

/* 

로그아웃 확인 후 실제 로그아웃 동작(세션 정리)을 수행하는 PHP 파일

기존 logout.php에서 "로그아웃 확인" 메시지만 처리하고, 실제 로그아웃 작업은 logout_process.php에서 담당
- `logout.php`: 확인 메시지를 보여주는 역할.
- `logout_process.php`: 실제 로그아웃 처리 역할.

*/
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
