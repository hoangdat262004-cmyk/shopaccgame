<style>
.payment-wrapper {
    max-width: 600px;
    margin: 40px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}
.payment-tabs {
    display: flex;
    border-bottom: 1px solid #e5e7eb;
}
.payment-tab {
    flex: 1;
    text-align: center;
    padding: 16px;
    font-weight: 600;
    cursor: pointer;
    background: #f9fafb;
    color: #6b7280;
    transition: all 0.2s;
    font-size: 16px;
}
.payment-tab.active {
    background: #eff6ff;
    color: #2563eb;
    border-bottom: 3px solid #2563eb;
}
.payment-content {
    display: none;
    padding: 24px;
}
.payment-content.active {
    display: block;
}
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    font-weight: 700;
    margin-bottom: 8px;
    color: #111827;
    font-size: 15px;
}
.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    outline: none;
    font-size: 15px;
    transition: border-color 0.2s;
}
.form-control:focus {
    border-color: #2563eb;
}

/* Grid mệnh giá */
.amount-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
.amount-radio {
    display: none;
}
.amount-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
}
.amount-box .val {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
}
.amount-box .desc {
    font-size: 14px;
    color: #4b5563;
    margin-top: 4px;
}
.amount-radio:checked + .amount-box {
    border-color: #2563eb;
    background: #eff6ff;
}
.amount-radio:checked + .amount-box .val,
.amount-radio:checked + .amount-box .desc {
    color: #2563eb;
}

.btn-submit {
    width: 100%;
    background: #2563eb;
    color: #fff;
    border: none;
    padding: 16px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 10px;
    transition: background 0.2s;
}
.btn-submit:hover {
    background: #1d4ed8;
}

/* ATM */
.atm-info {
    text-align: center;
    padding: 24px;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 8px;
}
.atm-info p {
    font-size: 16px;
    margin-bottom: 12px;
}
</style>

