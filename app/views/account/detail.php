<div class="account-detail-section">
    <div class="detail-container" style="background:#fff; padding:20px; border-radius:8px; display:flex; gap:30px; margin-top:20px;">
        <div class="detail-img" style="flex:1;">
            <?php 
                $accImg = htmlspecialchars($data['account']['image_url']);
                $accImgSrc = (strpos($accImg, 'http') === 0) ? $accImg : BASEURL . '/uploads/' . $accImg;
            ?>
            <img src="<?= $accImgSrc; ?>" style="width:100%; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        </div>
        <div class="detail-info" style="flex:1;">
            <h2 style="margin-bottom:10px; font-size:24px;"><?= htmlspecialchars($data['account']['title']); ?></h2>
            <p style="color:#666; margin-bottom:15px;">Danh mục: <b style="color:#333;"><?= htmlspecialchars($data['account']['category_name']); ?></b> | Mã số: <b style="color:#e53935;">#<?= $data['account']['id']; ?></b></p>
            
            <div class="detail-price" style="margin-bottom:20px; background:#f9f9f9; padding:15px; border-radius:8px; border-left:4px solid #f44336;">
                <?php if($data['account']['old_price'] > 0): ?>
                    <span style="text-decoration:line-through; color:#999; font-size:16px; margin-right:10px;">Giá cũ: <?= number_format($data['account']['old_price'], 0, ',', '.'); ?>đ</span><br>
                <?php endif; ?>
                <span style="font-size:16px;">Giá bán: </span><span style="color:#f44336; font-size:28px; font-weight:bold;"><?= number_format($data['account']['price'], 0, ',', '.'); ?>đ</span>
            </div>
            
            <div class="detail-desc" style="margin-bottom:25px; line-height:1.6; background:#fff; border:1px solid #eee; padding:15px; border-radius:4px;">
                <b style="color:#0a192f;">📄 Chi tiết tài khoản:</b><br>
                <div style="margin-top:10px; color:#555;">
                    <?= nl2br(htmlspecialchars($data['account']['description'])); ?>
                </div>
            </div>

            <?php if(isset($_SESSION['success_purchase'])): ?>
                <div class="alert success" style="background:#d4edda; color:#155724; padding:15px; border-radius:4px; margin-bottom:20px; border:1px solid #c3e6cb;">
                    <h4 style="margin-bottom:10px;">🎉 GIAO DỊCH THÀNH CÔNG!</h4>
                    <p style="margin-bottom:5px;">Tài khoản: <b style="background:#fff; padding:2px 8px; border-radius:3px; border:1px solid #ccc;"><?= htmlspecialchars($_SESSION['purchased_username']); ?></b></p>
                    <p style="margin-bottom:5px;">Mật khẩu: <b style="background:#fff; padding:2px 8px; border-radius:3px; border:1px solid #ccc;"><?= htmlspecialchars($_SESSION['purchased_password']); ?></b></p>
                    <p style="font-size:13px; margin-top:10px; color:#666;"><i>(Bạn có thể xem lại thông tin này tại trang cá nhân -> lịch sử mua)</i></p>
                </div>
                <?php 
                    unset($_SESSION['success_purchase']); 
                    unset($_SESSION['purchased_username']); 
                    unset($_SESSION['purchased_password']); 
                ?>
            <?php elseif(isset($_SESSION['error_purchase'])): ?>
                <div class="alert error" style="background:#f8d7da; color:#721c24; padding:15px; border-radius:4px; margin-bottom:20px; border:1px solid #f5c6cb;">
                    <b>Lỗi:</b> <?= $_SESSION['error_purchase']; ?>
                </div>
                <?php unset($_SESSION['error_purchase']); ?>
            <?php endif; ?>

            <?php if($data['account']['status'] == 'available'): ?>
                <div style="display: flex; gap: 10px;">
                    <form id="buyForm" action="<?= BASEURL; ?>/account/buy/<?= $data['account']['id']; ?>" method="POST" style="flex: 1;">
                        <button type="button" onclick="openConfirmModal()" class="btn btn-red" style="font-size:16px; font-weight:bold; padding:15px; width:100%; border-radius:8px; text-transform:uppercase; box-shadow:0 4px 6px rgba(244,67,54,0.3);"><i class="fa-solid fa-bolt"></i> Mua Ngay</button>
                    </form>
                    <button type="button" onclick="addToCart(<?= $data['account']['id']; ?>, '')" class="btn" style="background: #2563eb; color: white; font-weight:bold; font-size:16px; padding:15px; width:100%; border-radius:8px; text-transform:uppercase; flex: 1; border: none; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'"><i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
                </div>
            <?php else: ?>
                <button class="btn" style="background:#999; color:#fff; font-size:18px; padding:15px 30px; width:100%; border-radius:8px; cursor:not-allowed;" disabled>❌ TÀI KHOẢN ĐÃ ĐƯỢC BÁN</button>
            <?php endif; ?>
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
</script>

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
            Bạn có chắc chắn muốn thanh toán <b style="color: #ef4444;"><?= number_format($data['account']['price'], 0, ',', '.'); ?>đ</b> để mua tài khoản <b>#<?= $data['account']['id']; ?></b>?
        </div>
        <div class="custom-modal-actions">
            <button class="btn-cancel" onclick="closeConfirmModal()">Hủy bỏ</button>
            <button class="btn-confirm" onclick="document.getElementById('buyForm').submit()">Đồng ý mua</button>
        </div>
    </div>
</div>

<script>
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
</script>
