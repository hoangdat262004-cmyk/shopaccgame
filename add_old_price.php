<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');
try {
    $pdo->exec('ALTER TABLE accounts ADD COLUMN old_price DECIMAL(10,2) DEFAULT 0');
    echo "Added old_price\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
