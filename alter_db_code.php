<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();
try {
    $db->query("ALTER TABLE account_code_details ADD COLUMN username VARCHAR(255) DEFAULT NULL, ADD COLUMN password VARCHAR(255) DEFAULT NULL, ADD COLUMN info TEXT DEFAULT NULL;");
    $db->execute();
    echo "Added columns to account_code_details.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