<div class="container" style="min-height: 60vh;">
    <div class="payment-wrapper">
        <div class="payment-tabs">
            <div class="payment-tab active" onclick="switchTab('card')">Nạp thẻ cào</div>
            <div class="payment-tab" onclick="switchTab('atm')">ATM tự động</div>
        </div>
        
        <!-- Nạp thẻ cào -->
        <div id="tab-card" class="payment-content active">
            <form action="<?= BASEURL; ?>/payment/deposit" method="POST">
                <div class="form-group">
                    <label>Nhà cung cấp</label>
                    <select name="provider" class="form-control" required>
                        <option value="viettel">VIETTEL</option>
                        <option value="mobi">MOBIFONE</option>
                        <option value="vina">VINAPHONE</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Chọn mệnh giá</label>
                    <div class="amount-grid">
                        <label>
                            <input type="radio" name="amount" value="10000" class="amount-radio" required>
                            <div class="amount-box">
                                <span class="val">10.000đ</span>
                                <span class="desc">Nhận 80%</span>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="amount" value="20000" class="amount-radio">
                            <div class="amount-box">
                                <span class="val">20.000đ</span>
                                <span class="desc">Nhận 80%</span>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="amount" value="50000" class="amount-radio">
                            <div class="amount-box">
                                <span class="val">50.000đ</span>
                                <span class="desc">Nhận 80%</span>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="amount" value="100000" class="amount-radio">
                            <div class="amount-box">
                                <span class="val">100.000đ</span>
                                <span class="desc">Nhận 80%</span>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="amount" value="200000" class="amount-radio">
                            <div class="amount-box">
                                <span class="val">200.000đ</span>
                                <span class="desc">Nhận 80%</span>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="amount" value="500000" class="amount-radio">
                            <div class="amount-box">
                                <span class="val">500.000đ</span>
                                <span class="desc">Nhận 80%</span>
                            </div>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Mã số thẻ</label>
                    <input type="text" name="pin" class="form-control" placeholder="Nhập mã pin" required>
                </div>
                
                <div class="form-group">
                    <label>Số sê-ri</label>
                    <input type="text" name="serial" class="form-control" placeholder="Nhập số sê-ri" required>
                </div>
                
                <button type="submit" class="btn-submit">NẠP THẺ</button>
            </form>
        </div>
        
        <!-- Nạp ATM -->
        <div id="tab-atm" class="payment-content">
            <h3 style="color: #4CAF50; text-align: center; margin-top: 0; margin-bottom: 24px;">
                <i class="fa-solid fa-qrcode"></i> Chuyển Khoản Ngân Hàng
            </h3>
            
            <div class="atm-info">
                <p>Ngân hàng: <b>MB Bank</b></p>
                <p>Chủ tài khoản: <b>HOÀNG DƯƠNG ĐẠT</b></p>
                <p style="font-size: 22px; color: #ef4444; font-weight: 700;">Số tài khoản: 0387124869999</p>
                
                <div style="margin-top: 24px; margin-bottom: 16px;">
                    <p style="font-weight: 700; margin-bottom: 8px;">Nội dung chuyển khoản (Bắt buộc):</p>
                    <?php $noidung = "NAP " . (isset($_SESSION['username']) ? strtoupper($_SESSION['username']) : 'USERNAME'); ?>
                    <div style="background: #eff6ff; padding: 12px; border-radius: 8px; font-size: 20px; font-weight: bold; color: #2563eb; display: inline-block; border: 1px solid #bfdbfe;">
                        <?= $noidung ?>
                    </div>
                </div>
                
                <p style="font-size: 14px; color: #6b7280; font-style: italic;">Quét mã QR dưới đây bằng ứng dụng ngân hàng</p>
                <?php 
                    $qrUrl = "https://img.vietqr.io/image/MB-0387124869999-compact2.jpg?amount=&addInfo=" . urlencode($noidung) . "&accountName=HOANG%20DUONG%20DAT";
                ?>
                <img src="<?= $qrUrl ?>" alt="QR Code" style="max-width: 250px; margin-top: 16px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            </div>
            <p style="text-align: center; margin-top: 24px; font-size: 14px; color: #6b7280;">
                Lưu ý: Chuyển đúng nội dung. Hệ thống sẽ tự động cộng tiền trong vòng 1-5 phút. Nhận 100% giá trị nạp.
            </p>
        </div>
    </div>

    <!-- Lịch sử nạp thẻ -->
    <div style="background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 24px; margin-top: 24px;">
        <h3 style="color: #111827; margin-top: 0; margin-bottom: 20px; font-size: 18px; border-bottom: 2px solid #ef4444; display: inline-block; padding-bottom: 8px;">Lịch Sử Nạp Thẻ</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; color: #374151;">Mã GD</th>
                        <th style="padding: 12px; color: #374151;">Nhà Mạng</th>
                        <th style="padding: 12px; color: #374151;">Mệnh Giá</th>
                        <th style="padding: 12px; color: #374151;">Mã Thẻ / Serial</th>
                        <th style="padding: 12px; color: #374151;">Trạng Thái</th>
                        <th style="padding: 12px; color: #374151;">Thực Nhận</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data['history'])): ?>
                        <?php foreach($data['history'] as $tx): ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;"><?= htmlspecialchars($tx['trans_id']) ?></td>
                            <td style="padding: 12px; font-weight: bold;"><?= htmlspecialchars($tx['network']) ?></td>
                            <td style="padding: 12px;"><?= number_format($tx['declared_value'], 0, ',', '.') ?>đ</td>
                            <td style="padding: 12px;">
                                Pin: <?= htmlspecialchars($tx['pin']) ?><br>
                                Seri: <?= htmlspecialchars($tx['serial']) ?>
                            </td>
                            <td style="padding: 12px;">
                                <?php if($tx['status'] == 'pending'): ?>
                                    <span style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 4px; font-weight: 500;">Chờ xử lý</span>
                                <?php elseif($tx['status'] == 'completed'): ?>
                                    <span style="background: #d1fae5; color: #059669; padding: 4px 8px; border-radius: 4px; font-weight: 500;">Thành công</span>
                                <?php else: ?>
                                    <span style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 4px; font-weight: 500;">Thất bại</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px; font-weight: bold; color: #ef4444;">
                                +<?= number_format($tx['amount'], 0, ',', '.') ?>đ
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="padding: 16px; text-align: center; color: #6b7280;">Chưa có giao dịch nạp thẻ nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function switchTab(tabId) {
    document.querySelectorAll('.payment-content').forEach(function(el) {
        el.classList.remove('active');
    });
    document.querySelectorAll('.payment-tab').forEach(function(el) {
        el.classList.remove('active');
    });
    
    document.getElementById('tab-' + tabId).classList.add('active');
    if(tabId === 'card') {
        document.querySelectorAll('.payment-tab')[0].classList.add('active');
    } else {
        document.querySelectorAll('.payment-tab')[1].classList.add('active');
    }
}
</script>
