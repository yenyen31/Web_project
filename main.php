<div id="main_content">
    <div id="latest">
        <h4>최근 소원 목록</h4>
        <ul>
            <!-- 최근 게시 글 불러오기 -->
            <?php
            $con = mysqli_connect("localhost", "user1", "12345", "sample");
            $sql = "SELECT * FROM board ORDER BY num DESC LIMIT 5";
            $result = mysqli_query($con, $sql);

            if (!$result)
                echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
            else {
                while ($row = mysqli_fetch_array($result)) {
                    $regist_day = substr($row["regist_day"], 0, 10);
            ?>
                    <li>
                        <span><?= $row["subject"] ?></span>
                        <span><?= $row["name"] ?></span>
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
            <!-- 포인트 랭킹과 회원 등급 표시 -->
            <?php
            $rank = 1;
            $sql = "SELECT * FROM members ORDER BY point DESC LIMIT 5";
            $result = mysqli_query($con, $sql);

            if (!$result)
                echo "회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!";
            else {
                while ($row = mysqli_fetch_array($result)) {
                    $name  = $row["name"];
                    $id    = $row["id"];
                    $point = $row["point"];

                    // 이름 마스킹
                    $name = mb_substr($name, 0, 1) . " * " . mb_substr($name, 2, 1);

                    // 회원 등급 계산
                    if ($point >= 300) $grade = "Express";
                    elseif ($point >= 200) $grade = "priority"; # 2번째 회원 단계
                    elseif ($point >= 100) $grade = "standard"; # 3번째 회원 단계
                    else $grade = "일반";
            ?>
                    <li>
                        <span><?= $rank ?></span>
                        <span><?= $name ?></span>
                        <span><?= $id ?></span>
                        <span><?= $point ?>점 (<?= $grade ?>)</span> <!-- 등급 표시 -->
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