<style>
/* Modern, beautiful styles for the Blind Bag Detail/Confirmation Page */
.blind-bag-detail-section {
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

/* Detail Box */
.detail-box {
    background: #fff;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    border: 1px solid #eaeaea;
    display: flex;
    gap: 40px;
    max-width: 900px;
    margin: 0 auto;
    align-items: center;
}
@media (max-width: 768px) {
    .detail-box {
        flex-direction: column;
        padding: 25px;
        gap: 25px;
    }
}

.detail-visual {
    flex: 1;
    position: relative;
    max-width: 350px;
    width: 100%;
}
.detail-image-wrapper {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    background: #f7f7f7;
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}
.detail-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Code Badge on Confirmation */
.confirm-code-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%);
    color: #fff;
    font-weight: 900;
    font-size: 16px;
    padding: 8px 16px;
    border-radius: 25px;
    box-shadow: 0 4px 10px rgba(255, 87, 34, 0.3);
    z-index: 2;
}

.detail-info {
    flex: 1.2;
    display: flex;
    flex-direction: column;
}
.detail-info h2 {
    font-size: 26px;
    font-weight: 800;
    color: #333;
    margin-bottom: 8px;
    line-height: 1.2;
}
.detail-category {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}
.detail-category b {
    color: #2a5298;
}

.detail-price-card {
    background: #fdfdfd;
    border: 1px solid #eaeaea;
    border-left: 4px solid #f44336;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 25px;
}
.price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.price-label {
    font-size: 14px;
    color: #666;
    font-weight: 500;
}
.price-value {
    font-size: 28px;
    font-weight: 800;
    color: #e53935;
}
.old-price-value {
    font-size: 16px;
    color: #999;
    text-decoration: line-through;
    margin-right: 10px;
}

/* Form Submit and Back Button */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.btn-buy-now {
    background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    padding: 16px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-transform: uppercase;
    transition: all 0.2s;
    box-shadow: 0 6px 20px rgba(244, 67, 54, 0.25);
    text-align: center;
    width: 100%;
}
.btn-buy-now:hover {
    background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
    box-shadow: 0 8px 24px rgba(244, 67, 54, 0.35);
    transform: translateY(-1px);
}
.btn-back-list {
    background: #fff;
    color: #666;
    font-size: 14px;
    font-weight: bold;
    padding: 12px 20px;
    border: 1.5px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
    text-transform: uppercase;
    transition: all 0.2s;
    text-align: center;
    text-decoration: none;
    display: block;
}
.btn-back-list:hover {
    background: #f7f7f7;
    color: #333;
    border-color: #999;
}

/* Success Card */
.success-card {
    background: #fff;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    border: 2px solid #2ecc71;
    max-width: 650px;
    margin: 30px auto;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.success-icon {
    font-size: 64px;
    color: #2ecc71;
    margin-bottom: 15px;
    animation: scaleUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.success-card h3 {
    font-size: 24px;
    font-weight: 800;
    color: #2ecc71;
    margin-bottom: 10px;
    text-transform: uppercase;
}
.success-msg {
    color: #666;
    margin-bottom: 25px;
    font-size: 15px;
}

.account-credentials {
    background: #f9f9f9;
    border: 1px solid #eaeaea;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    text-align: left;
}
.cred-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    border-bottom: 1px solid #f1f1f1;
    padding-bottom: 10px;
}
.cred-row:last-child {
    margin-bottom: 0;
    border-bottom: none;
    padding-bottom: 0;
}
.cred-label {
    font-size: 14px;
    color: #555;
    font-weight: bold;
}
.cred-value-container {
    display: flex;
    align-items: center;
    gap: 8px;
}
.cred-value {
    background: #fff;
    border: 1.5px solid #ddd;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 15px;
    font-family: monospace;
    font-weight: bold;
    color: #333;
    min-width: 180px;
    user-select: all;
}
.btn-copy {
    background: #2a5298;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 6px 10px;
    font-size: 12px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.2s;
}
.btn-copy:hover {
    background: #1e3c72;
}

/* Error alert styling */
.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1.5px solid #f5c6cb;
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 25px;
    font-size: 15px;
    font-weight: 500;
}

