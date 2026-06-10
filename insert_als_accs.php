<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Ensure category ID 6 exists and name is exactly 'Dịch Vụ Anime Last Stand'
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE id = 6");
    $stmt->execute();
    if (!$stmt->fetch()) {
        $pdo->prepare("INSERT INTO categories (id, name, slug, description) VALUES (6, 'Dịch Vụ Anime Last Stand', 'dich-vu-anime-last-stand', 'Dịch Vụ Game Anime Last Stand')")->execute();
        echo "Created category ID 6 'Dịch Vụ Anime Last Stand'.\n";
    }

    // 2. Remove existing ALS accounts to avoid duplication when running multiple times
    $pdo->prepare("DELETE FROM accounts WHERE category_id = 6")->execute();
    echo "Cleared old accounts in category ID 6.\n";

    // 3. Insert the new account
    $insertQuery = "INSERT INTO accounts (category_id, title, description, image_url, price, old_price, game_username, game_password, stock, status) 
                    VALUES (6, ?, ?, ?, ?, ?, 'als_user', 'als_pass', ?, 'available')";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->execute([
        'Random Acc 100% Có Dragon',
        '100% DRAGON TRONG RƯƠNG. Tài khoản Anime Last Stand cực vip có sẵn Dragon và nhiều vật phẩm giá trị.',
        'anime_last_stand_dragon.png',
        99000,
        198000,
        18
    ]);

    echo "Successfully inserted 'Random Acc 100% Có Dragon' into category ID 6!\n";

} catch (PDOException $e) {
    echo "DATABASE ERROR: " . $e->getMessage() . "\n";
}
?>
