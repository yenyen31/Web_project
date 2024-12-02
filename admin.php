<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>소원 우체국 Wish Post Office</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/admin.css">
	<style>
		.admin {
			background-color: #D4DFE6;
		}

		/* 레벨 1: 관리자 */
		.vip {
			background-color: #CADBE9;
		}

		/* 레벨 2, 3: 우수 회원 */
		.normal {
			background-color: #6AAFE6;
		}

		/* 기본: 일반 회원 */
	</style>
</head>

<body>
	<header>
		<?php include "header.php"; ?>
	</header>
	<section>
		<div id="admin_box">
			<h3 id="member_title">
				관리자 모드 > 회원 관리
			</h3>
			<form method="post" action="admin_member_delete_bulk.php">
				<ul id="member_list">
					<li>
						<span class="col1">선택</span>
						<span class="col2">번호</span>
						<span class="col3">아이디</span>
						<span class="col4">이름</span>
						<span class="col5">레벨</span>
						<span class="col6">포인트</span>
						<span class="col7">가입일</span>
						<span class="col8">수정</span>
					</li>
					<?php
					$con = mysqli_connect("localhost", "user1", "12345", "sample");
					$sql = "select * from members order by num desc";
					$result = mysqli_query($con, $sql);
					$total_record = mysqli_num_rows($result); // 전체 회원 수

					$number = $total_record;

					while ($row = mysqli_fetch_array($result)) {
						$num         = $row["num"];
						$id          = $row["id"];
						$name        = $row["name"];
						$level       = $row["level"];
						$point       = $row["point"];
						$regist_day  = $row["regist_day"];

						// 레벨별 클래스 설정
						if ($level == 1) $row_class = "admin"; // 관리자
						elseif ($level == 2 || $level == 3) $row_class = "vip"; // 우수 회원
						else $row_class = "normal"; // 일반 회원

						// 레벨별 레이블 설정
						if ($level == 1) $level_label = "관리자";
						elseif ($level == 2 || $level == 3) $level_label = "우수 회원";
						else $level_label = "일반 회원";
					?>

						<li class="<?= $row_class ?>">
							<span class="col1"><input type="checkbox" name="member_ids[]" value="<?= $num ?>"></span>
							<span class="col2"><?= $number ?></span>
							<span class="col3"><?= $id ?></a></span>
							<span class="col4"><?= $name ?></span>
							<span class="col5"><?= $level_label ?></span> <!-- 등급 레이블 표시 -->
							<span class="col6"><?= $point ?></span>
							<span class="col7"><?= $regist_day ?></span>
							<span class="col8">
								<button type="button" onclick="location.href='admin_member_update.php?num=<?= $num ?>'">수정</button>
							</span>
						</li>

					<?php
						$number--;
					}
					?>
				</ul>
				<button type="submit">선택된 회원 삭제</button>
			</form>
			<h3 id="member_title">
				관리자 모드 > 게시판 관리
			</h3>
			<ul id="board_list">
				<li class="title">
					<span class="col1">선택</span>
					<span class="col2">번호</span>
					<span class="col3">이름</span>
					<span class="col4">제목</span>
					<span class="col5">첨부파일명</span>
					<span class="col6">작성일</span>
				</li>
				<form method="post" action="admin_board_delete.php">
					<?php
					$sql = "select * from board order by num desc";
					$result = mysqli_query($con, $sql);
					$total_record = mysqli_num_rows($result); // 전체 글의 수

					$number = $total_record;

					while ($row = mysqli_fetch_array($result)) {
						$num         = $row["num"];
						$name        = $row["name"];
						$subject     = $row["subject"];
						$file_name   = $row["file_name"];
						$regist_day  = $row["regist_day"];
						$regist_day  = substr($regist_day, 0, 10)
					?>
						<li>
							<span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
							<span class="col2"><?= $number ?></span>
							<span class="col3"><?= $name ?></span>
							<span class="col4"><?= $subject ?></span>
							<span class="col5"><?= $file_name ?></span>
							<span class="col6"><?= $regist_day ?></span>
						</li>
					<?php
						$number--;
					}
					mysqli_close($con);
					?>
					<button type="submit">선택된 글 삭제</button>
				</form>
			</ul>
		</div> <!-- admin_box -->
	</section>
	<footer>
		<?php include "footer.php"; ?>
	</footer>
</body>

</html>