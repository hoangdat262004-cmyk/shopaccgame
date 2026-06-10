<style>
/* Modern, beautiful styles for the Blind Bag Selection Page */
.blind-bag-section {
    margin-top: 20px;
    margin-bottom: 50px;
    font-family: 'Roboto', sans-serif;
}

/* Breadcrumb */
.breadcrumb {
    font-size: 14px;
    color: #888;
    margin-bottom: 25px;
}
.breadcrumb a {
    color: #4a90e2;
    text-decoration: none;
    transition: color 0.2s;
}
.breadcrumb a:hover {
    color: #357abd;
}
.breadcrumb span {
    color: #333;
    font-weight: 500;
}

/* Info Box */
.info-banner {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    border-radius: 12px;
    padding: 25px;
    color: #fff;
    margin-bottom: 30px;
    box-shadow: 0 8px 24px rgba(30, 60, 114, 0.15);
    position: relative;
    overflow: hidden;
}
.info-banner::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    pointer-events: none;
}
.info-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.info-description {
    font-size: 15px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
}

/* Ratios Box */
.ratio-details {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 15px;
    margin-top: 15px;
    display: none;
    border: 1px solid rgba(255, 255, 255, 0.15);
}
.ratio-details.show {
    display: block;
    animation: fadeIn 0.4s ease-out;
}
.ratio-list {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 10px;
}
.ratio-item {
    background: rgba(0, 0, 0, 0.25);
    padding: 10px 20px;
    border-radius: 6px;
    text-align: center;
    min-width: 120px;
    border-left: 3px solid #ffeb3b;
}
.ratio-percentage {
    font-size: 20px;
    font-weight: 700;
    color: #ffeb3b;
}
.ratio-label {
    font-size: 12px;
    color: #e0e0e0;
    margin-top: 4px;
}
.toggle-ratio-btn {
    background: #ffeb3b;
    color: #1e3c72;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 15px;
    transition: all 0.2s;
    box-shadow: 0 4px 10px rgba(255, 235, 59, 0.3);
}
.toggle-ratio-btn:hover {
    background: #fdd835;
    transform: translateY(-1px);
}

/* Filter Section */
.filter-wrapper {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: 1px solid #eaeaea;
}
.filter-form {
    display: flex;
    gap: 15px;
    align-items: flex-end;
    flex-wrap: wrap;
}
.filter-group {
    flex: 1;
    min-width: 200px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.filter-group label {
    font-size: 13px;
    font-weight: bold;
    color: #555;
    text-transform: uppercase;
}
.filter-group input, .filter-group select {
    padding: 10px 14px;
    border: 1.5px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    color: #333;
    outline: none;
    transition: border-color 0.2s;
}
.filter-group input:focus, .filter-group select:focus {
    border-color: #2a5298;
}
.btn-filter {
    background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
    color: #fff;
    font-weight: bold;
    font-size: 14px;
    padding: 11px 24px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-transform: uppercase;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(244, 67, 54, 0.2);
}
.btn-filter:hover {
    background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
    box-shadow: 0 6px 16px rgba(244, 67, 54, 0.3);
}

/* Blind Bag Grid */
.blind-bag-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
@media (max-width: 1024px) {
    .blind-bag-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
@media (max-width: 768px) {
    .blind-bag-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Blind Bag Card */
.bag-card {
    background: #fff;
    border: 1px solid #eaeaea;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
}
.bag-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.08);
    border-color: #2a5298;
}

/* Self-Select Card (Matching user screenshot) */
.self-select-card {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    background: #fff;
    overflow: hidden;
    position: relative;
    box-shadow: 0 2px 5px rgba(0,0,0,0.02);
}
.self-select-card:hover {
    border-color: #ff4d4f !important;
}
.self-select-code-badge {
    position: absolute;
    top: 0;
    right: 0;
    background: #ff4d4f;
    color: #fff;
    font-weight: 800;
    font-size: 12px;
    padding: 4px 10px;
    border-bottom-left-radius: 8px;
    z-index: 10;
    box-shadow: 0 2px 4px rgba(255, 77, 79, 0.2);
}
.btn-xem-ngay {
    background-color: #ff4d4f;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
    text-transform: none;
    transition: background 0.2s, transform 0.1s;
}
.btn-xem-ngay:hover {
    background-color: #e03e3f;
    transform: scale(1.03);
}
.bag-img-container {
    position: relative;
    width: 100%;
    padding-top: 75%; /* 4:3 Ratio */
    background: #f7f7f7;
    overflow: hidden;
}
.bag-img-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.bag-card:hover .bag-img-container img {
    transform: scale(1.08);
}

/* Gradient overlay on hover */
.bag-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0) 50%, rgba(0,0,0,0.4) 100%);
    opacity: 0;
    transition: opacity 0.3s;
}
.bag-card:hover .bag-overlay {
    opacity: 1;
}

