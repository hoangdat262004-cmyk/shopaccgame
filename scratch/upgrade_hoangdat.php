<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame', 'root', '');
$pdo->exec("UPDATE users SET role='admin' WHERE username='hoangdat004'");
echo "User 'hoangdat004' role updated to 'admin'.\n";
