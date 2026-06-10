<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();
try {
    $db->query("ALTER TABLE accounts ADD COLUMN stock INT DEFAULT 1;");
    $db->execute();
    echo "Successfully added stock column.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