/* Code Badge */
.code-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%);
    color: #fff;
    font-weight: 800;
    font-size: 13px;
    padding: 6px 12px;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(255, 87, 34, 0.25);
    z-index: 2;
}

/* In Stock status */
.status-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(76, 175, 80, 0.9);
    color: #fff;
    font-weight: bold;
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 4px;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 4px;
}
.status-dot {
    width: 6px;
    height: 6px;
    background-color: #fff;
    border-radius: 50%;
    display: inline-block;
    animation: blinker 1.5s linear infinite;
}

.bag-body {
    padding: 16px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.bag-title {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 6px;
    text-transform: uppercase;
}
.bag-subtitle {
    font-size: 13px;
    color: #777;
    margin-bottom: 15px;
}
.bag-subtitle b {
    color: #e53935;
}

.bag-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px dashed #eee;
    padding-top: 14px;
    margin-top: auto;
}
.bag-price {
    display: flex;
    flex-direction: column;
}
.bag-old-price {
    font-size: 12px;
    color: #aaa;
    text-decoration: line-through;
}
.bag-new-price {
    font-size: 16px;
    font-weight: 800;
    color: #e53935;
}
.btn-select {
    background: #2a5298;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    font-weight: bold;
    padding: 8px 14px;
    cursor: pointer;
    text-transform: uppercase;
    transition: background 0.2s, transform 0.1s;
}
.btn-select:hover {
    background: #1e3c72;
    transform: scale(1.03);
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-top: 40px;
    flex-wrap: wrap;
}
.page-link {
    min-width: 26px;
    height: 38px;
    padding: 0 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid #eaeaea;
    border-radius: 12px; /* Vertical oval pill shape matching screenshot */
    background: #fff;
    color: #1e3c72; /* Blue text */
    font-weight: bold;
    text-decoration: none;
    transition: all 0.2s;
    font-size: 14px;
}
.page-link:hover {
    border-color: #2a5298;
    color: #2a5298;
    background-color: #f7f9fc;
}
.page-link.active {
    background: #2a5298;
    border-color: #2a5298;
    color: #fff;
    box-shadow: 0 4px 10px rgba(42, 82, 152, 0.25);
}
.page-link.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
    color: #aaa;
    border-color: #eee;
}
.page-ellipsis {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 26px;
    height: 38px;
    color: #777;
    font-weight: bold;
    font-size: 14px;
}

