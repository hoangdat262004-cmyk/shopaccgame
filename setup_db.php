<?php
// Script to automatically set up the database and tables
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Create Database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS shopaccgame CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Database 'shopaccgame' created successfully.<br>";

    // Connect to the new database
    $pdo->exec("USE shopaccgame;");

    // 2. Create Users Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        balance DECIMAL(15,2) DEFAULT 0,
        role ENUM('user', 'admin') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );");
    echo "Table 'users' created successfully.<br>";

    // 3. Create Categories Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(100) NOT NULL UNIQUE,
        image VARCHAR(255) DEFAULT NULL
    );");
    echo "Table 'categories' created successfully.<br>";

    // 4. Create Accounts Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS accounts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        image VARCHAR(255) DEFAULT NULL,
        price DECIMAL(15,2) NOT NULL,
        old_price DECIMAL(15,2) DEFAULT NULL,
        status ENUM('available', 'sold') DEFAULT 'available',
        account_username VARCHAR(100) NOT NULL,
        account_password VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
    );");
    echo "Table 'accounts' created successfully.<br>";

    // 5. Create Transactions Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS transactions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        amount DECIMAL(15,2) NOT NULL,
        type ENUM('deposit', 'purchase') NOT NULL,
        status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );");
    echo "Table 'transactions' created successfully.<br>";

    echo "<h3>All done! You can now delete this file (setup_db.php) for security reasons.</h3>";
    echo "<a href='public/'>Go to Homepage</a>";

} catch (PDOException $e) {
    die("DB SETUP FAILED: " . $e->getMessage());
}
?>
