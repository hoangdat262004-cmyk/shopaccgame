<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');
echo "Categories:\n";
print_r($pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC));
echo "\nAccounts:\n";
print_r($pdo->query("SELECT * FROM accounts")->fetchAll(PDO::FETCH_ASSOC));