@keyframes blinker {
    50% { opacity: 0.3; }
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<?php 
    $isBlindBag = (stripos($data['account']['title'], 'Túi Mù') !== false);
?>
<div class="blind-bag-section">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="<?= BASEURL; ?>">Trang chủ</a> / 
        <span><?= $isBlindBag ? 'Túi Mù Chi Tiết' : 'Danh Sách Tài Khoản'; ?></span>
    </div>

    <!-- Info Banner with Description and Ratio Toggle -->
    <div class="info-banner" style="<?= $isBlindBag ? '' : 'background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); box-shadow: 0 8px 24px rgba(17, 153, 142, 0.15);'; ?>">
        <div class="info-title">
            <span><?= $isBlindBag ? '🎁' : '🎮'; ?></span> <?= htmlspecialchars($data['account']['title']); ?>
        </div>
        <div class="info-description">
            <?= nl2br(htmlspecialchars($data['account']['description'])); ?>
        </div>
        
        <?php if ($isBlindBag): ?>
            <button class="toggle-ratio-btn" onclick="toggleRatios()">Xem tỉ lệ nhận vật phẩm</button>
            
            <div class="ratio-details" id="ratioDetails">
                <div class="ratio-list">
                    <div class="ratio-item">
                        <div class="ratio-percentage">3%</div>
                        <div class="ratio-label">VIP Siêu Phẩm</div>
                    </div>
                    <div class="ratio-item">
                        <div class="ratio-percentage">5%</div>
                        <div class="ratio-label">Acc Rank Cao</div>
                    </div>
                    <div class="ratio-item">
                        <div class="ratio-percentage">92%</div>
                        <div class="ratio-label">Acc Thường Ngẫu Nhiên</div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Filter Form -->
    <div class="filter-wrapper">
        <form action="<?= BASEURL; ?>/account/detail/<?= $data['account']['id']; ?>" method="GET" class="filter-form">
            <div class="filter-group">
                <label for="search_id"><?= $isBlindBag ? 'Mã số túi mù' : 'Mã số tài khoản'; ?></label>
                <input type="text" id="search_id" name="search_id" placeholder="Nhập mã ví dụ: <?= $isBlindBag ? '6095' : '7652'; ?>" value="<?= htmlspecialchars($data['search_id']); ?>">
            </div>
            
            <div class="filter-group">
                <label for="sort_by">Sắp xếp theo mã</label>
                <select id="sort_by" name="sort_by">
                    <option value="newest" <?= $data['sort_by'] == 'newest' ? 'selected' : ''; ?>>Mới nhất</option>
                    <option value="oldest" <?= $data['sort_by'] == 'oldest' ? 'selected' : ''; ?>>Cũ nhất</option>
                </select>
            </div>
            
            <button type="submit" class="btn-filter" style="<?= $isBlindBag ? '' : 'background: linear-gradient(135deg, #007bff 0%, #00bcd4 100%); box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);'; ?>">Áp Dụng</button>
        </form>
    </div>

    <!-- Blind Bag Items Grid -->
    <div class="blind-bag-grid">
        <?php if(empty($data['codes'])): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px 20px; color: #666; font-style: italic;">
                <?= $isBlindBag ? 'Không tìm thấy túi mù phù hợp với bộ lọc của bạn!' : 'Không tìm thấy tài khoản phù hợp với bộ lọc của bạn!'; ?>
            </div>
        <?php else: ?>
            <?php foreach($data['codes'] as $code): 
                $codeDetail = $data['codes_details'][$code];
                $codeImg = !empty($codeDetail['image_url']) ? $codeDetail['image_url'] : $data['account']['image_url'];
                $codeImgSrc = (strpos($codeImg, 'http') === 0) ? $codeImg : BASEURL . '/uploads/' . $codeImg;
            ?>
                <?php if ($isBlindBag): ?>
                    <!-- Original Blind Bag Card -->
                    <div class="bag-card">
                        <span class="code-badge">#<?= $code; ?></span>
                        <span class="status-badge"><span class="status-dot"></span>Chưa khui</span>
                        
                        <div class="bag-img-container">
                            <img src="<?= $codeImgSrc; ?>" alt="Account Image">
                            <div class="bag-overlay"></div>
                        </div>
                        
                        <div class="bag-body">
                            <div class="bag-title">TÚI MÙ MAY MẮN</div>
                            <div class="bag-subtitle">Mã vật phẩm: <b>#<?= $code; ?></b></div>
                            
                            <div class="bag-footer">
                                <div class="bag-price">
                                    <?php if($codeDetail['old_price'] > 0): ?>
                                        <span class="bag-old-price"><?= number_format($codeDetail['old_price'], 0, ',', '.'); ?>đ</span>
                                    <?php endif; ?>
                                    <span class="bag-new-price"><?= number_format($codeDetail['price'], 0, ',', '.'); ?>đ</span>
                                </div>
                                
                                <a href="<?= BASEURL; ?>/account/detail/<?= $data['account']['id']; ?>?code=<?= $code; ?>">
                                    <button class="btn-select">Xé Ngay</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Self-Select Card (Matching user screenshot) -->
                    <div class="bag-card self-select-card">
                        <span class="self-select-code-badge"><?= $code; ?></span>
                        
                        <div class="bag-img-container">
                            <img src="<?= $codeImgSrc; ?>" alt="Account Image">
                            <div class="bag-overlay"></div>
                        </div>
                        
                        <div class="bag-body" style="padding: 12px; display: flex; flex-direction: column; justify-content: space-between; flex-grow: 1;">
                            <div>
                                <!-- Price & Action Row -->
                                <div class="card-action-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <div class="price-container" style="display: flex; flex-direction: column; justify-content: center;">
                                        <?php if($codeDetail['old_price'] > 0): ?>
                                            <?php 
                                                $discount = round((($codeDetail['old_price'] - $codeDetail['price']) / $codeDetail['old_price']) * 100);
                                            ?>
                                            <div style="font-size: 11px; color: #888; text-decoration: line-through; margin-bottom: 2px;">
                                                <?= number_format($codeDetail['old_price'], 0, ',', '.'); ?>đ
                                                <span style="color: #ff4d4f; font-weight: bold; text-decoration: none; display: inline-block; margin-left: 4px;">-<?= $discount; ?>%</span>
                                            </div>
                                        <?php endif; ?>
                                        <div style="font-size: 16px; font-weight: 700; color: #ff4d4f; font-family: 'Roboto', sans-serif;">
                                            <?= number_format($codeDetail['price'], 0, ',', '.'); ?><sup style="font-size: 10px; top: -0.5em; font-weight: bold; color: #ff4d4f;">đ</sup>
                                        </div>
                                    </div>
                                    
                                    <a href="<?= BASEURL; ?>/account/detail/<?= $data['account']['id']; ?>?code=<?= $code; ?>">
                                        <button class="btn-xem-ngay">Xem ngay</button>
                                    </a>
                                </div>
                            </div>
                            
                            <div>
                                <!-- Dashed Separator -->
                                <div style="border-top: 1px dashed #eee; margin: 8px 0 4px 0;"></div>
                                
                                <!-- Center Link "Xem chi tiết" -->
                                <div style="text-align: center;">
                                    <a href="<?= BASEURL; ?>/account/detail/<?= $data['account']['id']; ?>?code=<?= $code; ?>" style="color: #ff4d4f; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block; padding: 2px 0;">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if($data['total_pages'] > 1): ?>
        <div class="pagination">
            <?php 
                // Build query params string to preserve search filters during pagination
                $queryParams = [];
                if (!empty($data['search_id'])) {
                    $queryParams['search_id'] = $data['search_id'];
                }
                if (!empty($data['sort_by'])) {
                    $queryParams['sort_by'] = $data['sort_by'];
                }
            ?>
            
            <!-- Previous page link -->
            <?php 
                $prevParams = $queryParams;
                $prevParams['page'] = $data['page'] - 1;
                $prevUrl = BASEURL . '/account/detail/' . $data['account']['id'] . '?' . http_build_query($prevParams);
            ?>
            <a href="<?= $prevUrl; ?>" class="page-link <?= $data['page'] <= 1 ? 'disabled' : ''; ?>">«</a>
            
            <!-- Truncated Page numbers -->
            <?php 
                $current_page = $data['page'];
                $total_pages = $data['total_pages'];
                $range = 2; // Show 2 pages around current page
                
                $pages_to_show = [];
                $pages_to_show[] = 1; // Always show first page
                
                for ($i = $current_page - $range; $i <= $current_page + $range; $i++) {
                    if ($i > 1 && $i < $total_pages) {
                        $pages_to_show[] = $i;
                    }
                }
                
                if ($total_pages > 1) {
                    $pages_to_show[] = $total_pages; // Always show last page
                }
                
                $pages_to_show = array_unique($pages_to_show);
                sort($pages_to_show);
                
                $last_p = 0;
                foreach ($pages_to_show as $p):
                    if ($last_p > 0 && $p - $last_p > 1) {
                        echo '<span class="page-ellipsis">...</span>';
                    }
                    
                    $pageParams = $queryParams;
                    $pageParams['page'] = $p;
                    $pageUrl = BASEURL . '/account/detail/' . $data['account']['id'] . '?' . http_build_query($pageParams);
            ?>
                    <a href="<?= $pageUrl; ?>" class="page-link <?= $current_page == $p ? 'active' : ''; ?>"><?= $p; ?></a>
            <?php 
                    $last_p = $p;
                endforeach; 
            ?>
            
            <!-- Next page link -->
            <?php 
                $nextParams = $queryParams;
                $nextParams['page'] = $data['page'] + 1;
                $nextUrl = BASEURL . '/account/detail/' . $data['account']['id'] . '?' . http_build_query($nextParams);
            ?>
            <a href="<?= $nextUrl; ?>" class="page-link <?= $data['page'] >= $data['total_pages'] ? 'disabled' : ''; ?>">»</a>
        </div>
    <?php endif; ?>
</div>

<script>
function toggleRatios() {
    const details = document.getElementById('ratioDetails');
    const button = document.querySelector('.toggle-ratio-btn');
    if (details.classList.contains('show')) {
        details.classList.remove('show');
        button.textContent = 'Xem tỉ lệ nhận vật phẩm';
    } else {
        details.classList.add('show');
        button.textContent = 'Ẩn tỉ lệ nhận vật phẩm';
    }
}
</script>
