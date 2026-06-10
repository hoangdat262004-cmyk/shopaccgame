<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');

// Clear old categories entirely to avoid duplicates? No, let's just empty the table and re-insert, and reset AUTO_INCREMENT.
// BUT accounts are linked to category_id! So let's just update id 1, 2, 3 and insert the rest.

$cats = [
    1 => ['Liên Quân', 'Túi mù + nick tự chọn'],
    2 => ['Free Fire', 'Túi mù + nick tự chọn'],
    3 => ['Nick Roblox', 'Túi mù + nick tự chọn'],
    4 => ['Liên Minh + TFT', 'Liên Minh + TFT'],
    5 => ['Các Game Khác', 'Nick Nhiều Game'],
    6 => ['Dịch Vụ Anime Last Stand', '']
];

foreach ($cats as $id => $data) {
    $name = $data[0];
    $desc = $data[1];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $name))));
    // A better slug generator for vietnamese:
    $slug = str_replace(
        ['á','à','ả','ã','ạ','ă','ắ','ằ','ẳ','ẵ','ặ','â','ấ','ầ','ẩ','ẫ','ậ','đ','é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ','í','ì','ỉ','ĩ','ị','ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ','ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự','ý','ỳ','ỷ','ỹ','ỵ'],
        ['a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','d','e','e','e','e','e','e','e','e','e','e','e','i','i','i','i','i','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','u','u','u','u','u','u','u','u','u','u','u','y','y','y','y','y'],
        mb_strtolower($name, 'UTF-8')
    );
    $slug = preg_replace('/[^a-z0-9\-]+/', '-', $slug);
    $slug = trim($slug, '-');

    $stmt = $pdo->prepare("SELECT id FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    if ($stmt->fetch()) {
        $pdo->prepare("UPDATE categories SET name = ?, description = ?, slug = ? WHERE id = ?")->execute([$name, $desc, $slug, $id]);
    } else {
        $pdo->prepare("INSERT INTO categories (id, name, description, slug) VALUES (?, ?, ?, ?)")->execute([$id, $name, $desc, $slug]);
    }
}
echo "Categories updated!";
