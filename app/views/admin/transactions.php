            <!-- Transactions History Card -->
            <div class="card">
                <div class="card-header-flex">
                    <h2><i class="fa-solid fa-receipt color-accent-text"></i> Lịch Sử Giao Dịch Toàn Hệ Thống</h2>
                    <span style="font-size: 13px; color: var(--text-muted);">Tổng số giao dịch: <b><?= count($data['transactions']); ?></b> lượt nạp/mua.</span>
                </div>
                
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 80px;">Mã GD</th>
                                <th>Thành Viên</th>
                                <th>Số Tiền</th>
                                <th>Loại Giao Dịch</th>
                                <th>Trạng Thái</th>
                                <th>Thời Gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($data['transactions'])): ?>
                                <?php foreach($data['transactions'] as $tx): ?>
                                <tr>
                                    <td><code style="color: var(--color-secondary); font-weight: bold;">#<?= $tx['id']; ?></code></td>
                                    <td class="flex-center">
                                        <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; border: 1px solid var(--border-glass);">
                                            <?= strtoupper(substr($tx['username'], 0, 1)); ?>
                                        </div>
                                        <b><?= htmlspecialchars($tx['username']); ?></b>
                                    </td>
                                    <td>
                                        <b style="font-size: 15px; color: <?= $tx['type'] === 'purchase' ? 'var(--color-accent)' : 'var(--color-success)'; ?>">
                                            <?= $tx['type'] === 'purchase' ? '-' : '+'; ?><?= number_format($tx['amount'], 0, ',', '.'); ?>đ
                                        </b>
                                    </td>
                                    <td>
                                        <?php if($tx['type'] === 'deposit'): ?>
                                            <span style="color: var(--color-secondary); font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
                                                <i class="fa-solid fa-arrow-down-long"></i> Nạp tiền
                                            </span>
                                        <?php else: ?>
                                            <span style="color: var(--color-accent); font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
                                                <i class="fa-solid fa-cart-shopping"></i> Mua tài khoản
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($tx['status'] === 'completed'): ?>
                                            <span class="badge badge-success">Thành công</span>
                                        <?php elseif($tx['status'] === 'pending'): ?>
                                            <span class="badge badge-warning">Đang chờ</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Thất bại</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-size: 13px; color: var(--text-muted);">
                                        <?= date('H:i:s d/m/Y', strtotime($tx['created_at'])); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 30px;">Không tìm thấy lịch sử giao dịch nào trên hệ thống.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div> <!-- /content-area -->
    </div> <!-- /main-content -->
</body>
</html>
