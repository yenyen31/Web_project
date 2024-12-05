<?php
session_start();

if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
else $userlevel = "";

# 관리자가 아닌 경우 경고 메시지 출력, 뒤로 가기
if ($userlevel != 1) {
    echo ("
                    <script>
                    alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
                    history.go(-1)
                    </script>
        ");
    exit;
}

# 게시물 삭제하기
if (isset($_POST["item"]))
    $num_item = count($_POST["item"]);
else # 삭제할 게시물을 선택하지 않은 경우
    echo ("
                    <script>
                    alert('삭제할 게시글을 선택해주세요!');
                    history.go(-1)
                    </script>
        ");

$con = mysqli_connect("localhost", "user1", "12345", "sample");

# 게시물 삭제하기
for ($i = 0; $i < count($_POST["item"]); $i++) {
    $num = $_POST["item"][$i];

    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

    if ($copied_name) {
        $file_path = "./data/" . $copied_name;
        unlink($file_path);
    }

    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);
}

mysqli_close($con);

echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
