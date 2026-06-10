<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame', 'root', '');
echo "Categories:\n";
print_r($pdo->query('DESCRIBE categories')->fetchAll(PDO::FETCH_ASSOC));
echo "\nAccounts:\n";
print_r($pdo->query('DESCRIBE accounts')->fetchAll(PDO::FETCH_ASSOC));
