<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // List of updates: id => local image path relative to public/uploads
    $updates = [
        // Category 1: Liên Quân
        1 => 'LIENQUANRAMDOM/1.jpg', // Nick Tự Chọn Siêu Rẻ
        2 => 'LIENQUANRAMDOM/2.jpg', // Nick VIP
        3 => 'LIENQUANRAMDOM/3.jpg', // Nick Liên Quân REG
        4 => 'LIENQUANRAMDOM/tuimu.jpg', // Túi Mù 1 Nghìn
        5 => 'LIENQUANRAMDOM/20k.jpg',   // Túi Mù 20K
        6 => 'LIENQUANRAMDOM/100k.jpg',  // Túi Mù 99K
        7 => 'LIENQUANRAMDOM/200k.jpg',  // Túi Mù 299K
        8 => 'LIENQUANRAMDOM/4.jpg',    // Túi mù 699K

        // Category 2: Free Fire
        9  => 'FREE FIRE_GAMEKHAC.jpg/1.jpg', // Nick Free Fire tự chọn
        14 => 'FREE FIRE_GAMEKHAC.jpg/2.jpg', // Túi Mù FF 99K
        15 => 'FREE FIRE_GAMEKHAC.jpg/4.jpg', // Túi Mù FF 199k
        16 => 'FREE FIRE_GAMEKHAC.jpg/5.jpg', // Túi Mù FF 499K

        // Category 3: Nick Roblox
        17 => 'BLOX FRUITS.jpg/1.jpg', // ACC FISCH TỰ CHỌN
        18 => 'BLOX FRUITS.jpg/2.jpg', // Nick BLOX FRUITS
        19 => 'BLOX FRUITS.jpg/3.jpg', // NICK ROBOX FRUITS FULL GEAR 7 TỘC
        20 => 'BLOX FRUITS.jpg/4.jpg', // ACC GROW A GARDEN
        21 => 'BLOX FRUITS.jpg/5.jpg', // ACC DRACO

        // Category 4: Liên Minh + TFT
        22 => 'DTCL_LIENMINH_VALORANT/1.jpg', // Nick TFT Tự chọn
        23 => 'DTCL_LIENMINH_VALORANT/2.jpg', // Nick Liên Minh Tự Chọn

        // Category 5: Các Game Khác
        24 => 'FREE FIRE_GAMEKHAC.jpg/pubg.jpg', // Nick PUBG MOBILE
        25 => 'DTCL_LIENMINH_VALORANT/3.jpg',    // Nick GENSHIN IMPACT
        26 => 'DTCL_LIENMINH_VALORANT/4.jpg',    // NICK VALORANT
        27 => 'DTCL_LIENMINH_VALORANT/5.jpg',    // Nick FO4
        28 => 'DTCL_LIENMINH_VALORANT/6.jpg',    // FC MOBILE
    ];

    $stmt = $pdo->prepare("UPDATE accounts SET image_url = ? WHERE id = ?");
    foreach ($updates as $id => $imagePath) {
        $stmt->execute([$imagePath, $id]);
        echo "Updated Account ID {$id} with image path: {$imagePath}\n";
    }

    echo "\nAll account images updated successfully!\n";

} catch (PDOException $e) {
    echo "DATABASE ERROR: " . $e->getMessage() . "\n";
}
?>
