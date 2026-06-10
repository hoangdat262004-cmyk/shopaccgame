            <!-- Users Management Card -->
            <div class="card">
                <div class="card-header-flex">
                    <h2><i class="fa-solid fa-users-gear color-accent-text"></i> Quản Lý Đăng Nhập</h2>
                    <span style="font-size: 13px; color: var(--text-muted);">Tổng cộng: <b><?= count($data['users']); ?></b> tài khoản người dùng.</span>
                </div>
                
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th>Thành Viên (Username)</th>
                                <th>Email</th>
                                <th>Số Dư</th>
                                <th>Vai Trò</th>
                                <th>Ngày Tham Gia</th>
                                <th style="width: 250px; text-align: center;">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($data['users'])): ?>
                                <?php foreach($data['users'] as $usr): ?>
                                <tr>
                                    <td><?= $usr['id']; ?></td>
                                    <td class="flex-center">
                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(6, 182, 212, 0.2)); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: bold; color: #fff; border: 1px solid var(--border-glass);">
                                            <?= strtoupper(substr($usr['username'], 0, 1)); ?>
                                        </div>
                                        <b class="color-accent-text" style="font-size:15px;"><?= htmlspecialchars($usr['username']); ?></b>
                                    </td>
                                    <td><?= htmlspecialchars($usr['email']); ?></td>
                                    <td>
                                        <b style="color: var(--color-success); font-size: 15px;">
                                            <?= number_format($usr['balance'], 0, ',', '.'); ?>đ
                                        </b>
                                    </td>
                                    <td>
                                        <?php if($usr['role'] == 'admin'): ?>
                                            <span class="badge badge-danger" style="box-shadow: 0 0 10px rgba(239, 68, 68, 0.2);">Admin</span>
                                        <?php else: ?>
                                            <span class="badge badge-info">User</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-size: 13px; color: var(--text-muted);">
                                        <?= date('H:i d/m/Y', strtotime($usr['created_at'])); ?>
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 8px; justify-content: center;">
                                            <!-- Edit Balance Button -->
                                            <button onclick="openBalanceModal(<?= $usr['id']; ?>, '<?= htmlspecialchars($usr['username']); ?>', <?= $usr['balance']; ?>)" class="btn btn-secondary btn-sm" title="Sửa số dư">
                                                <i class="fa-solid fa-coins" style="color: var(--color-warning);"></i> Số dư
                                            </button>
                                            
                                            <!-- Quick Role Toggle Form -->
                                            <form action="<?= BASEURL; ?>/admin/users" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="action" value="update_role">
                                                <input type="hidden" name="user_id" value="<?= $usr['id']; ?>">
                                                <?php if($usr['role'] == 'admin'): ?>
                                                    <input type="hidden" name="role" value="user">
                                                    <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Hạ quyền Admin của tài khoản này?');">
                                                        <i class="fa-solid fa-user-minus"></i> Hạ User
                                                    </button>
                                                <?php else: ?>
                                                    <input type="hidden" name="role" value="admin">
                                                    <button type="submit" class="btn btn-secondary btn-sm" style="border-color: rgba(139, 92, 246, 0.3);" onclick="return confirm('Nâng tài khoản này lên Admin?');">
                                                        <i class="fa-solid fa-user-shield" style="color: var(--color-accent);"></i> Lên Admin
                                                    </button>
                                                <?php endif; ?>
                                            </form>
                                            
                                            <!-- Delete User -->
                                            <?php if($usr['id'] != $_SESSION['user_id']): ?>
                                                <a href="<?= BASEURL; ?>/admin/deleteUser/<?= $usr['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa thành viên này? Tất cả dữ liệu liên quan sẽ bị xóa.');" title="Xóa thành viên">
                                                    <i class="fa-solid fa-trash"></i> Xóa
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary btn-sm" disabled style="opacity: 0.5; cursor: not-allowed;">
                                                    <i class="fa-solid fa-user-large"></i> Là Bạn
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 30px;">Không tìm thấy thành viên nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Balance Editor Modal -->
            <div id="balance-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fa-solid fa-coins color-warning-text"></i> Thay Đổi Số Dư Thành Viên</h3>
                        <button onclick="closeBalanceModal()" class="modal-close"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= BASEURL; ?>/admin/users" method="POST">
                            <input type="hidden" name="action" value="update_balance">
                            <input type="hidden" name="user_id" id="modal-user-id">
                            
                            <div class="form-group">
                                <label>Thành Viên</label>
                                <input type="text" id="modal-username" class="form-control" style="background: rgba(255,255,255,0.01); border-color: transparent;" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>Số Dư Hiện Tại</label>
                                <input type="text" id="modal-current-balance-display" class="form-control" style="background: rgba(255,255,255,0.01); border-color: transparent; font-weight: bold; color: var(--color-success);" readonly>
                            </div>

                            <div class="form-group">
                                <label>Nhập Số Dư Mới (VNĐ)</label>
                                <input type="number" name="balance" id="modal-new-balance" class="form-control" placeholder="vd: 50000" required>
                                <span style="font-size:11px; color: var(--text-muted);">Mẹo: Điền trực tiếp số tiền bạn muốn tài khoản này sở hữu.</span>
                            </div>
                            
                            <div style="display: flex; gap: 10px; margin-top: 20px;">
                                <button type="submit" class="btn btn-primary" style="flex: 1;"><i class="fa-solid fa-floppy-disk"></i> Cập Nhật</button>
                                <button type="button" onclick="closeBalanceModal()" class="btn btn-secondary" style="flex: 1;">Hủy Bỏ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Javascript -->
            <script>
                function openBalanceModal(id, username, balance) {
                    document.getElementById('modal-user-id').value = id;
                    document.getElementById('modal-username').value = username;
                    document.getElementById('modal-current-balance-display').value = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(balance);
                    document.getElementById('modal-new-balance').value = balance;
                    
                    const modal = document.getElementById('balance-modal');
                    modal.classList.add('show');
                }

                function closeBalanceModal() {
                    const modal = document.getElementById('balance-modal');
                    modal.classList.remove('show');
                }

                // Close modal on click outside
                window.onclick = function(event) {
                    const modal = document.getElementById('balance-modal');
                    if (event.target == modal) {
                        modal.classList.remove('show');
                    }
                }
            </script>

        </div> <!-- /content-area -->
    </div> <!-- /main-content -->
</body>
</html>
