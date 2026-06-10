<div class="container" style="margin-top: 30px; margin-bottom: 50px;">
    <div style="display: flex; gap: 30px; align-items: flex-start;">
        
        <!-- Sidebar Profile Menu -->
        <div style="width: 260px; flex-shrink: 0;">
            <!-- Avatar & ID Box -->
            <div style="background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; background: #e2e8f0; display: flex; justify-content: center; align-items: center;">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($data['user']['username']); ?>&background=random&color=fff&size=60" alt="Avatar" style="width: 100%; height: 100%;">
                </div>
                <div>
                    <div style="font-weight: bold; color: #1f2937; font-size: 16px; margin-bottom: 5px;"><?= htmlspecialchars($data['user']['username']); ?></div>
                    <div style="font-size: 14px; font-weight: bold; color: #000;">ID: <?= $data['user']['id']; ?></div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div style="background: #fff; border-radius: 8px; padding: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div style="padding: 5px 20px; font-weight: bold; color: #dc2626; font-size: 13px; text-transform: uppercase;">Tài khoản</div>
                <a href="<?= BASEURL; ?>/profile" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Thông tin tài khoản</a>
                
                <div style="padding: 15px 20px 5px; font-weight: bold; color: #dc2626; font-size: 13px; text-transform: uppercase;">Lịch sử</div>
                <a href="<?= BASEURL; ?>/profile/deposit_history" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Lịch sử nạp tiền</a>
                <a href="<?= BASEURL; ?>/profile/minigame_history" style="display: block; padding: 10px 20px; background: #dc2626; color: #fff; text-decoration: none; font-weight: bold; margin: 5px 10px; border-radius: 4px;">› Minigame đã chơi</a>
                <a href="<?= BASEURL; ?>/profile/withdraw_history" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Rút vật phẩm</a>
                <a href="<?= BASEURL; ?>/cart" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Giỏ hàng đã thêm</a>
                <a href="<?= BASEURL; ?>/" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Mua tài khoản (nick)</a>
                
                <div style="padding: 15px 20px 5px; font-weight: bold; color: #dc2626; font-size: 13px; text-transform: uppercase;">Dịch vụ</div>
                <a href="<?= BASEURL; ?>/services/boosting" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Đơn cày thuê</a>
                
                <div style="padding: 15px 20px 5px; font-weight: bold; color: #dc2626; font-size: 13px; text-transform: uppercase;">Khác</div>
                <a href="<?= BASEURL; ?>/auth/logout" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Đăng xuất</a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div style="flex: 1;">
            <h2 style="margin-top: 0; margin-bottom: 20px; color: #1f2937; font-size: 24px; font-weight: 400;">Minigames đã chơi</h2>
            
            <div style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 50px 20px; min-height: 400px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                
                <!-- Empty State -->
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" alt="No data" style="width: 120px; opacity: 0.2; margin-bottom: 20px; filter: grayscale(100%);">
                <div style="color: #6b7280; font-size: 16px;">Không có dữ liệu</div>
                
            </div>
            
        </div>
    </div>
</div>

<style>
@media (max-width: 900px) {
    .container > div {
        flex-direction: column;
    }
    .container > div > div:first-child {
        width: 100% !important;
    }
}
</style>
