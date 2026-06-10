<?php 
$category = $data['category']; 
$filters = isset($data['filters']) ? $data['filters'] : ['id'=>'', 'price'=>'', 'sort'=>'', 'info'=>''];
?>

<style>
/* Filter Section */
.category-title {
    color: #dc2626;
    font-size: 24px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 10px;
}
.filter-box {
    background: #fff;
    padding: 15px;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    margin-bottom: 20px;
}
.filter-title {
    font-weight: 600;
    margin-bottom: 10px;
    color: #374151;
}
.filter-form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
}
.filter-input {
    flex: 1;
    min-width: 150px;
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    outline: none;
    color: #4b5563;
}
.filter-input:focus {
    border-color: #ef4444;
}
.filter-btn {
    background: #ef4444;
    color: #fff;
    border: none;
    padding: 10px 30px;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
}
.filter-btn:hover {
    background: #dc2626;
}
.notice-text {
    background: #fff;
    padding: 15px;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    margin-bottom: 30px;
    color: #111827;
    font-size: 15px;
}

/* Redesigned Card */
.acc-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.acc-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    position: relative;
    transition: 0.2s;
    display: flex;
    flex-direction: column;
}
.acc-card:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}
.acc-img-wrapper {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* 16:9 Aspect Ratio */
    background: #f3f4f6;
    overflow: hidden;
}
.acc-img-wrapper img {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    object-fit: cover;
}
.acc-id-badge {
    position: absolute;
    top: 0; right: 0;
    background: #ef4444;
    color: #fff;
    padding: 2px 8px;
    font-size: 13px;
    font-weight: bold;
}
.acc-body {
    padding: 15px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.acc-price-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 10px;
    border-bottom: 1px dashed #e5e7eb;
    padding-bottom: 10px;
}
.acc-price-left {
    display: flex;
    flex-direction: column;
}
.acc-old-price-wrap {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 2px;
}
.acc-old-price {
    text-decoration: line-through;
    color: #6b7280;
    font-size: 13px;
}
.acc-discount {
    color: #ef4444;
    font-size: 13px;
    font-weight: bold;
}
.acc-new-price {
    color: #ef4444;
    font-size: 18px;
    font-weight: bold;
}
.acc-buy-btn {
    background: #ef4444;
    color: #fff;
    border: none;
    padding: 5px 12px;
    border-radius: 4px;
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
}
.acc-buy-btn:hover {
    background: #dc2626;
    color: #fff;
}
.acc-info {
    font-size: 13px;
    color: #111827;
    margin-bottom: 15px;
}
.acc-detail-link {
    text-align: center;
    color: #ef4444;
    font-size: 13px;
    text-decoration: none;
    margin-top: auto;
}
.acc-detail-link:hover {
    text-decoration: underline;
}
</style>

