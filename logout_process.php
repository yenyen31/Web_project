<?php
/* 

로그아웃 확인 후 실제 로그아웃 동작(세션 정리)을 수행하는 PHP 파일

기존 logout.php에서 "로그아웃 확인" 메시지만 처리하고, 실제 로그아웃 작업은 logout_process.php에서 담당
- `logout.php`: 확인 메시지를 보여주는 역할.
- `logout_process.php`: 실제 로그아웃 처리 역할.

*/
session_start();
session_unset();
session_destroy();

echo "<script>
    alert('로그아웃 되었습니다.');
    location.href = 'index.php';
</script>";
