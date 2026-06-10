<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

// 1. Add parent_id to categories
try {
    $db->query("ALTER TABLE categories ADD COLUMN parent_id INT(11) DEFAULT NULL AFTER id");
    $db->execute();
    $db->query("ALTER TABLE categories ADD CONSTRAINT fk_parent_cat FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE");
    $db->execute();
    echo "Added parent_id column.\n";
} catch(PDOException $e) {
    echo "Column parent_id might already exist.\n";
}

// 2. Fetch all accounts with price = 0
$db->query("SELECT * FROM accounts WHERE price = 0 OR price IS NULL");
$folders = $db->resultSet();

$migratedCount = 0;
foreach($folders as $folder) {
    // Insert into categories
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $folder['title'])));
    
    $db->query("INSERT INTO categories (parent_id, name, slug, image_url, description) VALUES (:parent_id, :name, :slug, :image_url, :description)");
    $db->bind(':parent_id', $folder['category_id']); // The main game category
    $db->bind(':name', $folder['title']);
    $db->bind(':slug', $slug);
    $db->bind(':image_url', $folder['image_url']);
    $db->bind(':description', '');
    $db->execute();
    
    // Remember the new category ID
    $db->query("SELECT LAST_INSERT_ID() as id");
    $lastIdRow = $db->single();
    $newCategoryId = $lastIdRow['id'];
    
    // If this was the "Nick Tự Chọn Siêu Rẻ" (we know its name), we should insert some dummy accounts into it!
    if (trim($folder['title']) === 'Nick Tự Chọn Siêu Rẻ') {
        for ($i = 1; $i <= 12; $i++) {
            $db->query("INSERT INTO accounts (category_id, title, price, old_price, status, image_url, description) VALUES (:cat_id, :title, :price, :old_price, 'available', :image_url, 'Trắng thông tin')");
            $db->bind(':cat_id', $newCategoryId);
            $db->bind(':title', "Nick Tự Chọn Siêu Rẻ #" . (9354 + $i));
            $prices = [20000, 35000, 50000];
            $db->bind(':price', $prices[array_rand($prices)]);
            $db->bind(':old_price', 50000);
            $db->bind(':image_url', '1780585670_Tìm Nick Theo Yêu Cầu.jpg'); // The exact RANDOM LIEN QUAN image they uploaded!
            $db->execute();
        }
    }
    
    // Delete the migrated account
    $db->query("DELETE FROM accounts WHERE id = :id");
    $db->bind(':id', $folder['id']);
    $db->execute();
    
    $migratedCount++;
}

echo "Migrated $migratedCount folders into categories and created dummy accounts!";
