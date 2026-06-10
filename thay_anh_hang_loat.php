<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

// TÊN ẢNH MỚI BẠN MUỐN THAY
// Bạn chỉ cần thay tên file ảnh ở đây, ví dụ: 'anh-moi-cua-toi.jpg'
// Ảnh này phải được bạn copy sẵn vào thư mục: public/uploads/
$new_image_name = 'lq_sieure_banner.png'; 

// TÊN DANH MỤC BẠN MUỐN THAY ẢNH
$category_name = 'Nick Tự Chọn Siêu Rẻ';

// Cập nhật ảnh cho tất cả các nick nằm trong danh mục này
$db->query("SELECT id FROM categories WHERE name = :name LIMIT 1");
$db->bind(':name', $category_name);
$cat = $db->single();

if ($cat) {
    $db->query("UPDATE accounts SET image_url = :image WHERE category_id = :cat_id");
    $db->bind(':image', $new_image_name);
    $db->bind(':cat_id', $cat['id']);
    $db->execute();
    echo "Đã thay đổi ảnh thành công cho toàn bộ tài khoản trong thư mục " . $category_name . "!";
} else {
    echo "Không tìm thấy thư mục nào có tên: " . $category_name;
}
