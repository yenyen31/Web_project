<?php
/* 

"로그아웃 확인" 메시지만 처리
- `logout.php`: 확인 메시지를 보여주는 역할.

*/
session_start();
if (!isset($_SESSION["userid"])) {
    echo "<script>alert('로그인 상태가 아닙니다.'); location.href = 'login_form.php';</script>";
    exit;
}

// 로그아웃 희망 여부 확인
echo "<script>
    if (confirm('로그아웃 하시겠습니까?')) {
        location.href = 'logout_process.php';
    } else {
        history.go(-1);
    }
</script>";