<div class="category-container">
    <h1 class="category-title"><?= htmlspecialchars($category['name']); ?></h1>

    <?php if(stripos($category['name'], 'tìm nick') !== false || stripos($category['name'], 'tim nick') !== false): ?>
        <!-- Custom layout for Tìm nick theo yêu cầu -->
        <div style="background: white; border: 1px solid #e5e7eb; border-radius: 4px; padding: 15px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="font-size: 14px; color: #374151; margin-bottom: 15px;">Lọc tìm kiếm</div>
            <button style="background: #ef4444; color: white; border: none; padding: 8px 30px; font-weight: bold; border-radius: 4px; cursor: pointer;">Áp dụng</button>
        </div>
        
        <div style="background: white; border: 1px solid #e5e7eb; border-radius: 4px; padding: 20px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="font-style: italic; font-size: 18px; color: #1f2937; margin-bottom: 5px;">Nhắn tin cho chăm sóc khách hàng để tìm nick như ý !!!</div>
            <a href="https://zalo.me/0387124869" target="_blank" style="font-style: italic; font-size: 18px; color: #ef4444; text-transform: uppercase; text-decoration: none;">BẤM VÀO ĐÂY</a>
        </div>
        
        <button style="background: #ef4444; color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 4px; font-size: 13px; cursor: pointer;">Xem thêm</button>

    <?php else: ?>
        <!-- Filter Box for Normal Categories -->
        <div class="filter-box">
            <div class="filter-title">Lọc tìm kiếm</div>
            <form action="<?= BASEURL; ?>/category/<?= $category['slug']; ?>" method="GET" class="filter-form">
                <input type="text" name="id" class="filter-input" placeholder="ID" value="<?= htmlspecialchars($filters['id']); ?>">
                
                <select name="sort" class="filter-input">
                    <option value="">Sắp xếp</option>
                    <option value="price_asc" <?= $filters['sort'] == 'price_asc' ? 'selected' : ''; ?>>Giá từ thấp đến cao</option>
                    <option value="price_desc" <?= $filters['sort'] == 'price_desc' ? 'selected' : ''; ?>>Giá từ cao đến thấp</option>
                </select>
                
                <select name="price" class="filter-input">
                    <option value="">Tìm theo giá</option>
                    <option value="under_50" <?= $filters['price'] == 'under_50' ? 'selected' : ''; ?>>Dưới 50.000đ</option>
                    <option value="50_200" <?= $filters['price'] == '50_200' ? 'selected' : ''; ?>>Từ 50K - 200K</option>
                    <option value="200_500" <?= $filters['price'] == '200_500' ? 'selected' : ''; ?>>Từ 200K - 500K</option>
                    <option value="over_500" <?= $filters['price'] == 'over_500' ? 'selected' : ''; ?>>Trên 500.000đ</option>
                </select>
                
                <input type="text" name="info" class="filter-input" placeholder="Thông tin (VD: trắng thông tin)" value="<?= htmlspecialchars($filters['info']); ?>">
                
                <button type="submit" class="filter-btn">Áp dụng</button>
            </form>
        </div>

        <!-- Notice -->
        <div class="notice-text">
            Nick Tự Chọn 100% giống ảnh, khi mua xong khách hàng vui lòng đổi thông tin
        </div>

        <!-- Account Grid -->
    <div class="acc-grid">
        <?php if(empty($data['accounts'])): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px 20px; color: #6b7280;">
                Không tìm thấy tài khoản nào phù hợp với bộ lọc.
            </div>
        <?php else: ?>
            <?php foreach($data['accounts'] as $acc): ?>
                <?php 
                    $accImg = htmlspecialchars($acc['image_url']);
                    $accImgSrc = (strpos($accImg, 'http') === 0) ? $accImg : BASEURL . '/uploads/' . $accImg;
                    $oldPrice = isset($acc['old_price']) ? (int)$acc['old_price'] : 0;
                    $price = (int)$acc['price'];
                    $discount = 0;
                    if($oldPrice > $price && $oldPrice > 0) {
                        $discount = round((($oldPrice - $price) / $oldPrice) * 100);
                    }
                    // Xử lý hiển thị phần "Thông tin: trắng thông tin"
                    $descRaw = mb_strtolower(trim(strip_tags($acc['description'])), 'UTF-8');
                    if (strpos($descRaw, 'sđt') !== false || strpos($descRaw, 'số') !== false) {
                        $info = 'sđt đổi';
                    } else {
                        // Mặc định ép thành "trắng thông tin" theo đúng chuẩn form Nick Tự Chọn
                        $info = 'trắng thông tin';
                    }
                ?>
                <div class="acc-card">
                    <div class="acc-img-wrapper">
                        <img src="<?= $accImgSrc; ?>" alt="Acc <?= $acc['id'] ?>">
                        <div class="acc-id-badge"><?= $acc['id'] ?></div>
                    </div>
                    
                    <div class="acc-body">
                        <div class="acc-price-row">
                            <div class="acc-price-left">
                                <?php if($oldPrice > $price): ?>
                                    <div class="acc-old-price-wrap">
                                        <span class="acc-old-price"><?= number_format($oldPrice, 0, ',', '.'); ?>đ</span>
                                        <span class="acc-discount">-<?= $discount ?>%</span>
                                    </div>
                                <?php endif; ?>
                                <span class="acc-new-price"><?= number_format($price, 0, ',', '.'); ?>đ</span>
                            </div>
                            <?php if($acc['status'] == 'available'): ?>
                                <a href="<?= BASEURL; ?>/account/detail/<?= $acc['id']; ?>" class="acc-buy-btn">Xem ngay</a>
                            <?php else: ?>
                                <button class="acc-buy-btn" style="background:#9ca3af; cursor:not-allowed;" disabled>Đã bán</button>
                            <?php endif; ?>
                        </div>
                        
                        <div class="acc-info">
                            ▶ Thông tin: <b><?= $info ?></b>
                        </div>
                        
                        <a href="<?= BASEURL; ?>/account/detail/<?= $acc['id']; ?>" class="acc-detail-link">Xem chi tiết</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
