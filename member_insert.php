<?php
$id = $_POST["id"];
$pass = $_POST["pass"];
$name = $_POST["name"];
$email1 = $_POST["email1"];
$email2 = $_POST["email2"];
$profile_picture = $_FILES["profile_picture"];

$email = $email1 . "@" . $email2;

// 비밀번호 유효성 검사
if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $pass)) {
	echo "<script>alert('비밀번호 조건을 만족하지 않습니다.'); history.go(-1);</script>";
	exit;
}

// 이름 검증
if (!preg_match('/^[a-zA-Z가-힣]{2,}$/', $name)) {
	echo "<script>alert('이름은 2글자 이상이어야 합니다.'); history.go(-1);</script>";
	exit;
}

// 이메일 검증
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "<script>alert('이메일 형식이 잘못되었습니다.'); history.go(-1);</script>";
	exit;
}

// 프로필 사진 업로드
$upload_dir = './uploads/';
if ($profile_picture['name']) {
	$file_name = basename($profile_picture["name"]);
	$file_path = $upload_dir . $file_name;

	if (move_uploaded_file($profile_picture["tmp_name"], $file_path)) {
		$profile_picture_path = $file_name;
	} else {
		echo "<script>alert('프로필 사진 업로드 실패.'); history.go(-1);</script>";
		exit;
	}
} else {
	$profile_picture_path = null;
}

// 데이터베이스 연결 및 저장
$con = mysqli_connect("localhost", "user1", "12345", "sample");

$sql = "INSERT INTO members (id, pass, name, email, profile_picture) VALUES ('$id', '$pass', '$name', '$email', '$profile_picture_path')";
if (!mysqli_query($con, $sql)) {
	echo "<script>alert('회원 가입 실패.'); history.go(-1);</script>";
}

mysqli_close($con);

echo "<script>alert('회원 가입 성공.'); location.href = 'index.php';</script>";
