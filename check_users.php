<?php
$pdo = new PDO('mysql:host=localhost;dbname=shopaccgame', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check columns
$stmt = $pdo->query('DESCRIBE users');
$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "=== USERS TABLE STRUCTURE ===\n";
foreach($cols as $c) {
    echo $c['Field'] . ' | ' . $c['Type'] . ' | ' . $c['Null'] . ' | ' . $c['Default'] . "\n";
}

// Add role column if missing
try {
    $pdo->exec("ALTER TABLE users ADD COLUMN role VARCHAR(20) DEFAULT 'user'");
    echo "\nAdded 'role' column!\n";
} catch(Exception $e) {
    echo "\nRole column: " . $e->getMessage() . "\n";
}

// Set user id=1 as admin
$pdo->exec("UPDATE users SET role='admin' WHERE id=1");
echo "User ID 1 set to admin.\n";

// Show all users
$stmt = $pdo->query('SELECT * FROM users LIMIT 10');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "\n=== ALL USERS ===\n";
foreach($rows as $r) {
    echo "ID: {$r['id']} | Username: {$r['username']} | Email: {$r['email']} | Role: {$r['role']} | Balance: {$r['balance']}\n";
}
