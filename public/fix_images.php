<?php
require_once '../app/config/config.php';

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $dbh = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    echo "<h3>Đang sửa ảnh cho Danh Mục (Categories)...</h3>";
    
    // Default mappings for categories based on name
    $categoryMappings = [
        'liên quân' => 'LIENQUAN.jpg',
        'free fire' => 'FREE FIRE_GAMEKHAC.jpg',
        'roblox' => '1779355920_Nick BLOX FRUITS.jpg',
        'blox' => '1779355920_Nick BLOX FRUITS.jpg',
        'liên minh' => 'menugame/anh-linh-thu-dau-truong-chan-ly-1.jpg',
        'tft' => 'menugame/anh-linh-thu-dau-truong-chan-ly-1.jpg',
        'game khác' => 'FREE FIRE_GAMEKHAC.jpg',
        'anime' => 'anime_last_stand_dragon.png',
        'siêu rẻ' => 'Nick Tự Chọn Siêu Rẻ.jpg',
        'vip' => 'nick_vip_skins.jpg',
        'reg' => '1779355908_Nick VIP.jpg',
        'túi mù' => 'menugame/Hinh-nen-free-fire-3d-huyen-thoai.jpg',
        'fisch' => '1780912613_ACC FISCH TỰ CHỌN.jpg', // approximate name
        'grow a garden' => '1779355920_Nick BLOX FRUITS.jpg',
        'pubg' => '1779355936_Nick PUBG MOBILE.jpg',
        'genshin' => '1780585505_Nick GENSHIN IMPAC.jpg',
        'valorant' => 'DTCL_LIENMINH_VALORANT/1.jpg',
        'fo4' => 'FREE FIRE_GAMEKHAC.jpg',
        'fc mobile' => 'FREE FIRE_GAMEKHAC.jpg',
        'tự chọn' => 'ff_tuchon_img.jpg',
    ];

    $stmt = $dbh->query("SELECT id, name, image_url FROM categories");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categories as $cat) {
        $nameLower = mb_strtolower($cat['name'], 'UTF-8');
        $currentImg = $cat['image_url'];
        
        // If image is missing or is a placeholder
        if (empty($currentImg) || strpos($currentImg, 'placeholder.com') !== false || strpos($currentImg, 'picsum.photos') !== false) {
            $newImg = 'FREE FIRE_GAMEKHAC.jpg'; // fallback
            
            foreach ($categoryMappings as $key => $img) {
                if (strpos($nameLower, $key) !== false) {
                    $newImg = $img;
                    break;
                }
            }
            
            $dbh->prepare("UPDATE categories SET image_url = ? WHERE id = ?")->execute([$newImg, $cat['id']]);
            echo "Đã sửa Danh Mục ID {$cat['id']} ({$cat['name']}) -> {$newImg}<br>";
        }
    }

    echo "<h3>Đang sửa ảnh cho Tài Khoản (Accounts)...</h3>";
    
    $stmt = $dbh->query("SELECT id, title, image_url FROM accounts");
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($accounts as $acc) {
        $nameLower = mb_strtolower($acc['title'], 'UTF-8');
        $currentImg = $acc['image_url'];
        
        if (empty($currentImg) || strpos($currentImg, 'placeholder.com') !== false || strpos($currentImg, 'picsum.photos') !== false) {
            $newImg = 'FREE FIRE_GAMEKHAC.jpg';
            
            foreach ($categoryMappings as $key => $img) {
                if (strpos($nameLower, $key) !== false) {
                    $newImg = $img;
                    break;
                }
            }
            
            // Specific overrides
            if ($acc['id'] == 75) $newImg = 'Acc-Blox-Fruit-Vip.jpg';
            if ($acc['id'] == 77) $newImg = 'ACC DRACO.jpg';
            if ($acc['id'] == 30) $newImg = 'Nick Tự Chọn Siêu Rẻ.jpg';

            $dbh->prepare("UPDATE accounts SET image_url = ? WHERE id = ?")->execute([$newImg, $acc['id']]);
            echo "Đã sửa Account ID {$acc['id']} ({$acc['title']}) -> {$newImg}<br>";
        }
    }

    echo "<h3>Xong! Hãy về trang chủ kiểm tra!</h3>";
    
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
