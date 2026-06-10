<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

// NICK VIP
$db->query("SELECT id FROM categories WHERE name = 'Nick VIP' LIMIT 1");
$catVip = $db->single();
if ($catVip) {
    $db->query("SELECT COUNT(*) as cnt FROM accounts WHERE category_id = :cat_id");
    $db->bind(':cat_id', $catVip['id']);
    $res = $db->single();
    if ($res['cnt'] == 0) {
        for ($i = 1; $i <= 12; $i++) {
            $db->query("INSERT INTO accounts (category_id, title, price, old_price, status, image_url, description) VALUES (:cat_id, :title, :price, :old_price, 'available', :image_url, 'VIP Cao Cấp')");
            $db->bind(':cat_id', $catVip['id']);
            $db->bind(':title', "Nick VIP #" . (5000 + $i));
            $prices = [300000, 500000, 800000];
            $price = $prices[array_rand($prices)];
            $db->bind(':price', $price);
            $db->bind(':old_price', $price + 200000);
            $db->bind(':image_url', '1779355908_Nick VIP.jpg'); 
            $db->execute();
        }
        echo "Created 12 accounts for Nick VIP!\n";
    }
}

// NICK LIÊN QUÂN REG
$db->query("SELECT id FROM categories WHERE name = 'Nick Liên Quân REG' LIMIT 1");
$catReg = $db->single();
if ($catReg) {
    $db->query("SELECT COUNT(*) as cnt FROM accounts WHERE category_id = :cat_id");
    $db->bind(':cat_id', $catReg['id']);
    $res = $db->single();
    if ($res['cnt'] == 0) {
        for ($i = 1; $i <= 12; $i++) {
            $db->query("INSERT INTO accounts (category_id, title, price, old_price, status, image_url, description) VALUES (:cat_id, :title, :price, :old_price, 'available', :image_url, 'Trắng thông tin')");
            $db->bind(':cat_id', $catReg['id']);
            $db->bind(':title', "Nick Liên Quân REG #" . (460 + $i));
            $prices = [180000, 200000, 400000];
            $price = $prices[array_rand($prices)];
            $db->bind(':price', $price);
            $db->bind(':old_price', $price + 50000);
            $db->bind(':image_url', 'lq_sieure_banner.png'); // Reuse an epic banner
            $db->execute();
        }
        echo "Created 12 accounts for Nick Liên Quân REG!\n";
    }
}
