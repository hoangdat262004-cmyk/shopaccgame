    </div> <!-- end main-content -->
    
    <!-- Feature Guarantees -->
    <div class="guarantees-section" style="margin-top: 50px; margin-bottom: -20px; position:relative; z-index:10;">
        <div class="container" style="display:flex; gap:15px; flex-wrap: wrap;">
            <div class="guarantee-box">
                <div class="icon">🛍️</div>
                <p>Sản phẩm, dịch vụ đa dạng, cập nhật liên tục.</p>
            </div>
            <div class="guarantee-box">
                <div class="icon">🛡️</div>
                <p>Hàng ngàn khách hàng tin tưởng, ủng hộ.</p>
            </div>
            <div class="guarantee-box">
                <div class="icon">📞</div>
                <p>Trung tâm hỗ trợ nhanh chóng, tận tình 24/7.</p>
            </div>
            <div class="guarantee-box">
                <div class="icon">👍</div>
                <p>Giá rẻ, uy tín, chất lượng nhất thị trường.</p>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="site-footer-new" style="background:#1a1a1a; padding: 60px 0 30px 0; border-top: 5px solid #f44336; color: #fff; text-align:left;">
        <div class="container" style="display: flex; justify-content: space-between; gap: 30px; flex-wrap: wrap;">
            <div class="footer-col" style="flex: 1; min-width:200px;">
                <h3 style="color:#f44336; font-size:24px; margin-bottom:15px; font-weight:900;">SHOP ACC GAME</h3>
                <p style="font-size:13px; margin-bottom:10px;">Shop Bán Nick Game Uy Tín, Giá rẻ</p>
                <p style="color:#f44336; font-weight:bold; font-size:14px; margin-bottom:15px;">HỆ THỐNG BÁN ACC TỰ ĐỘNG ĐẢM BẢO VÀ CHẤT LƯỢNG.</p>
                <p style="font-size:13px; color:#aaa;">Chúng tôi luôn lấy uy tín đặt trên hàng đầu đối với khách hàng, hy vọng chúng tôi sẽ được phục vụ các bạn. Cám ơn!</p>
            </div>
            <div class="footer-col" style="flex: 1; min-width:150px;">
                <h4 style="font-size:15px; margin-bottom:15px; text-transform:uppercase;">Thông Tin Chung</h4>
                <ul class="footer-links" style="font-size:13px; color:#ccc; line-height:2.2;">
                    <li>› Chính sách bảo mật</li>
                    <li>› Điều khoản dịch vụ</li>
                    <li>› Hướng dẫn mua hàng</li>
                </ul>
                <h4 style="font-size:15px; margin-top:20px; margin-bottom:10px; text-transform:uppercase;">Thời Gian Hỗ Trợ:</h4>
                <p style="font-size:13px; color:#ccc;">24/7</p>
            </div>
            <div class="footer-col" style="flex: 1; min-width:150px;">
                <h4 style="font-size:15px; margin-bottom:15px; text-transform:uppercase;">Dịch Vụ Game</h4>
                <ul class="footer-links" style="font-size:13px; color:#ccc; line-height:2.2;">
                    <li>› Túi Mù 1 Nghìn</li>
                    <li>› Tìm Nick RBL Theo Yêu Cầu</li>
                    <li>› Tìm Nick FF Theo Yêu Cầu</li>
                    <li>› ACC DRACO</li>
                    <li>› NICK ROBLOX FRUITS FULL GEAR</li>
                    <li>› FC MOBILE</li>
                </ul>
            </div>
            <div class="footer-col" style="flex: 1.5; min-width:250px;">
                <h4 style="font-size:15px; margin-bottom:15px; text-transform:uppercase;">Thông Tin Liên Hệ</h4>
                <ul class="footer-links" style="font-size:13px; color:#ccc; line-height:2.2;">
                    <li>› SĐT/Zalo Hỗ Trợ 24/24: <a href="https://zalo.me/0387124869" target="_blank" style="color:#fbc02d;">0387124869</a></li>
                </ul>
                <h4 style="font-size:15px; margin-top:20px; margin-bottom:15px; text-transform:uppercase;">Hỗ Trợ Khách Hàng</h4>
                <button style="background:#1877f2; color:#fff; border:none; padding:10px 20px; border-radius:20px; font-weight:bold; cursor:pointer; display:flex; align-items:center; gap:10px; font-size:14px; box-shadow: 0 4px 10px rgba(24,119,242,0.3);">
                    <span style="font-size:20px;">💬</span> CHAT VỚI CHÚNG TÔI
                </button>
            </div>
        </div>
        <div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #333; font-size: 12px; color: #666;">
            &copy; 2026 Shop Acc Game. Đã đăng ký bản quyền.
        </div>
    </footer>

    <!-- Floating Action Buttons -->
    <div class="floating-buttons">
        <a href="https://zalo.me/0387124869" target="_blank" class="float-btn fb-zalo">Zalo</a>
    </div>

    <!-- Global Notification Modal -->
    <?php if(isset($_SESSION['success_payment']) || isset($_SESSION['error_payment'])): ?>
    <style>
    .notify-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5); z-index: 10000;
        display: flex; align-items: center; justify-content: center;
        backdrop-filter: blur(3px);
    }
    .notify-modal {
        background: #fff; border-radius: 16px; padding: 30px;
        width: 90%; max-width: 400px; text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: popIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    @keyframes popIn {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    .notify-icon {
        font-size: 60px; margin-bottom: 15px;
    }
    .notify-title {
        font-size: 22px; font-weight: 900; margin-bottom: 10px; color: #1f2937;
    }
    .notify-msg {
        font-size: 16px; color: #4b5563; margin-bottom: 25px; line-height: 1.5;
    }
    .notify-btn {
        background: #2563eb; color: #fff; border: none; padding: 12px 30px;
        border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 16px;
        transition: 0.2s; width: 100%;
    }
    .notify-btn:hover { background: #1d4ed8; }
    </style>
    <div class="notify-overlay" id="globalNotify">
        <div class="notify-modal">
            <?php if(isset($_SESSION['success_payment'])): ?>
                <div class="notify-icon">✅</div>
                <div class="notify-title" style="color: #10b981;">Nạp Thành Công!</div>
                <div class="notify-msg"><?= $_SESSION['success_payment'] ?></div>
            <?php elseif(isset($_SESSION['error_payment'])): ?>
                <div class="notify-icon">❌</div>
                <div class="notify-title" style="color: #ef4444;">Nạp Thất Bại</div>
                <div class="notify-msg"><?= $_SESSION['error_payment'] ?></div>
            <?php endif; ?>
            <button class="notify-btn" onclick="document.getElementById('globalNotify').style.display='none'">OK, đã hiểu</button>
        </div>
    </div>
    <?php 
        unset($_SESSION['success_payment']);
        unset($_SESSION['error_payment']);
    ?>
    <?php endif; ?>

    <div id="global-toast-container" style="position: fixed; bottom: 30px; right: 30px; z-index: 99999; display: flex; flex-direction: column; gap: 10px;"></div>
    
    <script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('global-toast-container');
        
        const toast = document.createElement('div');
        toast.style.cssText = `
            background: #fff;
            color: #1f2937;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 500;
            transform: translateX(120%);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-left: 5px solid ${type === 'success' ? '#10b981' : '#ef4444'};
        `;
        
        const icon = document.createElement('div');
        icon.style.cssText = `
            font-size: 20px;
            color: ${type === 'success' ? '#10b981' : '#ef4444'};
        `;
        icon.innerHTML = type === 'success' ? '✅' : '⚠️';
        
        const text = document.createElement('div');
        text.innerText = message;
        
        toast.appendChild(icon);
        toast.appendChild(text);
        
        container.appendChild(toast);
        
        // Trigger animation
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 10);
        
        // Auto remove
        setTimeout(() => {
            toast.style.transform = 'translateX(120%)';
            toast.style.opacity = '0';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
    </script>
</body>
</html>
