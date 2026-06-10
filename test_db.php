<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();
try {
    $db->query("SELECT * FROM account_code_details LIMIT 1");
    $res = $db->single();
    print_r($res);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
