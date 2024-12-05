// 공지사항 데이터베이스

CREATE TABLE notice (
    num INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(50) NOT NULL,
    regist_day DATETIME NOT NULL,
    hit INT DEFAULT 0
);
