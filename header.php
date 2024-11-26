<?php
session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";
if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
else $userlevel = "";
if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
else $userpoint = "";
?>
<div id="top">
    <h3>
        <a href="index.php">소원 우체국 Wish Post Office</a>
    </h3>
    <ul id="top_menu">
        <?php
        if (!$userid) {
        ?>
            <li><a href="member_form.php">Join</a> </li> <!-- 회원가입 -->
            <li> | </li>
            <li><a href="login_form.php">Login</a></li> <!-- 로그인 -->
        <?php
        } else {
            $logged = $username . "(" . $userid . ")님[Level:" . $userlevel . ", Point:" . $userpoint . "]";
        ?>
            <li><?= $logged ?> </li>
            <li> | </li>
            <li><a href="logout.php"> Logout </a> </li> <!-- 로그아웃 -->
            <li> | </li>
            <li><a href="member_modify_form.php"> my page </a></li> <!-- 정보수정 -->
        <?php
        }
        ?>
        <?php
        if ($userlevel == 1) {
        ?>
            <li> | </li>
            <li><a href="admin.php">Admin mode</a></li> <!-- 관리자모드 -->
        <?php
        }
        ?>
    </ul>
</div>
<div id="menu_bar">
    <ul>
        <li><a href="index.php">HOME</a></li> <!-- 홈 -->
        <li><a href="message_form.php">쪽지 보내기</a></li> <!-- 쪽지 만들기 -->
        <li><a href="board_form.php">소원 쓰기</a></li> <!-- 게시판 만들기 -->
        <li><a href="index.php">사이트 완성하기</a></li> <!-- 사이트 완성하기 -->
    </ul>
</div>