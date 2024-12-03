<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>공지사항</title>
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
      <h3>공지사항</h3>
      <ul id="board_list">
        <li>
          <span class="col1">번호</span>
          <span class="col2">제목</span>
          <span class="col3">작성자</span>
          <span class="col4">등록일</span>
          <span class="col5">조회수</span>
        </li>
        <?php
        $con = mysqli_connect("localhost", "user1", "12345", "sample");

        $sql = "SELECT * FROM notice ORDER BY num DESC";
        $result = mysqli_query($con, $sql);
        $total_record = mysqli_num_rows($result);

        $number = $total_record;

        while ($row = mysqli_fetch_array($result)) {
          $num = $row["num"];
          $title = $row["title"];
          $author = $row["author"];
          $regist_day = $row["regist_day"];
          $hit = $row["hit"];
        ?>
          <li>
            <span class="col1"><?= $number ?></span>
            <span class="col2"><a href="notice_view.php?num=<?= $num ?>"><?= $title ?></a></span>
            <span class="col3"><?= $author ?></span>
            <span class="col4"><?= $regist_day ?></span>
            <span class="col5"><?= $hit ?></span>
          </li>
        <?php
          $number--;
        }
        mysqli_close($con);
        ?>
      </ul>
    </div>
  </section>

  <footer>
    <?php include "footer.php"; ?>
  </footer>
</body>

</html>