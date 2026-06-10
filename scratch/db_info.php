<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame', 'root', '');
echo "CATEGORIES COLUMNS:\n";
print_r($pdo->query('DESCRIBE categories')->fetchAll(PDO::FETCH_ASSOC));
echo "ACCOUNTS COLUMNS:\n";
print_r($pdo->query('DESCRIBE accounts')->fetchAll(PDO::FETCH_ASSOC));
echo "USERS COLUMNS:\n";
print_r($pdo->query('DESCRIBE users')->fetchAll(PDO::FETCH_ASSOC));
echo "TRANSACTIONS COLUMNS:\n";
print_r($pdo->query('DESCRIBE transactions')->fetchAll(PDO::FETCH_ASSOC));
