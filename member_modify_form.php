<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>소원 우체국 Wish Post Office</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/member.css">
	<script type="text/javascript" src="./js/member_modify.js"></script>
	<style>
		/* 수정 완료 버튼 */
		#join_box_button {
			padding: 10px 20px;
			border-radius: 5px;
			background-color: #6AAFE6;
			color: white;
			border: none;
			font-size: 16px;
			cursor: pointer;
		}

		#join_box_button:hover {
			background-color: #5a9ed1;
		}

		/* 초기화 버튼 */
		#reset_button {
			padding: 10px 20px;
			border-radius: 5px;
			background-color: #ccc;
			color: black;
			border: none;
			font-size: 16px;
			cursor: pointer;
		}

		#reset_button:hover {
			background-color: #bbb;
		}
	</style>
</head>

<body>
	<header>
		<?php include "header.php"; ?>
	</header>
	<?php
	$con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql    = "select * from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row    = mysqli_fetch_array($result);

	$pass = $row["pass"];
	$name = $row["name"];

	$email = explode("@", $row["email"]);
	$email1 = $email[0];
	$email2 = $email[1];

	mysqli_close($con);
	?>
	<section>
		<div id="main_img_bar">
			<img src="./img/main_img.png">
		</div>
		<div id="main_content">
			<div id="join_box">
				<form name="member_form" method="post" action="member_modify.php?id=<?= $userid ?>">
					<h2>회원 정보수정</h2>
					<div class="form id">
						<div class="col1">아이디</div>
						<div class="col2">
							<?= $userid ?>
						</div>
					</div>
					<div class="clear"></div>

					<div class="form">
						<div class="col1">비밀번호</div>
						<div class="col2">
							<input type="password" name="pass" value="<?= $pass ?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="form">
						<div class="col1">비밀번호 확인</div>
						<div class="col2">
							<input type="password" name="pass_confirm" value="<?= $pass ?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="form">
						<div class="col1">이름</div>
						<div class="col2">
							<input type="text" name="name" value="<?= $name ?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="form email">
						<div class="col1">이메일</div>
						<div class="col2">
							<input type="text" name="email1" value="<?= $email1 ?>">@<input
								type="text" name="email2" value="<?= $email2 ?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="bottom_line"> </div>
					<div class="buttons">
						<button id="join_box_button" type="button" onclick="check_input()">수정하기</button>
						<button id="reset_button" type="button" onclick="reset_form()">초기화</button>
					</div>
				</form>
			</div> <!-- join_box -->
		</div> <!-- main_content -->
	</section>
	<footer>
		<?php include "footer.php"; ?>
	</footer>
</body>

</html>