@keyframes scaleUp {
    0% { transform: scale(0.5); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>

<?php 
    $isBlindBag = $data['code_detail']['is_blind_bag'];
    $priceVal = $data['code_detail']['price'];
    $oldPriceVal = $data['code_detail']['old_price'];
?>
<div class="blind-bag-detail-section">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="<?= BASEURL; ?>">Trang chủ</a> / 
        <a href="<?= BASEURL; ?>/account/detail/<?= $data['account']['id']; ?>"><?= $isBlindBag ? 'Danh mục túi mù' : 'Danh sách tài khoản'; ?></a> / 
        <span><?= $isBlindBag ? 'Túi mù #' : 'Tài khoản #'; ?><?= htmlspecialchars($data['code']); ?></span>
    </div>

    <!-- Alert check error purchase -->
    <?php if(isset($_SESSION['error_purchase'])): ?>
        <div class="alert-error">
            ⚠️ <b>Lỗi thanh toán:</b> <?= $_SESSION['error_purchase']; ?>
        </div>
        <?php unset($_SESSION['error_purchase']); ?>
    <?php endif; ?>

    <!-- Check success purchase display -->
    <?php if(isset($_SESSION['success_purchase'])): ?>
        <div class="success-card">
            <div class="success-icon">🎉</div>
            <h3><?= $isBlindBag ? 'Khui Túi Thành Công!' : 'Mua Tài Khoản Thành Công!'; ?></h3>
            <p class="success-msg"><?= $isBlindBag ? 'Mã túi mù #' . htmlspecialchars($data['code']) . ' đã được xé.' : 'Tài khoản #' . htmlspecialchars($data['code']) . ' đã thuộc về bạn.'; ?> Thông tin tài khoản của bạn dưới đây:</p>
            
            <div class="account-credentials">
                <div class="cred-row">
                    <span class="cred-label">Tên đăng nhập:</span>
                    <div class="cred-value-container">
                        <span class="cred-value" id="usernameVal"><?= htmlspecialchars($_SESSION['purchased_username']); ?></span>
                        <button class="btn-copy" onclick="copyText('usernameVal')">Copy</button>
                    </div>
                </div>
                <div class="cred-row">
                    <span class="cred-label">Mật khẩu:</span>
                    <div class="cred-value-container">
                        <span class="cred-value" id="passwordVal"><?= htmlspecialchars($_SESSION['purchased_password']); ?></span>
                        <button class="btn-copy" onclick="copyText('passwordVal')">Copy</button>
                    </div>
                </div>
            </div>
            
            <div class="action-buttons" style="max-width: 300px; margin: 0 auto;">
                <a href="<?= BASEURL; ?>/account/detail/<?= $data['account']['id']; ?>" class="btn-back-list"><?= $isBlindBag ? 'Tiếp Tục Mua Túi Mù' : 'Tiếp Tục Mua Hàng'; ?></a>
                <a href="<?= BASEURL; ?>/profile" class="btn-back-list" style="border-color:#2a5298; color:#2a5298;">Lịch Sử Mua Hàng</a>
            </div>
        </div>
        
        <?php 
            unset($_SESSION['success_purchase']); 
            unset($_SESSION['purchased_username']); 
            unset($_SESSION['purchased_password']); 
        ?>
        
    <?php else: ?>
        <!-- Default confirm layout -->
        <div class="detail-box" style="<?= $isBlindBag ? '' : 'border-color: #007bff;'; ?>">
            <div class="detail-visual">
                <div class="confirm-code-badge" style="<?= $isBlindBag ? '' : 'background: #ff4d4f; box-shadow: 0 4px 10px rgba(255, 77, 79, 0.3);'; ?>"><?= $isBlindBag ? '#' : ''; ?><?= htmlspecialchars($data['code']); ?></div>
                <div class="detail-image-wrapper">
                    <?php 
                        $accImg = htmlspecialchars($data['code_detail']['image_url'] ?? $data['account']['image_url']);
                        $accImgSrc = (strpos($accImg, 'http') === 0) ? $accImg : BASEURL . '/uploads/' . $accImg;
                    ?>
                    <img src="<?= $accImgSrc; ?>" alt="Account Image">
                </div>
            </div>
            
            <div class="detail-info">
                <h2><?= $isBlindBag ? 'Xác nhận khui Túi mù #' . htmlspecialchars($data['code']) : 'Xác nhận mua Tài khoản #' . htmlspecialchars($data['code']); ?></h2>
                <div class="detail-category">Danh mục: <b><?= htmlspecialchars($data['account']['category_name']); ?></b></div>
                
                <div class="detail-price-card" style="<?= $isBlindBag ? '' : 'border-left-color: #007bff;'; ?>">
                    <div class="price-row">
                        <span class="price-label"><?= $isBlindBag ? 'Giá xé túi:' : 'Giá bán:'; ?></span>
                        <div>
                            <?php if($oldPriceVal > 0): ?>
                                <span class="old-price-value"><?= number_format($oldPriceVal, 0, ',', '.'); ?>đ</span>
                            <?php endif; ?>
                            <span class="price-value" style="<?= $isBlindBag ? '' : 'color: #007bff;'; ?>"><?= number_format($priceVal, 0, ',', '.'); ?>đ</span>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <div style="display: flex; gap: 10px;">
                        <form id="buyForm" action="<?= BASEURL; ?>/account/buy/<?= $data['account']['id']; ?>?code=<?= urlencode($data['code']); ?>" method="POST" style="flex: 1;">
                            <button type="button" onclick="openConfirmModal()" class="btn-buy-now" style="font-size:16px; padding:15px; <?= $isBlindBag ? '' : 'background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); box-shadow: 0 6px 20px rgba(0, 123, 255, 0.25);'; ?>"><i class="fa-solid fa-bolt"></i> <?= $isBlindBag ? 'Thanh Toán Mua' : 'MUA NGAY'; ?></button>
                        </form>
                        <button type="button" onclick="addToCart(<?= $data['account']['id']; ?>, '<?= htmlspecialchars($data['code']); ?>')" class="btn" style="background: #2563eb; color: white; font-weight:bold; font-size:16px; padding:15px; border-radius:8px; text-transform:uppercase; flex: 1; border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 6px 20px rgba(37, 99, 235, 0.25);" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'"><i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
                    </div>
                    
                    <a href="<?= BASEURL; ?>/account/detail/<?= $data['account']['id']; ?>" class="btn-back-list">Quay Lại Chọn Tài Khoản Khác</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
.custom-modal-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    display: none; align-items: center; justify-content: center;
    z-index: 9999;
    backdrop-filter: blur(3px);
}
.custom-modal {
    background: #fff; width: 90%; max-width: 400px;
    border-radius: 12px; padding: 25px;
    text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transform: translateY(-20px); opacity: 0;
    transition: all 0.3s ease;
}
.custom-modal.show {
    transform: translateY(0); opacity: 1;
}
.custom-modal-icon {
    font-size: 40px; color: #f59e0b; margin-bottom: 15px;
}
.custom-modal-title {
    font-size: 20px; font-weight: bold; color: #1f2937; margin-bottom: 10px;
}
.custom-modal-desc {
    font-size: 15px; color: #4b5563; margin-bottom: 25px; line-height: 1.5;
}
.custom-modal-actions {
    display: flex; gap: 15px; justify-content: center;
}
.btn-cancel {
    padding: 10px 20px; border-radius: 8px; border: 1px solid #d1d5db;
    background: #fff; color: #374151; font-weight: bold; cursor: pointer;
    flex: 1; transition: 0.2s;
}
.btn-cancel:hover { background: #f3f4f6; }
.btn-confirm {
    padding: 10px 20px; border-radius: 8px; border: none;
    background: #ef4444; color: #fff; font-weight: bold; cursor: pointer;
    flex: 1; transition: 0.2s;
}
.btn-confirm:hover { background: #dc2626; }
</style>

<div class="custom-modal-overlay" id="confirmModal">
    <div class="custom-modal" id="confirmModalContent">
        <div class="custom-modal-icon">🛒</div>
        <div class="custom-modal-title">Xác nhận thanh toán</div>
        <div class="custom-modal-desc">
            Bạn có chắc chắn muốn thanh toán <b style="color: #ef4444;"><?= number_format($priceVal, 0, ',', '.'); ?>đ</b> để <?= $isBlindBag ? 'xé túi mù May Mắn' : 'mua tài khoản'; ?> <b>#<?= htmlspecialchars($data['code']); ?></b>?
        </div>
        <div class="custom-modal-actions">
            <button class="btn-cancel" type="button" onclick="closeConfirmModal()">Hủy bỏ</button>
            <button class="btn-confirm" type="button" onclick="document.getElementById('buyForm').submit()">Đồng ý</button>
        </div>
    </div>
</div>

<script>
function addToCart(accountId, code) {
    const formData = new FormData();
    formData.append('account_id', accountId);
    formData.append('code', code);
    
    fetch('<?= BASEURL; ?>/cart/add', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.redirect) {
            window.location.href = data.redirect;
            return;
        }
        if(data.success) {
            showToast(data.message + '! Hiện có ' + data.cart_count + ' sản phẩm trong giỏ.', 'success');
        } else {
            showToast('Lỗi: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Có lỗi xảy ra khi thêm vào giỏ hàng', 'error');
    });
}

function openConfirmModal() {
    const overlay = document.getElementById('confirmModal');
    const content = document.getElementById('confirmModalContent');
    overlay.style.display = 'flex';
    void content.offsetWidth;
    content.classList.add('show');
}
function closeConfirmModal() {
    const overlay = document.getElementById('confirmModal');
    const content = document.getElementById('confirmModalContent');
    content.classList.remove('show');
    setTimeout(() => {
        overlay.style.display = 'none';
    }, 300);
}

function copyText(elementId) {
    const textElement = document.getElementById(elementId);
    const textToCopy = textElement.textContent;
    
    navigator.clipboard.writeText(textToCopy).then(() => {
        alert("Đã sao chép: " + textToCopy);
    }).catch(err => {
        console.error("Không thể sao chép: ", err);
    });
}
</script>
