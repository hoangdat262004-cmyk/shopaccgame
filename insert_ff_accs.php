<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');

$data = [
    [
        'title' => 'Nick Free Fire tự chọn',
        'price' => 0,
        'old_price' => 0,
        'stock' => 153,
        'image' => 'https://via.placeholder.com/400x200/FF5722/ffffff?text=Free+Fire+Tu+Chon'
    ],
    [
        'title' => 'Túi Mù FF 99K',
        'price' => 99000,
        'old_price' => 198000,
        'stock' => 1,
        'image' => 'https://via.placeholder.com/400x200/FFC107/ffffff?text=Tui+Mu+FF+99k'
    ],
    [
        'title' => 'Túi Mù FF 199k',
        'price' => 199000,
        'old_price' => 398000,
        'stock' => 44,
        'image' => 'https://via.placeholder.com/400x200/FF9800/ffffff?text=Tui+Mu+FF+199k'
    ],
    [
        'title' => 'Túi Mù FF 499K',
        'price' => 499000,
        'old_price' => 998000,
        'stock' => 32,
        'image' => 'https://via.placeholder.com/400x200/F44336/ffffff?text=Tui+Mu+FF+499k'
    ]
];

$stmt = $pdo->prepare("INSERT INTO accounts (category_id, title, description, image_url, price, old_price, game_username, game_password, stock) VALUES (2, ?, 'Tài khoản Free Fire VIP', ?, ?, ?, 'ff_user', 'ff_pass', ?)");

foreach($data as $item) {
    $stmt->execute([$item['title'], $item['image'], $item['price'], $item['old_price'], $item['stock']]);
}
echo "Free Fire accounts inserted successfully!";
