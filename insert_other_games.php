<?php
header('Content-Type: text/plain; charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Đảm bảo cột stock tồn tại
    try {
        $pdo->exec('ALTER TABLE accounts ADD COLUMN stock INT DEFAULT 1');
        echo "Đã thêm cột stock (nếu chưa có).\n";
    } catch(Exception $e) {
        echo "Cột stock đã tồn tại hoặc không thể tạo: " . $e->getMessage() . "\n";
    }

    // 2. Đảm bảo danh mục 'Các Game Khác' tồn tại với ID = 5
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE id = 5");
    $stmt->execute();
    if (!$stmt->fetch()) {
        $pdo->prepare("INSERT INTO categories (id, name, slug, description) VALUES (5, 'Các Game Khác', 'các-game-khác', 'Nick Nhiều Game')")->execute();
        echo "Đã tạo danh mục 'Các Game Khác' (ID = 5).\n";
    } else {
        $pdo->prepare("UPDATE categories SET name = 'Các Game Khác', description = 'Nick Nhiều Game', slug = 'cac-game-khac' WHERE id = 5")->execute();
        echo "Đã cập nhật danh mục 'Các Game Khác' (ID = 5).\n";
    }

    // 3. Xóa các tài khoản cũ trong danh mục Các Game Khác để tránh trùng lặp khi chạy lại
    $pdo->prepare("DELETE FROM accounts WHERE category_id = 5")->execute();
    echo "Đã xóa các tài khoản cũ trong Các Game Khác để làm mới.\n";

    // 4. Thêm các tài khoản mới theo yêu cầu của bạn
    $data = [
        [
            'title' => 'Nick PUBG MOBILE',
            'price' => 0,
            'old_price' => 0,
            'stock' => 28,
            'image' => 'https://via.placeholder.com/400x200/2196F3/ffffff?text=PUBG+MOBILE'
        ],
        [
            'title' => 'Nick GENSHIN IMPACT',
            'price' => 0,
            'old_price' => 0,
            'stock' => 48,
            'image' => 'https://via.placeholder.com/400x200/9c27b0/ffffff?text=GENSHIN+IMPACT'
        ],
        [
            'title' => 'NICK VALORANT',
            'price' => 0,
            'old_price' => 0,
            'stock' => 19,
            'image' => 'https://via.placeholder.com/400x200/ff5722/ffffff?text=VALORANT'
        ],
        [
            'title' => 'Nick FO4',
            'price' => 0,
            'old_price' => 0,
            'stock' => 16,
            'image' => 'https://via.placeholder.com/400x200/4caf50/ffffff?text=FIFA+Online+4'
        ],
        [
            'title' => 'FC MOBILE',
            'price' => 0,
            'old_price' => 0,
            'stock' => 5,
            'image' => 'https://via.placeholder.com/400x200/ff9800/ffffff?text=FC+MOBILE'
        ]
    ];

    $insertQuery = "INSERT INTO accounts (category_id, title, description, image_url, price, old_price, game_username, game_password, stock, status) 
                    VALUES (5, ?, 'Tài khoản game cực vip', ?, ?, ?, 'game_user', 'game_pass', ?, 'available')";
    $stmt = $pdo->prepare($insertQuery);

    foreach ($data as $item) {
        $stmt->execute([
            $item['title'],
            $item['image'],
            $item['price'],
            $item['old_price'],
            $item['stock']
        ]);
        echo "Đã thêm tài khoản: " . $item['title'] . " (Số lượng: " . $item['stock'] . ")\n";
    }

    echo "\nThành công! Toàn bộ tài khoản đã được thêm vào mục Các Game Khác.";
} catch (PDOException $e) {
    echo "LỖI DATABASE: " . $e->getMessage();
}
?>
