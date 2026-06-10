<div class="affiliate-container">
    <div class="news-breadcrumb" style="margin-bottom: 20px;">
        <a href="<?= BASEURL; ?>">Trang chủ</a> / <span>Tiếp thị liên kết</span> / <span>Rút tiền</span>
    </div>

    <h2 class="page-title" style="margin-bottom: 20px;">🏦 RÚT TIỀN HOA HỒNG</h2>

    <div style="display: flex; gap: 25px; flex-wrap: wrap;">
        <!-- Left: Form Box -->
        <div class="affiliate-card" style="flex: 2; background: #fff; border-radius: 8px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); min-width: 320px;">
            <h3 style="font-size: 18px; margin-bottom: 20px; color: #333; border-bottom: 2px solid #eaeaea; padding-bottom: 10px;">📋 Điền thông tin nhận tiền</h3>
            
            <form onsubmit="submitWithdrawal(event)" class="deposit-form" style="display: flex; flex-direction: column; gap: 15px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 500; font-size: 14px; display: block; margin-bottom: 5px;">Chọn Ngân hàng / Ví điện tử</label>
                    <select required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                        <option value="">-- Chọn ngân hàng/ví --</option>
                        <option value="momo">Ví điện tử MoMo</option>
                        <option value="zalopay">Ví điện tử ZaloPay</option>
                        <option value="mbbank">Ngân hàng MB Bank (Quân Đội)</option>
                        <option value="vcb">Ngân hàng Vietcombank</option>
                        <option value="tpb">Ngân hàng TPBank</option>
                        <option value="acb">Ngân hàng ACB</option>
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 500; font-size: 14px; display: block; margin-bottom: 5px;">Số tài khoản / Số điện thoại ví</label>
                    <input type="text" required placeholder="Nhập số tài khoản nhận tiền..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                </div>
                
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 500; font-size: 14px; display: block; margin-bottom: 5px;">Tên chủ tài khoản (Viết hoa không dấu)</label>
                    <input type="text" required placeholder="Ví dụ: NGUYEN VAN A" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; text-transform: uppercase;">
                </div>
                
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 500; font-size: 14px; display: block; margin-bottom: 5px;">Số tiền muốn rút (Tối thiểu 50.000đ)</label>
                    <input type="number" required min="50000" max="<?= $data['affiliate_balance']; ?>" placeholder="Nhập số tiền muốn rút..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                </div>
                
                <button type="submit" class="btn-submit" style="margin-top: 10px; width: 100%; padding: 12px; background: #f44336; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px; transition: background 0.2s;">
                    Gửi yêu cầu rút tiền
                </button>
            </form>
        </div>

        <!-- Right: Guide Box -->
        <div class="affiliate-card" style="flex: 1; background: #fff; border-radius: 8px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); min-width: 260px; height: fit-content; border-top: 3px solid #ff9800;">
            <h3 style="font-size: 16px; margin-bottom: 15px; color: #333;">💰 Số dư hoa hồng khả dụng</h3>
            <div style="font-size: 32px; font-weight: bold; color: #f44336; margin-bottom: 25px;">
                <?= number_format($data['affiliate_balance'], 0, ',', '.'); ?>đ
            </div>
            
            <h4 style="font-size: 14px; margin-bottom: 10px; color: #333; font-weight: bold;">⚠️ Quy định rút tiền</h4>
            <ul style="padding-left: 15px; margin: 0; font-size: 13px; color: #666; display: flex; flex-direction: column; gap: 8px; line-height: 1.5;">
                <li>Hạn mức rút tiền tối thiểu là <strong>50.000đ</strong>.</li>
                <li>Thời gian duyệt yêu cầu từ <strong>5 - 15 phút</strong> kể từ khi gửi yêu cầu.</li>
                <li>Hỗ trợ chuyển khoản tất cả các ngân hàng Việt Nam và ví điện tử (MoMo, ZaloPay).</li>
                <li>Vui lòng kiểm tra kỹ thông tin STK và Tên người nhận, admin sẽ không chịu trách nhiệm nếu chuyển nhầm do sai sót thông tin.</li>
            </ul>
        </div>
    </div>
</div>

<script>
function submitWithdrawal(e) {
    e.preventDefault();
    alert("Yêu cầu rút tiền của bạn đã được gửi thành công! Admin sẽ duyệt và gửi tiền cho bạn trong vòng 5-15 phút.");
    window.location.href = "<?= BASEURL; ?>/affiliate/history";
}
</script>
