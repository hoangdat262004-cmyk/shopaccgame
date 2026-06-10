<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');
// Add stock column
try {
    $pdo->exec('ALTER TABLE accounts ADD COLUMN stock INT DEFAULT 1');
} catch(Exception $e) {}

$data = [
    [
        'title' => 'Nick Tự Chọn Siêu Rẻ',
        'price' => 0,
        'old_price' => 0,
        'stock' => 246,
        'image' => 'https://via.placeholder.com/400x200/4CAF50/ffffff?text=Nick+Tu+Chon'
    ],
    [
        'title' => 'Nick VIP',
        'price' => 0,
        'old_price' => 0,
        'stock' => 152,
        'image' => 'https://via.placeholder.com/400x200/FF9800/ffffff?text=Nick+VIP'
    ],
    [
        'title' => 'Nick Liên Quân REG',
        'price' => 0,
        'old_price' => 0,
        'stock' => 53,
        'image' => 'https://via.placeholder.com/400x200/2196F3/ffffff?text=Nick+REG'
    ],
    [
        'title' => 'Túi Mù 1 Nghìn',
        'price' => 1000,
        'old_price' => 2000,
        'stock' => 1371,
        'image' => 'https://via.placeholder.com/400x200/F44336/ffffff?text=Tui+Mu+1k'
    ],
    [
        'title' => 'Túi Mù 20K',
        'price' => 20000,
        'old_price' => 40000,
        'stock' => 226,
        'image' => 'https://via.placeholder.com/400x200/E91E63/ffffff?text=Tui+Mu+20k'
    ],
    [
        'title' => 'Túi Mù 99K',
        'price' => 99000,
        'old_price' => 198000,
        'stock' => 3,
        'image' => 'https://via.placeholder.com/400x200/9C27B0/ffffff?text=Tui+Mu+99k'
    ],
    [
        'title' => 'Túi Mù 299K',
        'price' => 299000,
        'old_price' => 598000,
        'stock' => 18,
        'image' => 'https://via.placeholder.com/400x200/673AB7/ffffff?text=Tui+Mu+299k'
    ],
    [
        'title' => 'Túi mù 699K',
        'price' => 699000,
        'old_price' => 1398000,
        'stock' => 20,
        'image' => 'https://via.placeholder.com/400x200/3F51B5/ffffff?text=Tui+Mu+699k'
    ]
];

$stmt = $pdo->prepare("INSERT INTO accounts (category_id, title, description, image_url, price, old_price, game_username, game_password, stock) VALUES (1, ?, 'Tài khoản cực xịn', ?, ?, ?, 'random_user', 'random_pass', ?)");

foreach($data as $item) {
    $stmt->execute([$item['title'], $item['image'], $item['price'], $item['old_price'], $item['stock']]);
}
echo "Inserted successfully!";
