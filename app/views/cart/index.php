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
                <a href="<?= BASEURL; ?>/profile/minigame_history" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Minigame đã chơi</a>
                <a href="<?= BASEURL; ?>/profile/withdraw_history" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Rút vật phẩm</a>
                <a href="<?= BASEURL; ?>/cart" style="display: block; padding: 10px 20px; background: #dc2626; color: #fff; text-decoration: none; font-weight: bold; margin: 5px 10px; border-radius: 4px;">› Giỏ hàng đã thêm</a>
                <a href="<?= BASEURL; ?>/" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Mua tài khoản (nick)</a>
                
                <div style="padding: 15px 20px 5px; font-weight: bold; color: #dc2626; font-size: 13px; text-transform: uppercase;">Dịch vụ</div>
                <a href="<?= BASEURL; ?>/services/boosting" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Đơn cày thuê</a>
                
                <div style="padding: 15px 20px 5px; font-weight: bold; color: #dc2626; font-size: 13px; text-transform: uppercase;">Khác</div>
                <a href="<?= BASEURL; ?>/auth/logout" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Đăng xuất</a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div style="flex: 1;">
            
            <?php if(isset($_SESSION['checkout_error'])): ?>
                <div style="background: #fee2e2; color: #ef4444; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fca5a5;">
                    <?= $_SESSION['checkout_error']; ?>
                    <?php unset($_SESSION['checkout_error']); ?>
                </div>
            <?php endif; ?>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; color: #1f2937; font-size: 24px; font-weight: 400;">Tài khoản đã thích</h2>
                <?php if(!empty($_SESSION['cart'])): ?>
                <form action="<?= BASEURL; ?>/cart/checkout" method="POST" style="margin: 0;">
                    <button type="submit" style="background: #ef4444; color: white; padding: 8px 20px; border-radius: 4px; font-weight: bold; border: none; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">Thanh toán giỏ hàng</button>
                </form>
                <?php endif; ?>
            </div>
            
            <?php if(empty($_SESSION['cart'])): ?>
                <div style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 50px 20px; min-height: 400px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" alt="No data" style="width: 120px; opacity: 0.2; margin-bottom: 20px; filter: grayscale(100%);">
                    <div style="color: #6b7280; font-size: 16px;">Không có dữ liệu</div>
                </div>
            <?php else: ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                    <?php foreach($_SESSION['cart'] as $index => $item): ?>
                        <div style="background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #f3f4f6;">
                            <!-- Image Section -->
                            <div style="position: relative; width: 100%; padding-top: 56.25%;">
                                <?php 
                                    $img = htmlspecialchars($item['image']);
                                    $imgSrc = (strpos($img, 'http') === 0) ? $img : BASEURL . '/uploads/' . $img;
                                ?>
                                <img src="<?= $imgSrc; ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; top: 10px; right: 10px; background: #ef4444; color: white; padding: 3px 10px; border-radius: 4px; font-size: 13px; font-weight: bold;">
                                    <?= htmlspecialchars($item['account_id']); ?>
                                </div>
                            </div>
                            
                            <!-- Content Section -->
                            <div style="padding: 15px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                    <div style="color: #ef4444; font-size: 18px; font-weight: bold;"><?= number_format($item['price'], 0, ',', '.'); ?><sup>đ</sup></div>
                                    <a href="<?= BASEURL; ?>/account/detail/<?= $item['account_id']; ?>" style="background: #ef4444; color: white; padding: 6px 15px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold;">Xem ngay</a>
                                </div>
                                
                                <div style="border-top: 1px dashed #e5e7eb; padding-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                                    <div style="color: #ef4444;"><i class="fa-solid fa-fire"></i></div>
                                    <a href="<?= BASEURL; ?>/cart/remove/<?= $index; ?>" style="color: #ef4444; text-decoration: none; font-size: 14px;">Xoá thích</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
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
