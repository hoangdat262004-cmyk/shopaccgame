<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
    <!-- Google Fonts: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-primary: #0b0f19;
            --bg-secondary: #111827;
            --bg-glass: rgba(17, 24, 39, 0.7);
            --bg-glass-hover: rgba(31, 41, 55, 0.8);
            --border-glass: rgba(255, 255, 255, 0.08);
            
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            
            --color-accent: #8b5cf6; /* Royal Violet */
            --color-accent-glow: rgba(139, 92, 246, 0.4);
            --color-secondary: #06b6d4; /* Neon Cyan */
            --color-secondary-glow: rgba(6, 182, 212, 0.4);
            
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-danger: #ef4444;
            --color-info: #3b82f6;
            
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius-lg: 16px;
            --border-radius-md: 12px;
            --shadow-premium: 0 10px 30px -10px rgba(0, 0, 0, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-primary);
            background-image: 
                radial-gradient(at 10% 20%, rgba(139, 92, 246, 0.15) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(6, 182, 212, 0.12) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-primary);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--color-accent);
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            background: var(--bg-glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-right: 1px solid var(--border-glass);
            min-height: 100vh;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-premium);
            transition: var(--transition-smooth);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 15px 30px 15px;
            border-bottom: 1px solid var(--border-glass);
            margin-bottom: 25px;
        }

        .sidebar-brand i {
            font-size: 24px;
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-brand h2 {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #fff, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: var(--border-radius-md);
            font-size: 15px;
            font-weight: 500;
            transition: var(--transition-smooth);
            border: 1px solid transparent;
        }

        .sidebar-menu li a i {
            font-size: 18px;
            width: 20px;
            text-align: center;
            transition: var(--transition-smooth);
        }

        .sidebar-menu li a:hover {
            color: #fff;
            background: var(--bg-glass-hover);
            border-color: rgba(255, 255, 255, 0.05);
            transform: translateX(5px);
        }

        .sidebar-menu li a.active, 
        .sidebar-menu li a:focus {
            color: #fff;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(6, 182, 212, 0.15));
            border-color: rgba(139, 92, 246, 0.3);
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.1);
        }

        .sidebar-menu li a.active i {
            color: var(--color-accent);
            text-shadow: 0 0 10px var(--color-accent-glow);
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid var(--border-glass);
            padding-top: 20px;
        }

        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: #f43f5e;
            text-decoration: none;
            border-radius: var(--border-radius-md);
            font-size: 15px;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .sidebar-footer a:hover {
            background: rgba(244, 63, 94, 0.1);
            transform: translateX(5px);
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 280px;
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition-smooth);
        }

        /* Topbar Styling */
        .topbar {
            background: rgba(11, 15, 25, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-glass);
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .topbar-title h1 {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .btn-view-shop {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: var(--bg-glass);
            border: 1px solid var(--border-glass);
            border-radius: 30px;
            color: var(--text-main);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition-smooth);
        }

        .btn-view-shop:hover {
            background: var(--color-secondary);
            color: #0b0f19;
            box-shadow: 0 0 15px var(--color-secondary-glow);
            border-color: transparent;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #fff;
            box-shadow: 0 0 10px rgba(139, 92, 246, 0.3);
        }

        .admin-info {
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .admin-role {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Content Area */
        .content-area {
            padding: 40px;
            flex: 1;
        }

        /* Cards & Containers */
        .card {
            background: var(--bg-glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-glass);
            border-radius: var(--border-radius-lg);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-premium);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--color-accent), var(--color-secondary));
            opacity: 0.7;
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .card h2 {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card p {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.6;
        }

        /* Tables */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: left;
        }

        table th {
            background: rgba(255, 255, 255, 0.02);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-glass);
        }

        table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            color: var(--text-main);
            font-size: 14px;
            vertical-align: middle;
        }

        table tbody tr {
            transition: var(--transition-smooth);
        }

        table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Forms */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            border-radius: var(--border-radius-md);
            color: #fff;
            font-size: 14px;
            outline: none;
            transition: var(--transition-smooth);
        }

        .form-control:focus {
            border-color: var(--color-accent);
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 12px rgba(139, 92, 246, 0.2);
        }

        select.form-control {
            cursor: pointer;
        }

        select.form-control option {
            background: var(--bg-primary);
            color: #fff;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            border-radius: var(--border-radius-md);
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--color-accent), #7c3aed);
            color: #fff;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .btn-secondary {
            background: var(--bg-glass-hover);
            border: 1px solid var(--border-glass);
            color: var(--text-main);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
        }

        .btn-danger:hover {
            background: var(--color-danger);
            color: #fff;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            transform: translateY(-1px);
        }

        .btn-sm {
            padding: 8px 14px;
            font-size: 12px;
            border-radius: 8px;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.12);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .badge-info {
            background: rgba(59, 130, 246, 0.12);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        /* Alert notifications */
        .alert {
            padding: 16px 20px;
            border-radius: var(--border-radius-md);
            margin-bottom: 25px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid transparent;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        /* Grid */
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: var(--bg-glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-glass);
            border-radius: var(--border-radius-lg);
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-premium);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(139, 92, 246, 0.3);
            box-shadow: 0 15px 30px rgba(139, 92, 246, 0.15);
        }

        .stat-card-left {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .stat-card-title {
            font-size: 13px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-card-value {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--border-radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            transition: var(--transition-smooth);
        }

        .stat-card:hover .stat-card-icon {
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            color: #0b0f19;
            border-color: transparent;
            box-shadow: 0 0 15px var(--color-accent-glow);
        }

        /* Image styling */
        .img-rounded {
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border-glass);
        }

        .acc-details-wrapper {
            background: rgba(0, 0, 0, 0.2);
            padding: 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            font-family: monospace;
            font-size: 13px;
            margin-top: 10px;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: var(--bg-secondary);
            border: 1px solid var(--border-glass);
            border-radius: var(--border-radius-lg);
            width: 90%;
            max-width: 500px;
            box-shadow: var(--shadow-premium);
            animation: slideDown 0.3s ease;
            position: relative;
        }

        .modal-header {
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-glass);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
        }

        .modal-close {
            color: var(--text-muted);
            font-size: 20px;
            cursor: pointer;
            background: none;
            border: none;
            transition: var(--transition-smooth);
        }

        .modal-close:hover {
            color: #fff;
        }

        .modal-body {
            padding: 25px;
        }

        @keyframes slideDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Helper styles */
        .flex-center {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .color-accent-text {
            color: var(--color-accent);
        }

        .color-secondary-text {
            color: var(--color-secondary);
        }

        .hover-glow {
            transition: var(--transition-smooth);
        }

        .hover-glow:hover {
            text-shadow: 0 0 8px var(--color-accent-glow);
        }

        /* Responsive layout */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                padding: 30px 10px;
            }
            .sidebar-brand h2, 
            .sidebar-menu li a span,
            .sidebar-footer a span {
                display: none;
            }
            .sidebar-brand {
                justify-content: center;
                padding: 10px 0 30px 0;
            }
            .sidebar-menu li a {
                justify-content: center;
                padding: 14px 0;
            }
            .sidebar-footer a {
                justify-content: center;
                padding: 14px 0;
            }
            .main-content {
                margin-left: 80px;
            }
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 15px 20px;
            }
            .content-area {
                padding: 20px;
            }
            .stat-card {
                padding: 20px;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php
        // Active tab matching
        $current_url = $_GET['url'] ?? 'admin';
        $parts = explode('/', rtrim($current_url, '/'));
        $tab = $parts[1] ?? 'dashboard';
        if ($current_url === 'admin') {
            $tab = 'dashboard';
        }
    ?>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-bolt"></i>
            <h2>SHOP ADMIN</h2>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="<?= BASEURL; ?>/admin" class="<?= $tab === 'dashboard' ? 'active' : ''; ?>">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Tổng quan</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL; ?>/admin/categories" class="<?= $tab === 'categories' ? 'active' : ''; ?>">
                    <i class="fa-solid fa-folder-open"></i>
                    <span>Quản lý Danh mục</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL; ?>/admin/accounts" class="<?= $tab === 'accounts' ? 'active' : ''; ?>">
                    <i class="fa-solid fa-gamepad"></i>
                    <span>Quản lý Tài khoản</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL; ?>/admin/users" class="<?= $tab === 'users' ? 'active' : ''; ?>">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Quản lý Đăng nhập</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL; ?>/admin/transactions" class="<?= $tab === 'transactions' ? 'active' : ''; ?>">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Lịch sử Giao dịch</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="<?= BASEURL; ?>/auth/logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-title">
                <h1><?= $data['title_display'] ?? str_replace(' | SHOPGAMING', '', $data['title']); ?></h1>
            </div>
            <div class="topbar-right">
                <a href="<?= BASEURL; ?>" class="btn-view-shop" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>Xem Shop</span>
                </a>
                <div class="admin-profile">
                    <div class="admin-avatar">
                        <?= strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                    </div>
                    <div class="admin-info">
                        <span class="admin-name"><?= htmlspecialchars($_SESSION['username']); ?></span>
                        <span class="admin-role">Quản trị viên</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
