<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

$db->query("UPDATE accounts SET image_url = 'tim_nick_banner.png' WHERE title LIKE 'Tìm Nick Theo Yêu Cầu #%'");
$db->execute();

echo "Đã cập nhật ảnh thành công!";
