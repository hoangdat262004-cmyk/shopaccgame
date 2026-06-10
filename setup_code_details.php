<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table
    $pdo->exec("CREATE TABLE IF NOT EXISTS account_code_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        account_id INT NOT NULL,
        code INT NOT NULL,
        rank_name VARCHAR(100) DEFAULT '',
        num_skins INT DEFAULT 0,
        skin_names TEXT DEFAULT '',
        num_heroes INT DEFAULT 0,
        image_url VARCHAR(500) DEFAULT '',
        extra_info TEXT DEFAULT '',
        UNIQUE KEY unique_code (account_id, code)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "Table created!\n";

    // Preset data for Nick Liên Quân REG (account_id will be 3 based on insert_accs.php order)
    // We store for all possible account IDs that match REG (30,31,32,3 etc.)
    // Use account_id=0 as wildcard for "any REG account" - controller will look up by code only for REG
    $lq_images = [
        'LIENQUAN.jpg/1.jpg',
        'LIENQUAN.jpg/2.jpg',
        'LIENQUAN.jpg/3.jpg',
        'LIENQUAN.jpg/4.jpg',
        'LIENQUAN.jpg/5.jpg',
        'LIENQUANRAMDOM/1.jpg',
        'LIENQUANRAMDOM/2.jpg',
        'LIENQUANRAMDOM/3.jpg',
        'LIENQUANRAMDOM/4.jpg',
        'LIENQUANRAMDOM/50k.jpg',
        'LIENQUANRAMDOM/100k.jpg',
        'LIENQUANRAMDOM/200k.jpg',
        'LIENQUANRAMDOM/20k.jpg',
    ];

    $presets = [
        7652 => [
            'rank' => 'Bạch Kim I',
            'num_skins' => 28,
            'skin_names' => 'Butterfly Queen Violet, Gunner Mina, Dark Slayer Keera, Zodiac Grakk',
            'num_heroes' => 45,
            'image' => 'LIENQUAN.jpg/1.jpg',
            'extra' => 'Full trang, nhiều skin hiếm, rank ổn định'
        ],
        7651 => [
            'rank' => 'Kim Cương III',
            'num_skins' => 35,
            'skin_names' => 'Cyber Punk Zuka, Dragon Tamer Raz, Galaxy Alice, Neon City Arum',
            'num_heroes' => 52,
            'image' => 'LIENQUAN.jpg/2.jpg',
            'extra' => 'Kim Cương, nhiều skin limited, tài khoản uy tín'
        ],
        7650 => [
            'rank' => 'Kim Cương II',
            'num_skins' => 30,
            'skin_names' => 'Shadow Dancer Murad, Crystal Archer Elsu, Phoenix Tulen, Arctic Fox Celica',
            'num_heroes' => 48,
            'image' => 'LIENQUAN.jpg/3.jpg',
            'extra' => 'Kim Cương full tướng mid, skin chất lượng cao'
        ],
        4891 => [
            'rank' => 'Vàng II',
            'num_skins' => 12,
            'skin_names' => 'Dragon Knight Ryoma, Maid Tulen, Night Owl Thane',
            'num_heroes' => 30,
            'image' => 'LIENQUANRAMDOM/200k.jpg',
            'extra' => 'Tài khoản cân bằng, phù hợp người mới'
        ],
        4890 => [
            'rank' => 'Thách Đấu',
            'num_skins' => 65,
            'skin_names' => 'Super Idol Violet, Dragon God Lindis, Cosmic Dusk Keera, Sky Racer Mina, Emperor Nakroth',
            'num_heroes' => 72,
            'image' => 'LIENQUAN.jpg/4.jpg',
            'extra' => 'Thách Đấu Top Server, skin cực hiếm, full tướng'
        ],
        4885 => [
            'rank' => 'Thách Đấu',
            'num_skins' => 48,
            'skin_names' => 'Cyber Sakura Hayate, Dark Ronin Ryoma, Phantom Thief Zata, Ancient God Skud',
            'num_heroes' => 60,
            'image' => 'LIENQUAN.jpg/5.jpg',
            'extra' => 'Thách Đấu, đầy đủ tướng thịnh hành, nhiều skin event'
        ],
        4694 => [
            'rank' => 'Kim Cương I',
            'num_skins' => 40,
            'skin_names' => 'Lunar God Zuka, Starlight Butterfly Violet, Neon Dragon Raz',
            'num_heroes' => 55,
            'image' => 'LIENQUANRAMDOM/1.jpg',
            'extra' => 'Giảm 30%, Kim Cương I nhiều skin hiếm, tài khoản VIP'
        ],
        4693 => [
            'rank' => 'Bạch Kim II',
            'num_skins' => 22,
            'skin_names' => 'Chrome Wolf Omen, Rose Garden Lauriel, Sky Dance Arum',
            'num_heroes' => 38,
            'image' => 'LIENQUANRAMDOM/2.jpg',
            'extra' => 'Giảm 5%, Bạch Kim full tướng xếp hạng, ổn định'
        ],
        606 => [
            'rank' => 'Bạch Kim III',
            'num_skins' => 18,
            'skin_names' => 'Honey Bee Nata, Ice Queen Ilumia, Snow Bunny Mina',
            'num_heroes' => 32,
            'image' => 'LIENQUANRAMDOM/3.jpg',
            'extra' => 'Giảm 25%, Bạch Kim skin dễ thương, phù hợp top lane'
        ],
        554 => [
            'rank' => 'Thách Đấu',
            'num_skins' => 55,
            'skin_names' => 'Festival Dragon Zip, Golden Phoenix Ata, Space Explorer Zata, Royal Emperor Richter',
            'num_heroes' => 68,
            'image' => 'LIENQUANRAMDOM/4.jpg',
            'extra' => 'Giảm 19%, Thách Đấu top rank, skin giá trị cao nhất server'
        ],
        469 => [
            'rank' => 'Đồng III',
            'num_skins' => 5,
            'skin_names' => 'Basic Tulen, Starter Mina',
            'num_heroes' => 15,
            'image' => 'LIENQUANRAMDOM/20k.jpg',
            'extra' => 'Tài khoản cơ bản, phù hợp luyện tập'
        ],
        468 => [
            'rank' => 'Vàng I',
            'num_skins' => 10,
            'skin_names' => 'Street Racer Zuka, Classic Alice, Fire Spirit Diao Chan',
            'num_heroes' => 25,
            'image' => 'LIENQUANRAMDOM/50k.jpg',
            'extra' => 'Giảm 40%, Vàng I nhiều tướng, giá rẻ nhất'
        ],
        467 => [
            'rank' => 'Vàng III',
            'num_skins' => 8,
            'skin_names' => 'Dragon Scale Ryoma, Ancient Warrior Skud',
            'num_heroes' => 22,
            'image' => 'LIENQUANRAMDOM/100k.jpg',
            'extra' => 'Vàng III, tài khoản sạch, phù hợp mới bắt đầu rank'
        ],
        466 => [
            'rank' => 'Bạc II',
            'num_skins' => 6,
            'skin_names' => 'Classic Violet, Forest Spirit Yorn',
            'num_heroes' => 18,
            'image' => 'LIENQUANRAMDOM/200k.jpg',
            'extra' => 'Bạc II, ít tướng nhưng giá thấp, phù hợp dùng main'
        ],
        465 => [
            'rank' => 'Bạc III',
            'num_skins' => 7,
            'skin_names' => 'Bunny Nata, Festival Ormarr',
            'num_heroes' => 20,
            'image' => 'LIENQUANRAMDOM/1.jpg',
            'extra' => 'Bạc III, account sạch email, dễ thay đổi thông tin'
        ],
        464 => [
            'rank' => 'Đồng I',
            'num_skins' => 4,
            'skin_names' => 'Classic Omen, Default Butterfly',
            'num_heroes' => 12,
            'image' => 'LIENQUANRAMDOM/2.jpg',
            'extra' => 'Đồng I, tài khoản mới, chưa bị ban'
        ],
    ];

    $stmt = $pdo->prepare("INSERT INTO account_code_details 
        (account_id, code, rank_name, num_skins, skin_names, num_heroes, image_url, extra_info)
        VALUES (0, :code, :rank, :num_skins, :skin_names, :num_heroes, :image, :extra)
        ON DUPLICATE KEY UPDATE
            rank_name=VALUES(rank_name), num_skins=VALUES(num_skins), skin_names=VALUES(skin_names),
            num_heroes=VALUES(num_heroes), image_url=VALUES(image_url), extra_info=VALUES(extra_info)
    ");

    foreach ($presets as $code => $d) {
        $stmt->execute([
            ':code'      => $code,
            ':rank'      => $d['rank'],
            ':num_skins' => $d['num_skins'],
            ':skin_names'=> $d['skin_names'],
            ':num_heroes'=> $d['num_heroes'],
            ':image'     => $d['image'],
            ':extra'     => $d['extra'],
        ]);
        echo "Inserted code $code\n";
    }

    echo "\nDone! All preset REG code details inserted.\n";

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
?>
