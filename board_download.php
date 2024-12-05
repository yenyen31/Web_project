<?php
$real_name = $_GET["real_name"];
$file_name = $_GET["file_name"];
$file_type = $_GET["file_type"];
$file_path = "./data/" . $real_name;

// Internet Explorer(IE) 브라우저 호환성 처리
$ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) ||
    (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false &&
        strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

// IE 브라우저에서 한글 파일명이 깨지는 것을 방지하기 위해 인코딩 변경
if ($ie) {
    $file_name = iconv('utf-8', 'euc-kr', $file_name);
}

// 파일이 서버에 존재하는지 확인
if (file_exists($file_path)) {
    $fp = fopen($file_path, "rb");
    Header("Content-type: application/x-msdownload");
    Header("Content-Length: " . filesize($file_path));
    Header("Content-Disposition: attachment; filename=" . $file_name);
    Header("Content-Transfer-Encoding: binary");
    Header("Content-Description: File Transfer");
    Header("Expires: 0");

    // 파일 내용을 출력 (다운로드 진행)
    if (!fpassthru($fp)) {
        fclose($fp); // 파일 포인터 닫기 (전송 완료 후)
    }
} else {
    // 파일이 존재하지 않을 경우 에러 메시지 출력
    echo "<script>alert('파일이 존재하지 않습니다.'); history.back();</script>";
}
