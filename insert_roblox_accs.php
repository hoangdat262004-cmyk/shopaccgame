<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');

$data = [
    [
        'title' => 'ACC FISCH TỰ CHỌN',
        'price' => 0,
        'old_price' => 0,
        'stock' => 8,
        'image' => 'https://via.placeholder.com/400x200/00bcd4/ffffff?text=ACC+FISCH'
    ],
    [
        'title' => 'Nick BLOX FRUITS',
        'price' => 0,
        'old_price' => 0,
        'stock' => 38,
        'image' => 'https://via.placeholder.com/400x200/4caf50/ffffff?text=BLOX+FRUITS'
    ],
    [
        'title' => 'NICK ROBOX FRUITS FULL GEAR 7 TỘC',
        'price' => 150000,
        'old_price' => 300000,
        'stock' => 16,
        'image' => 'https://via.placeholder.com/400x200/e91e63/ffffff?text=FULL+GEAR+7+TOC'
    ],
    [
        'title' => 'ACC GROW A GARDEN',
        'price' => 0,
        'old_price' => 0,
        'stock' => 11,
        'image' => 'https://via.placeholder.com/400x200/8bc34a/ffffff?text=GROW+A+GARDEN'
    ],
    [
        'title' => 'ACC DRACO',
        'price' => 200000,
        'old_price' => 400000,
        'stock' => 19,
        'image' => 'https://via.placeholder.com/400x200/f44336/ffffff?text=ACC+DRACO'
    ]
];

$stmt = $pdo->prepare("INSERT INTO accounts (category_id, title, description, image_url, price, old_price, game_username, game_password, stock) VALUES (3, ?, 'Tài khoản Roblox siêu vip', ?, ?, ?, 'roblox_user', 'roblox_pass', ?)");

foreach($data as $item) {
    $stmt->execute([$item['title'], $item['image'], $item['price'], $item['old_price'], $item['stock']]);
}
echo "Roblox accounts inserted successfully!";
