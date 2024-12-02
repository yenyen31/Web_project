<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>소원 우체국 Wish Post Office</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
</head>

<body>
	<header>
		<?php include "header.php"; ?>
	</header>
	<section>
		<div id="main_img_bar">
			<img src="./img/main_img.png">
		</div>
		<div id="board_box">
			<h3>
				소원 게시판 > 소원 목록 보기
			</h3>

			<!-- 검색 폼 추가 -->
			<form method="get" action="board_list.php" style="margin-bottom: 20px;">
				<input type="text" name="search" placeholder="검색어를 입력하세요" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
				<button type="submit">검색</button>
			</form>

			<ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">첨부</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>

				<?php
				$con = mysqli_connect("localhost", "user1", "12345", "sample");

				// 검색 조건 처리
				$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
				$search_query = $search ? "WHERE subject LIKE '%$search%' OR content LIKE '%$search%' OR name LIKE '%$search%'" : '';

				// 게시글 총 개수 계산
				$sql = "SELECT COUNT(*) AS total FROM board $search_query";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);
				$total_record = $row['total'];

				// 페이지 계산
				$scale = 10; // 페이지당 글 수
				$total_page = ($total_record % $scale == 0) ? ($total_record / $scale) : (floor($total_record / $scale) + 1);
				$page = isset($_GET["page"]) ? $_GET["page"] : 1;
				$start = ($page - 1) * $scale;

				// 게시글 가져오기
				$sql = "SELECT * FROM board $search_query ORDER BY num DESC LIMIT $start, $scale";
				$result = mysqli_query($con, $sql);

				if ($total_record == 0) {
					echo "<li>검색 결과가 없습니다.</li>";
				} else {
					$number = $total_record - $start;

					while ($row = mysqli_fetch_array($result)) {
						$num = $row["num"];
						$id = $row["id"];
						$name = $row["name"];
						$subject = $row["subject"];
						$regist_day = $row["regist_day"];
						$hit = $row["hit"];
						$file_image = $row["file_name"] ? "<img src='./img/file.gif'>" : " ";
				?>
						<li>
							<span class="col1"><?= $number ?></span>
							<span class="col2"><a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>"><?= htmlspecialchars($subject) ?></a></span>
							<span class="col3"><?= htmlspecialchars($name) ?></span>
							<span class="col4"><?= $file_image ?></span>
							<span class="col5"><?= $regist_day ?></span>
							<span class="col6"><?= $hit ?></span>
						</li>
				<?php
						$number--;
					}
				}
				mysqli_close($con);
				?>
			</ul>

			<ul id="page_num">
				<?php
				// 이전 페이지
				if ($page > 1) {
					$new_page = $page - 1;
					echo "<li><a href='board_list.php?page=$new_page&search=$search'>◀ 이전</a></li>";
				} else {
					echo "<li>&nbsp;</li>";
				}

				// 페이지 번호 출력
				for ($i = 1; $i <= $total_page; $i++) {
					if ($page == $i) {
						echo "<li><b> $i </b></li>";
					} else {
						echo "<li><a href='board_list.php?page=$i&search=$search'> $i </a></li>";
					}
				}

				// 다음 페이지
				if ($page < $total_page) {
					$new_page = $page + 1;
					echo "<li><a href='board_list.php?page=$new_page&search=$search'>다음 ▶</a></li>";
				} else {
					echo "<li>&nbsp;</li>";
				}
				?>
			</ul>

			<ul class="buttons">
				<li><button onclick="location.href='board_list.php'">목록</button></li>
				<li>
					<?php
					if (isset($_SESSION["userid"])) {
					?>
						<button onclick="location.href='board_form.php'">소원 쓰기</button>
					<?php
					} else {
					?>
						<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>소원 쓰기</button></a>
					<?php
					}
					?>
				</li>
			</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include "footer.php"; ?>
	</footer>
</body>

</html>