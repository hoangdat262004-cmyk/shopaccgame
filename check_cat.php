<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame', 'root', '');
print_r($pdo->query('DESCRIBE categories')->fetchAll(PDO::FETCH_ASSOC));
