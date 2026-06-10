<?php
session_start();
require_once '../app/config/config.php';

try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If a username is specified via GET, e.g. make_admin.php?username=hoangdat004
    if (isset($_GET['username']) && !empty($_GET['username'])) {
        $username = trim($_GET['username']);
        $stmt = $pdo->prepare("UPDATE users SET role = 'admin' WHERE username = ?");
        $stmt->execute([$username]);
        
        // Also update session if it matches currently logged in user
        if (isset($_SESSION['username']) && $_SESSION['username'] === $username) {
            $_SESSION['role'] = 'admin';
        }
        
        echo "<h3 style='color: green;'>Nâng cấp tài khoản '" . htmlspecialchars($username) . "' thành Admin thành công!</h3>";
        echo "<p><a href='" . BASEURL . "/admin'>Vào Trang Admin</a> | <a href='" . BASEURL . "'>Về Trang Chủ</a></p>";
        exit;
    }

    // Otherwise, promote the currently logged in session user
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        
        $stmt = $pdo->prepare("UPDATE users SET role = 'admin' WHERE id = ?");
        $stmt->execute([$userId]);
        
        $_SESSION['role'] = 'admin';
        
        echo "<h3 style='color: green;'>Nâng cấp tài khoản đang đăng nhập '" . htmlspecialchars($username) . "' thành Admin thành công!</h3>";
        echo "<p>Đang tự động chuyển hướng đến trang quản trị...</p>";
        echo "<script>setTimeout(function() { window.location.href = '" . BASEURL . "/admin'; }, 2000);</script>";
        exit;
    } else {
        echo "<h3 style='color: red;'>Bạn chưa đăng nhập!</h3>";
        echo "<p>Vui lòng <a href='" . BASEURL . "/auth/login'>Đăng nhập tại đây</a> trước, sau đó truy cập lại trang này để tự động nhận quyền Admin.</p>";
    }

} catch (PDOException $e) {
    die("LỖI KHI NÂNG CẤP ADMIN: " . $e->getMessage());
}
