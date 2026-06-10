<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame', 'root', '');
$pdo->exec("UPDATE users SET role='admin' WHERE id=1");
echo "User 1 is now admin.\n";
