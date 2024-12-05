<div id="main_img_bar">
    <img src="./img/main_img.png" alt="메인 이미지">
</div>
<div id="main_content">
    <div id="latest">
        <h4>최근 소원 목록</h4>
        <!-- 검색 폼 추가 -->
        <form method="get" action="main.php" style="margin-bottom: 10px;">
            <input type="text" name="search" placeholder="검색어를 입력하세요" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button type="submit">검색</button>
        </form>
        <ul>
            <?php
            $con = mysqli_connect("localhost", "user1", "12345", "sample");

            // 검색 조건 처리
            $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
            $search_query = $search ? "WHERE subject LIKE '%$search%' OR content LIKE '%$search%' OR name LIKE '%$search%'" : '';
            $sql = "SELECT * FROM board $search_query ORDER BY num DESC LIMIT 5";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) == 0) { # 검색 결과가 없는 경우
                # echo "<li>검색 결과가 없습니다.</li>"; # 검색 결과 없다는 메시지 출력 
            } else { # 검색 결과가 있는 경우
                while ($row = mysqli_fetch_array($result)) {
                    $regist_day = substr($row["regist_day"], 0, 10);
            ?>
                    <li>
                        <span><?= htmlspecialchars($row["subject"]) ?></span>
                        <span><?= htmlspecialchars($row["name"]) ?></span>
                        <span><?= $regist_day ?></span>
                    </li>
            <?php
                }
            }
            ?>
        </ul>
    </div>
    <div id="point_rank">
        <h4>별 포인트 & 회원 등급</h4>
        <ul>
            <?php
            $rank = 1;
            $sql = "SELECT * FROM members ORDER BY point DESC LIMIT 5";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) == 0) { # 회원이 없는 경우
                echo "<li>회원이 없습니다.</li>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $name  = $row["name"];
                    $id    = $row["id"];
                    $point = $row["point"];

                    // 이름 마스킹
                    $name = mb_substr($name, 0, 1) . " * " . mb_substr($name, 2, 1);

                    // 회원 등급 계산
                    if ($point >= 300) $grade = "Express";
                    elseif ($point >= 200) $grade = "second-class";
                    elseif ($point >= 100) $grade = "priority";
                    else $grade = "standard";
            ?>
                    <li>
                        <span><?= $rank ?></span>
                        <span><?= $name ?></span>
                        <span><?= $id ?></span>
                        <span><?= $point ?>점 (<?= $grade ?>)</span>
                    </li>
            <?php
                    $rank++;
                }
            }

            mysqli_close($con);
            ?>
        </ul>
    </div>
</div>