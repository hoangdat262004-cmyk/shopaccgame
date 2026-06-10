<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

// 1. Delete dummy accounts
$db->query("DELETE FROM accounts WHERE title LIKE 'Nick Tự Chọn Siêu Rẻ #%'");
$db->execute();

// 2. Fetch subcategories to move back
$db->query("SELECT * FROM categories WHERE parent_id IS NOT NULL AND parent_id > 0");
$subcats = $db->resultSet();

foreach($subcats as $cat) {
    // Insert back into accounts (price = 0, old_price = 0)
    $db->query("INSERT INTO accounts (category_id, title, price, old_price, status, image_url, description) VALUES (:cat_id, :title, 0, 0, 'available', :image_url, '')");
    $db->bind(':cat_id', $cat['parent_id']);
    $db->bind(':title', $cat['name']);
    $db->bind(':image_url', $cat['image_url']);
    $db->execute();
    
    // Delete the subcategory
    $db->query("DELETE FROM categories WHERE id = :id");
    $db->bind(':id', $cat['id']);
    $db->execute();
}

// 3. Drop parent_id column
try {
    $db->query("ALTER TABLE categories DROP FOREIGN KEY fk_parent_cat");
    $db->execute();
} catch(PDOException $e) {}

try {
    $db->query("ALTER TABLE categories DROP COLUMN parent_id");
    $db->execute();
} catch(PDOException $e) {}

echo "Reverted completely!";
