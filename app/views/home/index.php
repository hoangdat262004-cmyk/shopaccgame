<!-- Notifications handled globally in footer -->

<!-- Welcome Modal -->
<style>
.welcome-modal-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.7); z-index: 10001;
    display: none; align-items: center; justify-content: center;
    backdrop-filter: blur(5px);
}
.welcome-modal {
    background: #fff; width: 95%; max-width: 600px;
    border-radius: 8px; text-align: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    position: relative;
    animation: popIn 0.3s ease-out;
}
.welcome-header {
    padding: 15px; border-bottom: 1px solid #eee;
    font-size: 20px; font-weight: bold; color: #ef4444;
}
.welcome-close {
    position: absolute; top: 15px; right: 20px;
    font-size: 20px; color: #999; cursor: pointer; border: none; background: transparent;
}
.welcome-content {
    padding: 30px 20px;
}
.welcome-content p {
    margin-bottom: 10px; font-size: 16px;
}
.welcome-text-italic { font-style: italic; color: #666; }
.welcome-text-red { color: #dc2626; font-weight: bold; }
.welcome-text-bold { font-weight: bold; color: #333; }
.welcome-btn {
    background: #ef4444; color: #fff; border: none;
    padding: 10px 30px; font-weight: bold; border-radius: 5px;
    cursor: pointer; margin-top: 20px; font-size: 16px;
}
.welcome-btn:hover { background: #dc2626; }
</style>

<div class="welcome-modal-overlay" id="welcomeModal">
    <div class="welcome-modal">
        <button class="welcome-close" onclick="closeWelcomeModal()">✕</button>
        <div class="welcome-header">
            🔔 THÔNG BÁO
        </div>
        <div class="welcome-content">
            <p class="welcome-text-bold" style="font-size: 18px;">SHOP CHÍNH THỨC CỦA SHOPGAME</p>
            <p class="welcome-text-red" style="font-style: italic;">Hỗ trợ khách hàng 24/7:</p>
            <p class="welcome-text-red">GIẤY PHÉP KINH DOANH : 0402327608 - CÔNG TY TNHH SHOP ACC</p>
            <p class="welcome-text-red">LQ FF VMC - Mã số thuế 0402327608</p>
            <p class="welcome-text-bold">NẠP GAME GIÁ RẺ HƠN TẠI ĐÂY</p>
            <br>
            <p class="welcome-text-italic">PAGE HỖ TRỢ : CHĂM SÓC KHÁCH HÀNG <span class="welcome-text-red">( BẤM VÀO CHỮ ĐỎ LÀ RA )</span></p>
            <p class="welcome-text-red">TÌM NICK THEO YÊU CẦU LIÊN HỆ CSKH</p>
            <p class="welcome-text-red" style="font-style: italic; font-weight: normal;">Thu acc cho ae nghỉ game nhắn ngay <span style="font-weight: bold; cursor: pointer; text-decoration: underline;" onclick="window.open('https://facebook.com/admin', '_blank')">CHĂM SÓC KHÁCH HÀNG</span></p>
            
            <button class="welcome-btn" onclick="closeWelcomeModal()">Đã hiểu và Đóng</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if(!sessionStorage.getItem('welcomeShown')) {
            document.getElementById('welcomeModal').style.display = 'flex';
            sessionStorage.setItem('welcomeShown', 'true');
        }
    });

    function closeWelcomeModal() {
        document.getElementById('welcomeModal').style.display = 'none';
    }
</script>
<style>
/* Modern Responsive Hero Section */
.hero-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin: 30px 0;
}

/* Deposit Box (Right side on PC) */
.hero-deposit {
    flex: 0 0 350px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    padding: 24px;
    display: flex;
    flex-direction: column;
}
@media (max-width: 991px) {
    .hero-deposit {
        flex: 1 1 100%;
        order: 2; /* Move below banner on mobile */
    }
}
.hero-deposit h3 {
    font-size: 18px;
    font-weight: 800;
    color: #1f2937;
    margin-top: 0;
    margin-bottom: 20px;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 8px;
}
.deposit-tabs-modern {
    display: flex;
    background: #f3f4f6;
    border-radius: 8px;
    padding: 4px;
    margin-bottom: 20px;
}
.deposit-tabs-modern button {
    flex: 1;
    padding: 10px;
    border: none;
    background: transparent;
    border-radius: 6px;
    font-weight: 600;
    color: #6b7280;
    cursor: pointer;
    transition: 0.2s;
    font-size: 14px;
}
.deposit-tabs-modern button.active {
    background: #fff;
    color: #2563eb;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}
.hero-deposit select, .hero-deposit input {
    width: 100%;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    margin-bottom: 12px;
    font-size: 14px;
    outline: none;
    transition: 0.2s;
}
.hero-deposit select:focus, .hero-deposit input:focus {
    border-color: #2563eb;
}
.hero-deposit .form-row {
    display: flex;
    gap: 12px;
}
.btn-deposit-modern {
    width: 100%;
    background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
    color: #fff;
    border: none;
    padding: 14px;
    border-radius: 8px;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    text-transform: uppercase;
    margin-top: 5px;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    transition: 0.2s;
}
.btn-deposit-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
}

/* Banner Slider (Left side on PC) */
.hero-banner-modern {
    flex: 1 1 0%;
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    min-height: 250px;
}
@media (max-width: 991px) {
    .hero-banner-modern {
        flex: 1 1 100%;
        order: 1; /* Move above deposit on mobile */
        min-height: 200px;
    }
}
@media (max-width: 500px) {
    .hero-banner-modern {
        min-height: 150px;
    }
}
.slider-modern {
    width: 100%;
    height: 100%;
    position: relative;
    background: #0f172a;
}
.slide-modern {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    opacity: 0;
    transition: opacity 0.8s ease-in-out;
    object-fit: cover;
}
.slide-modern.active {
    opacity: 1;
}

/* Top list items */
.top-list-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: #f9fafb;
    border-radius: 8px;
    margin-bottom: 8px;
    border: 1px solid #f3f4f6;
}
.top-list-item:nth-child(1) { background: #fffbeb; border-color: #fef3c7; }
.top-list-item:nth-child(2) { background: #f3f4f6; border-color: #e5e7eb; }
.top-list-item:nth-child(3) { background: #fff7ed; border-color: #ffedd5; }
.top-rank { font-weight: 800; font-size: 14px; }
.top-list-item:nth-child(1) .top-rank { color: #d97706; }
.top-list-item:nth-child(2) .top-rank { color: #4b5563; }
.top-list-item:nth-child(3) .top-rank { color: #b45309; }
.top-list-item:nth-child(n+4) .top-rank { color: #111827; }
.top-amount { font-weight: bold; color: #ef4444; }
</style>

<div class="hero-wrapper">
    <!-- Banner Slider -->
    <div class="hero-banner-modern">
        <div class="slider-modern">
            <img class="slide-modern active" src="<?= BASEURL; ?>/uploads/banner/new_banner_1.png" alt="Game Night">
            <img class="slide-modern" src="<?= BASEURL; ?>/uploads/banner/new_banner_2.png" alt="Roblox FF">
            <!-- fallback original image just in case -->
            <img class="slide-modern" src="<?= BASEURL; ?>/uploads/banner/1.jpg" alt="Banner 3" onerror="this.remove()">
        </div>
    </div>

    <!-- Deposit Box -->
    <div class="hero-deposit">
        <h3>🏆 BẢNG XẾP HẠNG NẠP</h3>
        <div class="deposit-tabs-modern">
            <button class="active" onclick="showTabModern('napthe', this)">Nạp Thẻ Ngay</button>
            <button onclick="showTabModern('topnap', this)">Top Đại Gia</button>
        </div>
        
        <!-- Nạp thẻ tab -->
        <form id="napthe-tab-modern" action="<?= BASEURL; ?>/payment/deposit" method="POST" class="deposit-form">
            <select name="provider" required>
                <option value="">-- Chọn nhà mạng --</option>
                <option value="viettel">Viettel</option>
                <option value="mobi">Mobifone</option>
                <option value="vina">Vinaphone</option>
            </select>
            <select name="amount" required>
                <option value="">-- Mệnh giá thẻ --</option>
                <option value="20000">20.000đ</option>
                <option value="50000">50.000đ</option>
                <option value="100000">100.000đ</option>
                <option value="200000">200.000đ</option>
                <option value="500000">500.000đ</option>
            </select>
            <div class="form-row">
                <input type="text" name="serial" placeholder="Số Seri" required style="flex: 1;">
                <input type="text" name="pin" placeholder="Mã thẻ" required style="flex: 1;">
            </div>
            <button type="submit" class="btn-deposit-modern">Nạp Ngay</button>
        </form>

        <!-- Top nạp tab -->
        <div id="topnap-tab-modern" style="display:none; max-height:210px; overflow-y:auto; padding-right:5px;">
            <?php if(empty($data['top_depositors'])): ?>
                <p style="text-align:center; color:#666; margin-top:20px;">Chưa có dữ liệu nạp.</p>
            <?php else: ?>
                <?php $i=1; foreach($data['top_depositors'] as $top): ?>
                    <div class="top-list-item">
                        <span class="top-rank">TOP <?= $i ?>: <?= htmlspecialchars($top['username']) ?></span>
                        <span class="top-amount"><?= number_format($top['total_deposit'], 0, ',', '.') ?>đ</span>
                    </div>
                <?php $i++; endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function showTabModern(tabId, btn) {
        document.getElementById('napthe-tab-modern').style.display = 'none';
        document.getElementById('topnap-tab-modern').style.display = 'none';
        document.getElementById(tabId + '-tab-modern').style.display = 'block';
        
        let buttons = document.querySelectorAll('.deposit-tabs-modern button');
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    let slideIndexModern = 0;
    const slidesModern = document.querySelectorAll('.slider-modern .slide-modern');
    if(slidesModern.length > 0) {
        setInterval(() => {
            slidesModern[slideIndexModern].classList.remove('active');
            slideIndexModern = (slideIndexModern + 1) % slidesModern.length;
            slidesModern[slideIndexModern].classList.add('active');
        }, 3500);
    }
</script>

<?php if(empty($data['categories'])): ?>
    <div class="game-section" style="text-align:center; padding: 50px;">
        <h2>Shop chưa có sản phẩm nào.</h2>
        <p>Vui lòng vào trang quản trị để thêm danh mục và tài khoản game.</p>
    </div>
<?php else: ?>
    <style>
    .category-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 15px;
    }
    .category-card {
        display: block; 
        background: #fff; 
        border: 1px solid #eee; 
        border-radius: 6px; 
        overflow: hidden; 
        text-align: center; 
        text-decoration: none; 
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s; 
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .category-card:hover {
        transform: translateY(-4px); 
        box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
        border-color: #f44336 !important;
    }
    .category-card-img img {
        position: absolute; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        transition: transform 0.4s ease;
    }
    .category-card:hover .category-card-img img {
        transform: scale(1.08);
    }
    .category-card-btn {
        display: inline-block; 
        margin-top: 8px; 
        font-size: 11px; 
        background: #f44336; 
        color: #fff; 
        padding: 4px 10px; 
        border-radius: 3px; 
        font-weight: bold;
        transition: background 0.2s;
    }
    .category-card:hover .category-card-btn {
        background: #d32f2f;
    }
    @media (max-width: 992px) {
        .category-grid {
            grid-template-columns: repeat(3, 1fr) !important;
        }
    }
    @media (max-width: 576px) {
        .category-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    </style>

    <!-- Section: Danh Mục Game -->
    <div class="game-section" style="margin-top: 20px; border-top: 3px solid #ff9800;">
        <div class="section-header" style="border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px;">
            <div>
                <h2 style="font-size: 22px; color: #333; margin: 0;">🎮 DANH MỤC GAME</h2>
                <p style="color: #666; margin: 5px 0 0 0; font-size: 14px;">Chọn game yêu thích để mua nick và tham gia túi mù ngay!</p>
            </div>
        </div>
        
        <div class="category-grid">
            <?php foreach($data['categories'] as $category): ?>
                <?php 
                    $catImg = htmlspecialchars($category['image_url'] ?? '');
                    $catImgSrc = (strpos($catImg, 'http') === 0 || empty($catImg)) ? $catImg : BASEURL . '/uploads/' . $catImg;
                    if (empty($catImgSrc)) {
                        $catImgSrc = 'https://picsum.photos/400/300?random=' . $category['id'];
                    }
                ?>
                <a href="<?= BASEURL; ?>/category/index/<?= $category['slug']; ?>" class="category-card">
                    <div class="category-card-img" style="position: relative; width: 100%; padding-top: 75%; overflow: hidden;">
                        <img src="<?= $catImgSrc; ?>" alt="<?= htmlspecialchars($category['name'] ?? ''); ?>">
                    </div>
                    <div class="category-card-body" style="padding: 12px 5px;">
                        <div class="category-card-title" style="font-size: 14px; font-weight: bold; color: #333; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars($category['name']); ?></div>
                        <span class="category-card-btn">XEM NGAY</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Section: Nick Đang Bán -->
    <?php foreach($data['categories'] as $category): ?>
        <?php 
            $catAccounts = isset($data['groupedAccounts'][$category['id']]) ? $data['groupedAccounts'][$category['id']] : [];
        ?>
        <div class="game-section" style="margin-top: 30px;">
            <div class="section-header" style="border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: flex-end;">
                <div>
                    <h2 style="font-size: 22px; color: #333; margin: 0;">🔥 <?= htmlspecialchars($category['name']); ?></h2>
                    <?php if(!empty($category['description'])): ?>
                        <p style="color: #666; margin: 5px 0 0 0; font-size: 14px;"><?= htmlspecialchars($category['description']); ?></p>
                    <?php endif; ?>
                </div>
                <a href="<?= BASEURL; ?>/category/index/<?= $category['slug']; ?>" class="btn-explore" style="background: #f44336; color: white; padding: 5px 15px; border-radius: 3px; font-weight: bold; text-decoration: none; align-self: center;">Xem tất cả</a>
            </div>
            
            <div class="product-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                <?php 
                    $catSubCategories = isset($data['groupedSubCategories'][$category['id']]) ? $data['groupedSubCategories'][$category['id']] : [];
                    $normalSubCats = [];
                    $timNickSubCats = [];
                    foreach($catSubCategories as $subCat) {
                        if (stripos(trim($subCat['name']), 'tìm nick') !== false) {
                            $timNickSubCats[] = $subCat;
                        } else {
                            $normalSubCats[] = $subCat;
                        }
                    }
                ?>
                
                <?php foreach($normalSubCats as $subCat): ?>
                    <a href="<?= BASEURL; ?>/category/index/<?= $subCat['slug']; ?>" class="shop-card">
                        <div class="shop-card-img">
                            <?php 
                                $subCatImg = htmlspecialchars($subCat['image_url'] ?? '');
                                $subCatImgSrc = (strpos($subCatImg, 'http') === 0) ? $subCatImg : BASEURL . '/uploads/' . $subCatImg;
                            ?>
                            <img src="<?= $subCatImgSrc; ?>" alt="Cat">
                            <div class="shop-card-badge">NEW</div>
                        </div>
                        <div class="shop-card-body">
                            <div class="shop-card-title"><?= htmlspecialchars($subCat['name']); ?></div>
                            <div class="shop-card-subtitle">
                                Tài khoản hiện có: <span><?= isset($subCat['stock']) ? $subCat['stock'] : 0; ?></span>
                            </div>
                            <div class="shop-card-footer" style="min-height: 25px;"></div>
                        </div>
                    </a>
                <?php endforeach; ?>

                <?php if(empty($catAccounts) && empty($catSubCategories)): ?>
                    <p style="color:#666; font-style:italic; grid-column: 1/-1;">Chưa có tài khoản nào trong danh mục này.</p>
                <?php else: ?>
                    <?php foreach($catAccounts as $acc): ?>
                        <a href="<?= BASEURL; ?>/account/detail/<?= $acc['id']; ?>" class="shop-card">
                            <div class="shop-card-img">
                                <?php 
                                    $accImg = htmlspecialchars($acc['image_url'] ?? '');
                                    $accImgSrc = (strpos($accImg, 'http') === 0) ? $accImg : BASEURL . '/uploads/' . $accImg;
                                ?>
                                <img src="<?= $accImgSrc; ?>" alt="Acc">
                                <?php $oldPrice = isset($acc['old_price']) ? $acc['old_price'] : 0; ?>
                                <?php if($oldPrice > $acc['price']): ?>
                                    <div class="shop-card-badge sale">GIẢM GIÁ</div>
                                <?php else: ?>
                                    <div class="shop-card-badge">NEW</div>
                                <?php endif; ?>
                            </div>
                            <div class="shop-card-body">
                                <div class="shop-card-title"><?= htmlspecialchars($acc['title']); ?></div>
                                <div class="shop-card-subtitle">
                                    <?php if(isset($acc['stock'])): ?>
                                        Tài khoản hiện có: <span><?= $acc['stock']; ?></span>
                                    <?php else: ?>
                                        Mã Số: <span>#<?= $acc['id']; ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if($acc['price'] > 0): ?>
                                    <div class="shop-card-footer">
                                        <div class="shop-card-price">
                                            <?php if($oldPrice > 0): ?>
                                                <span class="shop-card-old-price"><?= number_format($oldPrice, 0, ',', '.'); ?>đ</span>
                                            <?php endif; ?>
                                            <span class="shop-card-new-price"><?= number_format($acc['price'], 0, ',', '.'); ?>đ</span>
                                        </div>
                                        <?php if($acc['status'] == 'available'): ?>
                                            <button class="shop-card-btn">MUA NGAY</button>
                                        <?php else: ?>
                                            <button class="shop-card-btn" style="background:#999;" disabled>ĐÃ BÁN</button>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php foreach($timNickSubCats as $subCat): ?>
                    <a href="<?= BASEURL; ?>/category/index/<?= $subCat['slug']; ?>" class="shop-card">
                        <div class="shop-card-img">
                            <?php 
                                $subCatImg = htmlspecialchars($subCat['image_url'] ?? '');
                                $subCatImgSrc = (strpos($subCatImg, 'http') === 0) ? $subCatImg : BASEURL . '/uploads/' . $subCatImg;
                            ?>
                            <img src="<?= $subCatImgSrc; ?>" alt="Cat">
                            <div class="shop-card-badge">NEW</div>
                        </div>
                        <div class="shop-card-body">
                            <div class="shop-card-title"><?= htmlspecialchars($subCat['name']); ?></div>
                            <div class="shop-card-subtitle">
                                Tài khoản hiện có: <span><?= isset($subCat['stock']) ? $subCat['stock'] : 0; ?></span>
                            </div>
                            <div class="shop-card-footer" style="min-height: 25px;"></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
