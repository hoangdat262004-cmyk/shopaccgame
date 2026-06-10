<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

$cat_id = 46; // Nick Free Fire tự chọn

$db->query("SELECT COUNT(*) as cnt FROM accounts WHERE category_id = :cat_id");
$db->bind(':cat_id', $cat_id);
$res = $db->single();

if ($res['cnt'] == 0) {
    for ($i = 1; $i <= 12; $i++) {
        $db->query("INSERT INTO accounts (category_id, title, price, old_price, status, image_url, description) VALUES (:cat_id, :title, :price, :old_price, 'available', :image_url, 'VIP Free Fire')");
        $db->bind(':cat_id', $cat_id);
        $db->bind(':title', "Nick Free Fire Tự Chọn #" . (120 + $i));
        $prices = [100000, 200000, 300000];
        $price = $prices[array_rand($prices)];
        $db->bind(':price', $price);
        $db->bind(':old_price', $price + 50000);
        $db->bind(':image_url', 'ff_tuchon_img.jpg'); 
        $db->execute();
    }
    echo "Created 12 accounts for Nick Free Fire tự chọn!\n";
} else {
    $db->query("UPDATE accounts SET image_url = 'ff_tuchon_img.jpg' WHERE category_id = :cat_id");
    $db->bind(':cat_id', $cat_id);
    $db->execute();
    echo "Updated image for existing accounts in Nick Free Fire tự chọn!\n";
}
