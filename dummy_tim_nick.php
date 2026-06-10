<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

// Get the category ID for "Tìm Nick Theo Yêu Cầu" (Liên Quân)
$db->query("SELECT id FROM categories WHERE name = 'Tìm Nick Theo Yêu Cầu' LIMIT 1");
$cat = $db->single();

if ($cat) {
    // Check if it already has accounts
    $db->query("SELECT COUNT(*) as cnt FROM accounts WHERE category_id = :cat_id");
    $db->bind(':cat_id', $cat['id']);
    $res = $db->single();
    
    if ($res['cnt'] == 0) {
        // Insert 12 dummy accounts
        for ($i = 1; $i <= 12; $i++) {
            $db->query("INSERT INTO accounts (category_id, title, price, old_price, status, image_url, description) VALUES (:cat_id, :title, :price, :old_price, 'available', :image_url, 'Trắng thông tin')");
            $db->bind(':cat_id', $cat['id']);
            $db->bind(':title', "Tìm Nick Theo Yêu Cầu #" . (132 + $i));
            $prices = [20000, 35000, 50000];
            $db->bind(':price', $prices[array_rand($prices)]);
            $db->bind(':old_price', 50000);
            $db->bind(':image_url', 'cce5a9e2f650726a658b9aaa6efa3a53.jpg'); // Use the exact filename the user requested!
            $db->execute();
        }
        echo "Created 12 dummy accounts for Tìm Nick Theo Yêu Cầu!";
    } else {
        // Just update existing accounts
        $db->query("UPDATE accounts SET image_url = 'cce5a9e2f650726a658b9aaa6efa3a53.jpg' WHERE category_id = :cat_id");
        $db->bind(':cat_id', $cat['id']);
        $db->execute();
        echo "Updated image for existing accounts!";
    }
}
