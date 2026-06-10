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
                <a href="<?= BASEURL; ?>/profile" style="display: block; padding: 10px 20px; background: #dc2626; color: #fff; text-decoration: none; font-weight: bold; margin: 5px 10px; border-radius: 4px;">› Thông tin tài khoản</a>
                
                <div style="padding: 15px 20px 5px; font-weight: bold; color: #dc2626; font-size: 13px; text-transform: uppercase;">Lịch sử</div>
                <a href="<?= BASEURL; ?>/profile/deposit_history" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Lịch sử nạp tiền</a>
                <a href="<?= BASEURL; ?>/profile/minigame_history" style="display: block; padding: 10px 20px; color: #4b5563; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#4b5563'">› Minigame đã chơi</a>
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
            <h2 style="margin-top: 0; margin-bottom: 20px; color: #1f2937; font-size: 24px; font-weight: 400;">Thông tin tài khoản</h2>
            
            <div style="background: #fff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; gap: 40px;">
                
                <!-- Cột trái: Thông tin cá nhân & Đổi Email -->
                <div style="flex: 1;">
                    <h3 style="font-size: 16px; color: #4b5563; margin-top: 0; margin-bottom: 25px; display: flex; align-items: center; gap: 8px;"><i class="fa-regular fa-user"></i> Thông tin cá nhân</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 40px; font-size: 14px;">
                        <div style="display: flex;">
                            <div style="width: 140px; color: #6b7280;">ID</div>
                            <div style="color: #1f2937;"><?= $data['user']['id']; ?></div>
                        </div>
                        <div style="display: flex;">
                            <div style="width: 140px; color: #6b7280;">Tên tài khoản</div>
                            <div style="color: #ef4444;"><?= htmlspecialchars($data['user']['username']); ?></div>
                        </div>
                        <div style="display: flex;">
                            <div style="width: 140px; color: #6b7280;">Email</div>
                            <div style="color: #ef4444;"><?= htmlspecialchars($data['user']['email']); ?></div>
                        </div>
                        <div style="display: flex;">
                            <div style="width: 140px; color: #6b7280;">Ví chính</div>
                            <div style="color: #ef4444; font-weight: bold;"><?= number_format($data['user']['balance'], 0, ',', '.'); ?> đ</div>
                        </div>
                        <div style="display: flex;">
                            <div style="width: 140px; color: #6b7280;">Đã nạp</div>
                            <div style="color: #ef4444; font-weight: bold;"><?= number_format($data['total_deposit'] ?? 0, 0, ',', '.'); ?> đ</div>
                        </div>
                        <div style="display: flex;">
                            <div style="width: 140px; color: #6b7280;">Ngày tham gia</div>
                            <div style="color: #1f2937;"><?= isset($data['user']['created_at']) ? date('Y/m/d H:i:s', strtotime($data['user']['created_at'])) : 'Không rõ'; ?></div>
                        </div>
                    </div>
                    
                    <h3 style="font-size: 16px; color: #4b5563; margin-top: 0; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;"><i class="fa-regular fa-envelope"></i> Địa chỉ email mới</h3>
                    <div style="display: flex; gap: 10px;">
                        <input type="email" style="flex: 1; padding: 10px 15px; border: 1px solid #d1d5db; border-radius: 4px; outline: none; transition: 0.2s;" onfocus="this.style.borderColor='#ef4444'">
                        <button style="background: #ef4444; color: #fff; border: none; padding: 10px 20px; font-weight: bold; border-radius: 4px; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">Cập nhật</button>
                    </div>
                </div>
                
                <!-- Đường kẻ phân cách (trên desktop) -->
                <div style="width: 1px; background: #f3f4f6;"></div>
                
                <!-- Cột phải: Đổi mật khẩu -->
                <div style="flex: 1;">
                    <h3 style="font-size: 16px; color: #4b5563; margin-top: 0; margin-bottom: 25px; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-lock"></i> Đổi mật khẩu</h3>
                    
                    <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                        <div>
                            <label style="display: block; font-size: 14px; color: #1f2937; margin-bottom: 8px;">Mật khẩu hiện tại</label>
                            <div style="position: relative;">
                                <input type="password" style="width: 100%; padding: 10px 40px 10px 15px; border: 1px solid #d1d5db; border-radius: 4px; outline: none; transition: 0.2s;" onfocus="this.style.borderColor='#ef4444'">
                                <i class="fa-regular fa-eye-slash" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; cursor: pointer;"></i>
                            </div>
                        </div>
                        
                        <div>
                            <label style="display: block; font-size: 14px; color: #1f2937; margin-bottom: 8px;">Mật khẩu mới</label>
                            <div style="position: relative;">
                                <input type="password" style="width: 100%; padding: 10px 40px 10px 15px; border: 1px solid #d1d5db; border-radius: 4px; outline: none; transition: 0.2s;" onfocus="this.style.borderColor='#ef4444'">
                                <i class="fa-regular fa-eye-slash" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; cursor: pointer;"></i>
                            </div>
                        </div>
                        
                        <div>
                            <label style="display: block; font-size: 14px; color: #1f2937; margin-bottom: 8px;">Nhập lại mật khẩu mới</label>
                            <div style="position: relative;">
                                <input type="password" style="width: 100%; padding: 10px 40px 10px 15px; border: 1px solid #d1d5db; border-radius: 4px; outline: none; transition: 0.2s;" onfocus="this.style.borderColor='#ef4444'">
                                <i class="fa-regular fa-eye-slash" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; cursor: pointer;"></i>
                            </div>
                        </div>
                        
                        <button type="button" onclick="showToast('Chức năng đang được cập nhật', 'error')" style="width: 100%; background: #ef4444; color: #fff; border: none; padding: 12px; font-weight: bold; border-radius: 4px; cursor: pointer; transition: 0.2s; margin-top: 10px;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">Cập nhật</button>
                    </form>
                </div>
            </div>
            
            <!-- History section added below as requested previously -->
            <div style="background: #fff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-top: 30px;">
                <h3 style="margin-top: 0; margin-bottom: 20px; color: #1f2937; font-size: 18px; border-bottom: 1px solid #e5e7eb; padding-bottom: 15px;">Lịch sử tài khoản đã mua (Nick)</h3>
                
                <?php if(empty($data['purchased'])): ?>
                    <div style="text-align:center; padding:30px 0; color:#999;">
                        <div style="font-size:30px; margin-bottom:10px;">🛒</div>
                        <p style="font-size: 14px;">Bạn chưa mua tài khoản nào.</p>
                        <a href="<?= BASEURL; ?>" style="display:inline-block; margin-top:10px; background:#ef4444; color:#fff; padding:6px 15px; text-decoration:none; border-radius:4px; font-weight:bold; font-size: 14px;">Mua Ngay</a>
                    </div>
                <?php else: ?>
                    <table style="width:100%; border-collapse:collapse; font-size: 14px;">
                        <thead>
                            <tr style="background:#f8fafc; text-align:left; color:#64748b; font-size: 13px; text-transform: uppercase;">
                                <th style="padding:12px; border-bottom:1px solid #e2e8f0;">Mã Số</th>
                                <th style="padding:12px; border-bottom:1px solid #e2e8f0;">Thông tin Game</th>
                                <th style="padding:12px; border-bottom:1px solid #e2e8f0;">Số Tiền</th>
                                <th style="padding:12px; border-bottom:1px solid #e2e8f0;">Thông Tin Đăng Nhập</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['purchased'] as $acc): ?>
                                <tr style="transition:background 0.2s;">
                                    <td style="padding:12px; border-bottom:1px solid #e2e8f0; font-weight:bold; color: #1f2937;">#<?= $acc['id']; ?></td>
                                    <td style="padding:12px; border-bottom:1px solid #e2e8f0;">
                                        <a href="<?= BASEURL; ?>/account/detail/<?= $acc['id']; ?>" style="color:#2563eb; text-decoration:none; font-weight:bold;"><?= htmlspecialchars($acc['title']); ?></a>
                                        <div style="font-size:12px; color:#64748b; margin-top:4px;">Thuộc: <?= htmlspecialchars($acc['category_name']); ?></div>
                                    </td>
                                    <td style="padding:12px; border-bottom:1px solid #e2e8f0; color:#ef4444; font-weight:bold;"><?= number_format($acc['price'], 0, ',', '.'); ?>đ</td>
                                    <td style="padding:12px; border-bottom:1px solid #e2e8f0; background:#fffbeb;">
                                        <div style="margin-bottom:5px; font-size:13px;">TK: <b style="background:#fff; padding:2px 5px; border:1px solid #cbd5e1; border-radius:3px; color:#b91c1c;"><?= htmlspecialchars($acc['game_username']); ?></b></div>
                                        <div style="font-size:13px;">MK: <b style="background:#fff; padding:2px 5px; border:1px solid #cbd5e1; border-radius:3px; color:#b91c1c;"><?= htmlspecialchars($acc['game_password']); ?></b></div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
            
            <form action="<?= BASEURL; ?>/profile/addTestMoney" method="POST" style="margin-top: 30px;">
                <button type="submit" class="btn" style="background:#10b981; color:#fff; padding:12px 20px; font-weight:bold; border-radius:4px; font-size:14px; border:none; cursor:pointer; box-shadow:0 2px 4px rgba(16,185,129,0.3);">🎁 Nhận 500.000đ Test (Dành cho Admin/Test)</button>
            </form>
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
    .container > div > div:last-child > div:first-child {
        flex-direction: column;
        gap: 20px !important;
    }
    .container > div > div:last-child > div:first-child > div[style*="width: 1px"] {
        width: 100% !important;
        height: 1px !important;
        margin: 15px 0 !important;
    }
}
</style>
