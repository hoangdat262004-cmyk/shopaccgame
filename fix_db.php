<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');

// Fix categories
$pdo->exec("UPDATE categories SET name = 'Liên Minh Huyền Thoại' WHERE name LIKE '%Minh Huy%'");
$pdo->exec("UPDATE categories SET name = 'Liên Quân Mobile' WHERE name LIKE '%Qu├ón Mobile%'");

// Fix accounts
$pdo->exec("UPDATE accounts SET title = 'Acc Liên Quân Rank Đồng - Cày Thuê', description = 'Acc trắng thông tin, rank đồng, thích hợp cày thuê.' WHERE title LIKE '%Rank ─Éß╗ông%'");
$pdo->exec("UPDATE accounts SET title = 'Acc Free Fire Quỷ Dạ Xoa', description = 'Sở hữu skin Quỷ Dạ Xoa siêu hiếm.' WHERE title LIKE '%Quß╗À Dß║í Xoa%'");
$pdo->exec("UPDATE accounts SET title = 'Acc LMHT Rank Thách Đấu', description = 'Full mọi thứ, rank thách đấu mùa trước.' WHERE title LIKE '%Th├ích ─Éß║Ñu%'");

echo "Database records updated successfully!";
