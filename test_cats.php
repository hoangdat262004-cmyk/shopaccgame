<?php
require 'app/config/config.php';
require 'app/core/Database.php';
require 'app/models/CategoryModel.php';
$c = new CategoryModel();
$cats = $c->getAllCategories();
echo "Count: " . count($cats) . "\n";
print_r($cats);
