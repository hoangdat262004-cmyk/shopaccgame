<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');

$data = [
    [
        'title' => 'Nick TFT Tự chọn',
        'price' => 0,
        'old_price' => 0,
        'stock' => 14,
        'image' => 'https://via.placeholder.com/400x200/9C27B0/ffffff?text=Nick+TFT+Tu+Chon'
    ],
    [
        'title' => 'Nick Liên Minh Tự Chọn',
        'price' => 0,
        'old_price' => 0,
        'stock' => 50,
        'image' => 'https://via.placeholder.com/400x200/3F51B5/ffffff?text=Nick+LMHT+Tu+Chon'
    ]
];

$stmt = $pdo->prepare("INSERT INTO accounts (category_id, title, description, image_url, price, old_price, game_username, game_password, stock) VALUES (4, ?, 'Tài khoản LMHT/TFT', ?, ?, ?, 'lmht_user', 'lmht_pass', ?)");

foreach($data as $item) {
    $stmt->execute([$item['title'], $item['image'], $item['price'], $item['old_price'], $item['stock']]);
}
echo "LMHT accounts inserted successfully!";
