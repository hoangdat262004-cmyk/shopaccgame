<div class="affiliate-container">
    <div class="news-breadcrumb" style="margin-bottom: 20px;">
        <a href="<?= BASEURL; ?>">Trang chủ</a> / <span>Tiếp thị liên kết</span> / <span>Thống kê</span>
    </div>

    <h2 class="page-title" style="margin-bottom: 20px;">📊 THỐNG KÊ TIẾP THỊ LIÊN KẾT</h2>

    <!-- Referral Link Box -->
    <div class="affiliate-card referral-box" style="background: #fff; border-radius: 8px; padding: 25px; border-left: 5px solid #f44336; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 25px;">
        <h3 style="font-size: 18px; margin-bottom: 10px; color: #333;">🔗 Đường dẫn giới thiệu của bạn</h3>
        <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Chia sẻ liên kết này đến bạn bè hoặc trên mạng xã hội (Facebook, YouTube, TikTok...) để nhận ngay <strong>10% hoa hồng</strong> khi họ mua tài khoản game!</p>
        
        <div class="referral-input-group" style="display: flex; gap: 10px;">
            <input type="text" id="refLink" value="<?= htmlspecialchars($data['referral_link']); ?>" readonly style="flex: 1; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 15px; font-weight: bold; background: #f9f9f9; color: #555;">
            <button onclick="copyRefLink()" class="btn-red" style="padding: 0 25px; border-radius: 4px; font-weight: bold; font-size: 15px;">Sao chép</button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="affiliate-stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-bottom: 3px solid #2196F3;">
            <div class="stat-icon" style="font-size: 30px; margin-bottom: 10px;">🖱️</div>
            <div class="stat-label" style="font-size: 13px; color: #888; font-weight: bold; text-transform: uppercase;">Số lượt Click</div>
            <div class="stat-value" style="font-size: 24px; font-weight: bold; color: #333; margin-top: 5px;">154</div>
        </div>
        <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-bottom: 3px solid #4CAF50;">
            <div class="stat-icon" style="font-size: 30px; margin-bottom: 10px;">👤</div>
            <div class="stat-label" style="font-size: 13px; color: #888; font-weight: bold; text-transform: uppercase;">Số người Đăng ký</div>
            <div class="stat-value" style="font-size: 24px; font-weight: bold; color: #333; margin-top: 5px;">12</div>
        </div>
        <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-bottom: 3px solid #ff9800;">
            <div class="stat-icon" style="font-size: 30px; margin-bottom: 10px;">🛒</div>
            <div class="stat-label" style="font-size: 13px; color: #888; font-weight: bold; text-transform: uppercase;">Số đơn mua thành công</div>
            <div class="stat-value" style="font-size: 24px; font-weight: bold; color: #333; margin-top: 5px;">5</div>
        </div>
        <div class="stat-card" style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-bottom: 3px solid #f44336;">
            <div class="stat-icon" style="font-size: 30px; margin-bottom: 10px;">💰</div>
            <div class="stat-label" style="font-size: 13px; color: #888; font-weight: bold; text-transform: uppercase;">Hoa hồng khả dụng</div>
            <div class="stat-value" style="font-size: 24px; font-weight: bold; color: #f44336; margin-top: 5px;">150.000đ</div>
        </div>
    </div>

    <!-- Instruction Guide -->
    <div class="affiliate-card" style="background: #fff; border-radius: 8px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h3 style="font-size: 18px; margin-bottom: 20px; color: #333; border-bottom: 2px solid #eaeaea; padding-bottom: 10px;">💡 Cách thức kiếm tiền với Tiếp thị liên kết</h3>
        
        <div class="guide-steps" style="display: flex; gap: 30px;">
            <div class="step-item" style="flex: 1; text-align: center;">
                <div class="step-num" style="width: 40px; height: 40px; border-radius: 50%; background: #f44336; color: white; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 18px; margin: 0 auto 15px auto;">1</div>
                <h4 style="font-size: 15px; margin-bottom: 10px; color: #333;">Lấy link chia sẻ</h4>
                <p style="font-size: 13px; color: #666; line-height: 1.5;">Sao chép đường dẫn giới thiệu ở phía trên của bạn.</p>
            </div>
            <div class="step-item" style="flex: 1; text-align: center;">
                <div class="step-num" style="width: 40px; height: 40px; border-radius: 50%; background: #f44336; color: white; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 18px; margin: 0 auto 15px auto;">2</div>
                <h4 style="font-size: 15px; margin-bottom: 10px; color: #333;">Giới thiệu bạn bè</h4>
                <p style="font-size: 13px; color: #666; line-height: 1.5;">Gửi link cho bạn bè hoặc đăng bài chia sẻ, làm video review các game.</p>
            </div>
            <div class="step-item" style="flex: 1; text-align: center;">
                <div class="step-num" style="width: 40px; height: 40px; border-radius: 50%; background: #f44336; color: white; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 18px; margin: 0 auto 15px auto;">3</div>
                <h4 style="font-size: 15px; margin-bottom: 10px; color: #333;">Nhận hoa hồng</h4>
                <p style="font-size: 13px; color: #666; line-height: 1.5;">Khi bạn bè mua acc game, bạn nhận 10% hoa hồng và có thể rút ngay về ví!</p>
            </div>
        </div>
    </div>
</div>

<script>
function copyRefLink() {
    var copyText = document.getElementById("refLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    
    navigator.clipboard.writeText(copyText.value).then(function() {
        alert("Đã sao chép đường dẫn giới thiệu thành công!");
    }, function(err) {
        alert("Không thể sao chép. Vui lòng tự bôi đen và sao chép thủ công.");
    });
}
</script>
