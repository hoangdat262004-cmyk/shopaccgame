<?php
// Tải danh mục game động cho menu
if (!isset($categories_for_nav)) {
    try {
        if (!class_exists('Database')) {
            require_once '../app/core/Database.php';
        }
        if (!class_exists('CategoryModel')) {
            require_once '../app/models/CategoryModel.php';
        }
        $catModelForHeader = new CategoryModel();
        $categories_for_nav = $catModelForHeader->getAllCategories();
    } catch (Exception $e) {
        $categories_for_nav = [];
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['title']) ? $data['title'] : 'Shop Acc Game'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css?v=<?= time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body style="background: url('<?= BASEURL; ?>/uploads/banner/bg.png') no-repeat center center fixed; background-size: cover;">
    <header class="site-header">
        <div class="container header-inner">
            <div class="logo">
                <a href="<?= BASEURL; ?>"><div class="text-logo">SHOPGAMING</div></a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="<?= BASEURL; ?>">TRANG CHỦ</a></li>
                    <li class="nav-item-dropdown">
                        <a href="javascript:void(0);" class="dropdown-trigger">DANH MỤC GAME ▾</a>
                        <ul class="dropdown-menu">
                            <?php if(!empty($categories_for_nav)): ?>
                                <?php foreach($categories_for_nav as $cat): ?>
                                    <li><a href="<?= BASEURL; ?>/category/index/<?= $cat['slug']; ?>"><?= htmlspecialchars($cat['name']); ?></a></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><a href="#">Chưa có game</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item-dropdown">
                        <a href="javascript:void(0);" class="dropdown-trigger">TIẾP THỊ LIÊN KẾT ▾</a>
                        <ul class="dropdown-menu affiliate-dropdown">
                            <li><a href="<?= BASEURL; ?>/affiliate/stats">Thống kê</a></li>
                            <li><a href="<?= BASEURL; ?>/affiliate/history">Lịch sử hoa hồng</a></li>
                            <li><a href="<?= BASEURL; ?>/affiliate/withdraw">Rút tiền</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= BASEURL; ?>/news">TIN TỨC</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <a href="<?= BASEURL; ?>/payment" class="btn btn-red">Nạp tiền</a>
                <a href="#" class="notification-bell">🔔</a>
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <div class="user-dropdown-container" style="position: relative; display: inline-block;">
                        <div class="user-dropdown-trigger" style="display: flex; align-items: center; gap: 10px; cursor: pointer; background: white; padding: 5px 15px 5px 5px; border-radius: 50px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['username']); ?>&background=random" alt="Avatar" style="width: 36px; height: 36px; border-radius: 50%; border: 2px solid #e5e7eb;">
                            <div style="display: flex; flex-direction: column; align-items: flex-start; line-height: 1.2;">
                                <span style="font-weight: bold; font-size: 14px; color: #1f2937;"><?= htmlspecialchars($_SESSION['username']); ?></span>
                                <span style="font-weight: bold; font-size: 12px; color: #ef4444;"><?= number_format($_SESSION['balance'], 0, ',', '.'); ?> đ</span>
                            </div>
                            <span style="color: #6b7280; font-size: 10px; margin-left: 5px;">▼</span>
                        </div>
                        
                        <div class="user-dropdown-menu" style="display: none; position: absolute; right: 0; top: calc(100% + 15px); width: 280px; background: white; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 1px solid #f3f4f6; z-index: 1000; overflow: hidden; text-align: left;">
                            <div style="padding: 15px; border-bottom: 1px solid #f3f4f6; background: #fff;">
                                <div style="font-size: 14px; color: #4b5563; margin-bottom: 5px;"><strong>ID:</strong> <?= $_SESSION['user_id']; ?></div>
                                <div style="font-size: 14px; color: #4b5563;"><strong>Số dư:</strong> <span style="color: #ef4444; font-weight: bold;"><?= number_format($_SESSION['balance'], 0, ',', '.'); ?> đ</span></div>
                            </div>
                            
                            <div style="padding: 10px 0; background: #fff;">
                                <a href="<?= BASEURL; ?>/profile" class="user-menu-item" style="padding: 10px 20px; display: block; color: #1f2937; text-decoration: none; font-weight: 500; font-size: 15px;">Quản lý tài khoản</a>
                                
                                <div class="user-menu-section" style="padding: 15px 20px 5px; font-size: 11px; font-weight: 800; color: #ef4444; text-transform: uppercase;">LỊCH SỬ</div>
                                <a href="<?= BASEURL; ?>/profile/deposit_history" class="user-menu-item"><span>›</span> Lịch sử nạp tiền</a>
                                <a href="<?= BASEURL; ?>/profile/item_history" class="user-menu-item"><span>›</span> Lịch sử mua vật phẩm</a>
                                <a href="<?= BASEURL; ?>/cart" class="user-menu-item"><span>›</span> Giỏ hàng đã thêm</a>
                                <a href="<?= BASEURL; ?>/" class="user-menu-item"><span>›</span> Mua tài khoản (nick)</a>
                                <a href="<?= BASEURL; ?>/profile/minigame_history" class="user-menu-item"><span>›</span> Minigame đã chơi</a>
                                
                                <div class="user-menu-section" style="padding: 15px 20px 5px; font-size: 11px; font-weight: 800; color: #ef4444; text-transform: uppercase;">DỊCH VỤ</div>
                                <a href="<?= BASEURL; ?>/affiliate" class="user-menu-item"><span>›</span> Tiếp thị liên kết</a>
                                <a href="<?= BASEURL; ?>/services/boosting" class="user-menu-item"><span>›</span> Đơn cày thuê</a>
                                
                                <div class="user-menu-section" style="padding: 15px 20px 5px; font-size: 11px; font-weight: 800; color: #ef4444; text-transform: uppercase;">KHÁC</div>
                                <a href="<?= BASEURL; ?>/profile/withdraw_items" class="user-menu-item"><span>›</span> Rút vật phẩm</a>
                                <a href="<?= BASEURL; ?>/auth/logout" class="user-menu-item" style="font-weight: 500;"><span>›</span> Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                    
                    <style>
                    .user-menu-item {
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        padding: 10px 20px;
                        color: #1f2937;
                        text-decoration: none;
                        font-size: 14px;
                        font-weight: 500;
                        transition: background 0.2s;
                    }
                    .user-menu-item span {
                        font-size: 14px;
                        color: #4b5563;
                        font-weight: bold;
                    }
                    .user-menu-item:hover {
                        background: #f9fafb;
                    }
                    .user-dropdown-container.active .user-dropdown-menu {
                        display: block !important;
                    }
                    .user-dropdown-container::after {
                        content: '';
                        position: absolute;
                        top: 100%;
                        right: 35px;
                        border-width: 8px;
                        border-style: solid;
                        border-color: transparent transparent white transparent;
                        display: none;
                        z-index: 1001;
                    }
                    .user-dropdown-container.active::after {
                        display: block;
                    }
                    </style>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const userTrigger = document.querySelector('.user-dropdown-trigger');
                        if(userTrigger) {
                            userTrigger.addEventListener('click', function(e) {
                                e.stopPropagation();
                                this.parentElement.classList.toggle('active');
                            });
                            
                            document.addEventListener('click', function() {
                                const container = document.querySelector('.user-dropdown-container');
                                if(container) container.classList.remove('active');
                            });
                        }
                    });
                    </script>
                <?php else : ?>
                    <a href="<?= BASEURL; ?>/auth/login" class="auth-links">👤 Đăng nhập / Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <div class="tax-banner">
        <div class="container">Mã số thuế 0402327608</div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const triggers = document.querySelectorAll('.dropdown-trigger');
        
        triggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const parent = this.parentElement;
                const menu = parent.querySelector('.dropdown-menu');
                
                // Đóng tất cả các menu thả xuống khác
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) {
                        m.classList.remove('show');
                    }
                });
                
                // Bật/tắt menu hiện tại
                menu.classList.toggle('show');
            });
        });
        
        // Đóng menu khi nhấp ra ngoài vùng menu
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        });
    });
    </script>
    
    <div class="main-content container">
