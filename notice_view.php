<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>공지사항 보기</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <link rel="stylesheet" type="text/css" href="./css/board.css">
</head>

<body>
  <header>
    <?php include "header.php"; ?>
  </header>

  <section>
    <div id="main_img_bar">
      <img src="./img/main_img.png" alt="메인 이미지">
    </div>
    <div id="board_box">
      <?php
      $num = $_GET["num"];

      $con = mysqli_connect("localhost", "user1", "12345", "sample");

      // 조회수 증가
      $sql = "UPDATE notice SET hit = hit + 1 WHERE num = $num";
      mysqli_query($con, $sql);

      // 공지사항 데이터 가져오기
      $sql = "SELECT * FROM notice WHERE num = $num";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);

      $title = $row["title"];
      $author = $row["author"];
      $regist_day = $row["regist_day"];
      $content = $row["content"];
      ?>
      <!-- 공지사항 내용 보기 -->
      <h3><?= $title ?></h3>
      <ul id="view_content">
        <li>
          <span class="col1"><b>작성자:</b> <?= $author ?></span>
          <span class="col2"><b>작성일:</b> <?= $regist_day ?></span>
        </li>
        <li>
          <?= nl2br($content) ?>
        </li>
      </ul>
      <ul class="buttons">
        <li><button onclick="location.href='notice_list.php'">목록</button></li>
      </ul>
    </div>
  </section>

  <footer>
    <?php include "footer.php"; ?>
  </footer>
</body>

</html>