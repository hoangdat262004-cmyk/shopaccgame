<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

$db->query("UPDATE accounts SET title = 'Nick GENSHIN IMPACT', image_url = 'images/Các Game Khác/Nick GENSHIN IMPACT.jpg' WHERE title = 'Nick GENSHIN IMPAC'");
$db->execute();

echo "Fixed Genshin image!";
