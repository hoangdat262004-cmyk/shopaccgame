<?php
$conn = new mysqli('localhost', 'root', '');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$tables = ['account_code_details', 'accounts', 'categories', 'news', 'transactions', 'users'];
foreach ($tables as $table) {
    $conn->query("CREATE TABLE shopaccgame.$table LIKE ql_shopaccgame.$table");
    $conn->query("INSERT INTO shopaccgame.$table SELECT * FROM ql_shopaccgame.$table");
    echo "Copied $table\n";
}
echo "Done.";
?>
