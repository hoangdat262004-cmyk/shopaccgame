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
                <a href="<?= BASEURL; ?>/profile/deposit_history" style="display: block; padding: 10px 20px; background: #dc2626; color: #fff; text-decoration: none; font-weight: bold; margin: 5px 10px; border-radius: 4px;">› Lịch sử nạp tiền</a>
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
            
            <div style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden;">
                
                <!-- Tabs -->
                <div style="display: flex; border-bottom: 1px solid #e5e7eb; background: #fafafa;">
                    <div id="tab-card" onclick="switchTab('card')" style="padding: 15px 25px; border-bottom: 2px solid #ef4444; color: #ef4444; font-weight: bold; font-size: 14px; text-transform: uppercase; cursor: pointer; background: white; transition: 0.2s;">
                        Thẻ cào đã nạp
                    </div>
                    <div id="tab-atm" onclick="switchTab('atm')" style="padding: 15px 25px; color: #6b7280; font-weight: 600; font-size: 14px; text-transform: uppercase; cursor: pointer; transition: 0.2s; border-bottom: 2px solid transparent;" onmouseover="if(!this.classList.contains('active')) this.style.color='#1f2937'" onmouseout="if(!this.classList.contains('active')) this.style.color='#6b7280'">
                        ATM / Momo đã nạp
                    </div>
                </div>

                <!-- Content: Thẻ cào -->
                <div id="content-card" style="padding: 50px 20px; min-height: 400px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    
                    <?php if(empty($data['transactions'])): ?>
                        <!-- Empty State -->
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" alt="No data" style="width: 120px; opacity: 0.2; margin-bottom: 20px; filter: grayscale(100%);">
                        <div style="color: #6b7280; font-size: 16px;">Không có dữ liệu</div>
                    <?php else: ?>
                        <!-- Data Table -->
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                                    <th style="padding: 12px 15px; font-size: 14px; color: #4b5563;">Mã GD</th>
                                    <th style="padding: 12px 15px; font-size: 14px; color: #4b5563;">Số tiền</th>
                                    <th style="padding: 12px 15px; font-size: 14px; color: #4b5563;">Loại</th>
                                    <th style="padding: 12px 15px; font-size: 14px; color: #4b5563;">Thời gian</th>
                                    <th style="padding: 12px 15px; font-size: 14px; color: #4b5563;">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['transactions'] as $tx): ?>
                                    <tr style="border-bottom: 1px solid #f3f4f6;">
                                        <td style="padding: 15px; font-size: 14px; color: #1f2937;">#<?= $tx['id']; ?></td>
                                        <td style="padding: 15px; font-size: 14px; font-weight: bold; color: #ef4444;">+<?= number_format($tx['amount'], 0, ',', '.'); ?>đ</td>
                                        <td style="padding: 15px; font-size: 14px; color: #4b5563;">Thẻ cào</td>
                                        <td style="padding: 15px; font-size: 14px; color: #6b7280;"><?= date('d/m/Y H:i', strtotime($tx['created_at'])); ?></td>
                                        <td style="padding: 15px; font-size: 14px;">
                                            <?php if($tx['status'] == 'completed'): ?>
                                                <span style="background: #d1fae5; color: #059669; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Thành công</span>
                                            <?php else: ?>
                                                <span style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Đang xử lý</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    
                </div>
                
                <!-- Content: ATM / Momo -->
                <div id="content-atm" style="padding: 50px 20px; min-height: 400px; display: none; flex-direction: column; align-items: center; justify-content: center;">
                    <!-- Empty State for ATM -->
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" alt="No data" style="width: 120px; opacity: 0.2; margin-bottom: 20px; filter: grayscale(100%);">
                    <div style="color: #6b7280; font-size: 16px;">Không có dữ liệu chuyển khoản</div>
                </div>

            </div>
            
        </div>
    </div>
</div>

<script>
function switchTab(tab) {
    const tabCard = document.getElementById('tab-card');
    const tabAtm = document.getElementById('tab-atm');
    const contentCard = document.getElementById('content-card');
    const contentAtm = document.getElementById('content-atm');

    if(tab === 'card') {
        // Style Tab Card active
        tabCard.style.color = '#ef4444';
        tabCard.style.borderBottom = '2px solid #ef4444';
        tabCard.style.background = 'white';
        tabCard.classList.add('active');
        
        // Style Tab ATM inactive
        tabAtm.style.color = '#6b7280';
        tabAtm.style.borderBottom = '2px solid transparent';
        tabAtm.style.background = 'transparent';
        tabAtm.classList.remove('active');
        
        // Show Content Card
        contentCard.style.display = 'flex';
        contentAtm.style.display = 'none';
    } else {
        // Style Tab ATM active
        tabAtm.style.color = '#ef4444';
        tabAtm.style.borderBottom = '2px solid #ef4444';
        tabAtm.style.background = 'white';
        tabAtm.classList.add('active');
        
        // Style Tab Card inactive
        tabCard.style.color = '#6b7280';
        tabCard.style.borderBottom = '2px solid transparent';
        tabCard.style.background = 'transparent';
        tabCard.classList.remove('active');
        
        // Show Content ATM
        contentCard.style.display = 'none';
        contentAtm.style.display = 'flex';
    }
}

// Set initial active state
document.getElementById('tab-card').classList.add('active');
</script>

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
