            <!-- Welcome Banner -->
            <div class="card" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(6, 182, 212, 0.05)); border-color: rgba(139, 92, 246, 0.2);">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
                    <div>
                        <h2 style="font-size: 24px; margin-bottom: 8px; font-weight: 800;">
                            <span class="color-secondary-text">Xin chào,</span> <?= htmlspecialchars($_SESSION['username']); ?>!
                        </h2>
                        <p style="color: var(--text-muted);">Chào mừng quay trở lại trang quản trị hệ thống SHOPGAMING. Đây là nơi bạn có thể vận hành và theo dõi doanh thu của mình.</p>
                    </div>
                    <div style="font-size: 40px; color: var(--color-accent); text-shadow: 0 0 20px var(--color-accent-glow); animation: pulse 2s infinite;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid-stats">
                <!-- Revenue Card -->
                <div class="stat-card">
                    <div class="stat-card-left">
                        <span class="stat-card-title">Tổng Doanh Thu</span>
                        <span class="stat-card-value" style="color: var(--color-secondary);"><?= number_format($data['total_revenue'], 0, ',', '.'); ?>đ</span>
                    </div>
                    <div class="stat-card-icon" style="color: var(--color-secondary);">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="stat-card">
                    <div class="stat-card-left">
                        <span class="stat-card-title">Thành Viên</span>
                        <span class="stat-card-value"><?= number_format($data['total_users']); ?></span>
                    </div>
                    <div class="stat-card-icon" style="color: var(--color-accent);">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>

                <!-- Nick Available Card -->
                <div class="stat-card">
                    <div class="stat-card-left">
                        <span class="stat-card-title">Nick Còn Hàng</span>
                        <span class="stat-card-value" style="color: var(--color-success);"><?= number_format($data['accounts_available']); ?></span>
                    </div>
                    <div class="stat-card-icon" style="color: var(--color-success);">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                <!-- Nick Sold Card -->
                <div class="stat-card">
                    <div class="stat-card-left">
                        <span class="stat-card-title">Nick Đã Bán</span>
                        <span class="stat-card-value" style="color: var(--color-danger);"><?= number_format($data['accounts_sold']); ?></span>
                    </div>
                    <div class="stat-card-icon" style="color: var(--color-danger);">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 30px; margin-bottom: 30px; align-items: start;" class="form-row">
                <!-- Recent Transactions -->
                <div class="card" style="margin-bottom: 0;">
                    <div class="card-header-flex">
                        <h2><i class="fa-solid fa-file-invoice-dollar color-accent-text"></i> Giao Dịch Gần Đây</h2>
                        <a href="<?= BASEURL; ?>/admin/transactions" class="btn btn-secondary btn-sm">Xem tất cả</a>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Loại</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data['recent_transactions'])): ?>
                                    <?php foreach($data['recent_transactions'] as $tx): ?>
                                    <tr>
                                        <td class="flex-center">
                                            <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: bold; border: 1px solid var(--border-glass);">
                                                <?= strtoupper(substr($tx['username'], 0, 1)); ?>
                                            </div>
                                            <b><?= htmlspecialchars($tx['username']); ?></b>
                                        </td>
                                        <td>
                                            <?php if($tx['type'] == 'deposit'): ?>
                                                <span style="color: var(--color-secondary);"><i class="fa-solid fa-arrow-down-long"></i> Nạp tiền</span>
                                            <?php else: ?>
                                                <span style="color: var(--color-accent);"><i class="fa-solid fa-cart-shopping"></i> Mua nick</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="font-weight: 700;">
                                            <?= number_format($tx['amount'], 0, ',', '.'); ?>đ
                                        </td>
                                        <td>
                                            <?php if($tx['status'] == 'completed'): ?>
                                                <span class="badge badge-success">Thành công</span>
                                            <?php elseif($tx['status'] == 'pending'): ?>
                                                <span class="badge badge-warning">Đang chờ</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Thất bại</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; color: var(--text-muted);">Không có giao dịch nào gần đây.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Registered Users -->
                <div class="card" style="margin-bottom: 0;">
                    <div class="card-header-flex">
                        <h2><i class="fa-solid fa-user-plus color-secondary-text"></i> Thành Viên Mới</h2>
                        <a href="<?= BASEURL; ?>/admin/users" class="btn btn-secondary btn-sm">Quản lý</a>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Số dư</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data['recent_users'])): ?>
                                    <?php foreach($data['recent_users'] as $usr): ?>
                                    <tr>
                                        <td class="flex-center">
                                            <div style="width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(6, 182, 212, 0.2)); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; color:#fff;">
                                                <?= strtoupper(substr($usr['username'], 0, 1)); ?>
                                            </div>
                                            <div style="display: flex; flex-direction: column;">
                                                <span style="font-weight: 600;"><?= htmlspecialchars($usr['username']); ?></span>
                                                <span style="font-size: 10px; color: var(--text-muted);"><?= htmlspecialchars($usr['role'] == 'admin' ? 'Admin' : 'Thành viên'); ?></span>
                                            </div>
                                        </td>
                                        <td style="font-weight: bold; color: var(--color-success);">
                                            <?= number_format($usr['balance'], 0, ',', '.'); ?>đ
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" style="text-align: center; color: var(--text-muted);">Chưa có thành viên nào.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Quick Add Account -->
            <div class="card" style="margin-bottom: 30px; border-left: 4px solid var(--color-accent);">
                <h2><i class="fa-solid fa-bolt color-accent-text"></i> Thêm Nhanh Tài Khoản TFT</h2>
                <form action="<?= BASEURL; ?>/admin/accounts" method="POST" enctype="multipart/form-data" style="margin-top: 15px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div>
                            <label style="display: block; color: var(--text-muted); font-size: 13px; margin-bottom: 5px;">Danh mục</label>
                            <select name="category_id" class="form-input" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid var(--border-glass); color: #fff; border-radius: 6px;">
                                <?php foreach($data['categories'] as $cat): ?>
                                    <option value="<?= $cat['id']; ?>" <?= stripos($cat['name'], 'TFT Tự chọn') !== false ? 'selected' : ''; ?> style="color: #000;">
                                        <?= htmlspecialchars($cat['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; color: var(--text-muted); font-size: 13px; margin-bottom: 5px;">Tiêu đề</label>
                            <input type="text" name="title" class="form-input" required placeholder="Nick tự chọn giá siêu rẻ" value="Túi Mù TFT 1 Nghìn Đồng" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid var(--border-glass); color: #fff; border-radius: 6px;">
                        </div>
                        <div>
                            <label style="display: block; color: var(--text-muted); font-size: 13px; margin-bottom: 5px;">Giá bán (VNĐ)</label>
                            <input type="number" name="price" class="form-input" required placeholder="Ví dụ: 1000" value="1000" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid var(--border-glass); color: #fff; border-radius: 6px;">
                            <input type="hidden" name="old_price" value="0">
                        </div>
                        <div>
                            <label style="display: block; color: var(--text-muted); font-size: 13px; margin-bottom: 5px;">Số lượng (Stock)</label>
                            <input type="number" name="stock" class="form-input" value="100" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid var(--border-glass); color: #fff; border-radius: 6px;">
                        </div>
                    </div>
                    
                    <div style="margin-top: 15px;">
                        <label style="display: block; color: var(--text-muted); font-size: 13px; margin-bottom: 5px;">Hình ảnh (Bỏ qua nếu muốn dùng ảnh gốc của danh mục hoặc cập nhật sau)</label>
                        <input type="file" name="image" class="form-input" accept="image/*" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid var(--border-glass); color: #fff; border-radius: 6px;">
                    </div>
                    
                    <div style="margin-top: 15px;">
                        <label style="display: block; color: var(--text-muted); font-size: 13px; margin-bottom: 5px;">Mô tả ngắn</label>
                        <textarea name="description" class="form-input" rows="2" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid var(--border-glass); color: #fff; border-radius: 6px;">Nick TFT tự chọn Random mã số</textarea>
                    </div>

                    <input type="hidden" name="account_username" value="random_tft">
                    <input type="hidden" name="account_password" value="random_tft">
                    
                    <div style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 25px; font-weight: bold;"><i class="fa-solid fa-plus"></i> Đăng Bán Ngay</button>
                    </div>
                </form>
            </div>

            <!-- Quick Info Cards -->
            <div class="card">
                <h2><i class="fa-solid fa-circle-info color-accent-text"></i> Hướng Dẫn Vận Hành</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin-top: 15px;">
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-glass); padding: 15px; border-radius: 8px;">
                        <h4 style="color:#fff; margin-bottom: 8px;"><i class="fa-solid fa-folder-open color-secondary-text"></i> Bước 1: Quản lý Danh mục</h4>
                        <p style="font-size:13px;">Nhấp vào menu <b>Quản lý Danh mục</b> để tạo các tựa game như Liên Quân Mobile, Free Fire, Roblox. Tải lên hình ảnh game hấp dẫn để thu hút người mua.</p>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-glass); padding: 15px; border-radius: 8px;">
                        <h4 style="color:#fff; margin-bottom: 8px;"><i class="fa-solid fa-gamepad color-accent-text"></i> Bước 2: Đăng Bán Nick Game</h4>
                        <p style="font-size:13px;">Nhấp vào <b>Quản lý Tài khoản</b>, chọn Danh mục game, đặt tiêu đề hấp dẫn, mô tả chi tiết nick và điền tài khoản mật khẩu game để hệ thống tự động giao hàng khi có người mua.</p>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-glass); padding: 15px; border-radius: 8px;">
                        <h4 style="color:#fff; margin-bottom: 8px;"><i class="fa-solid fa-users-gear color-secondary-text"></i> Bước 3: Hỗ Trợ Người Dùng</h4>
                        <p style="font-size:13px;">Vào phần <b>Quản lý Đăng nhập</b> để kiểm tra danh sách khách hàng, nâng quyền Admin cho nhân viên hoặc cộng thêm số dư khi nhận tiền nạp thẻ của khách.</p>
                    </div>
                </div>
            </div>

        </div> <!-- /content-area -->
    </div> <!-- /main-content -->
</body>
</html>
