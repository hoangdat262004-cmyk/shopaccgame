            <!-- Collapse Add Form Button -->
            <div style="margin-bottom: 25px; display: flex; justify-content: flex-end;">
                <button onclick="toggleAddForm()" class="btn btn-primary" id="btn-toggle-form">
                    <i class="fa-solid fa-plus"></i> Đăng Nick Mới
                </button>
            </div>

            <!-- Add Account Form -->
            <div class="card" id="add-account-card" style="display: none;">
                <div class="card-header-flex">
                    <h2><i class="fa-solid fa-square-plus color-accent-text"></i> Thêm Tài Khoản Mới</h2>
                    <button onclick="toggleAddForm()" class="btn btn-secondary btn-sm"><i class="fa-solid fa-xmark"></i> Đóng</button>
                </div>
                
                <form action="<?= BASEURL; ?>/admin/accounts" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Danh Mục Game</label>
                            <select name="category_id" class="form-control" required>
                                <option value="" disabled selected>-- Chọn danh mục game --</option>
                                <?php 
                                    // Group categories by parent_id
                                    $parents = [];
                                    $children = [];
                                    foreach($data['categories'] as $cat) {
                                        if(empty($cat['parent_id'])) {
                                            $parents[$cat['id']] = $cat;
                                        } else {
                                            $children[$cat['parent_id']][] = $cat;
                                        }
                                    }
                                    
                                    // Render them with hierarchy
                                    foreach($parents as $pid => $pcat): 
                                ?>
                                    <option value="<?= $pcat['id']; ?>" style="font-weight: bold; color: #dc2626;">▶ <?= htmlspecialchars($pcat['name']); ?> (Thư mục cha)</option>
                                    <?php if(isset($children[$pid])): ?>
                                        <?php foreach($children[$pid] as $ccat): ?>
                                            <option value="<?= $ccat['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;↳ <?= htmlspecialchars($ccat['name']); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" class="form-control" placeholder="vd: Acc Liên Quân Rank Cao Thủ" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Mô tả / Thông tin chi tiết</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Thông tin ngọc, tướng, trang phục hoặc các thông tin đặc biệt..."></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Hình Ảnh (Thumbnail)</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Giá bán (VNĐ)</label>
                            <input type="number" name="price" class="form-control" placeholder="vd: 100000" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Giá cũ (VNĐ)</label>
                            <input type="number" name="old_price" class="form-control" placeholder="vd: 200000">
                        </div>
                        
                        <div class="form-group">
                            <label>Số lượng (Túi mù nếu > 1)</label>
                            <input type="number" name="stock" class="form-control" value="1" min="1" required>
                        </div>
                    </div>

                    <div class="form-row" style="background: rgba(255,255,255,0.01); padding: 15px; border-radius: var(--border-radius-md); border: 1px solid var(--border-glass);">
                        <div class="form-group">
                            <label style="color: var(--color-secondary);"><i class="fa-solid fa-user-lock"></i> Tài Khoản Game (Đăng nhập)</label>
                            <input type="text" name="account_username" class="form-control" style="border-color: rgba(6, 182, 212, 0.2);" placeholder="Tên đăng nhập nick game">
                        </div>
                        
                        <div class="form-group">
                            <label style="color: var(--color-secondary);"><i class="fa-solid fa-key"></i> Mật Khẩu Game</label>
                            <input type="text" name="account_password" class="form-control" style="border-color: rgba(6, 182, 212, 0.2);" placeholder="Mật khẩu nick game">
                        </div>
                    </div>
                    
                    <div class="form-row" style="background: rgba(255,255,255,0.01); padding: 15px; border-radius: var(--border-radius-md); border: 1px solid var(--border-glass);">
                        <div class="form-group" style="margin-bottom: 0; width: 100%;">
                            <label style="color: var(--color-secondary);"><i class="fa-solid fa-list"></i> Danh sách tài khoản (Dành cho Túi Mù / Random)</label>
                            <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 10px;">
                                Thêm từng tài khoản vào danh sách bên dưới. Hệ thống sẽ tự động gán vào các mã số Túi mù và cập nhật Số lượng tương ứng.
                            </p>
                            
                            <div id="dynamic-account-list">
                                <!-- First Row -->
                                <div class="account-row" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: center; flex-wrap: wrap;">
                                    <input type="text" name="list_username[]" class="form-control" placeholder="Tài khoản" style="flex: 1; border-color: rgba(6, 182, 212, 0.2); min-width: 150px;">
                                    <input type="text" name="list_password[]" class="form-control" placeholder="Mật khẩu" style="flex: 1; border-color: rgba(6, 182, 212, 0.2); min-width: 150px;">
                                    <input type="file" name="list_image[]" class="form-control" accept="image/*" style="flex: 1; min-width: 150px; padding: 6px;">
                                    <button type="button" class="btn btn-danger btn-sm remove-row" style="padding: 10px 15px;"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                            
                            <button type="button" id="add-account-row" class="btn" style="background: rgba(6, 182, 212, 0.1); color: var(--color-primary); border: 1px dashed var(--color-primary); width: 100%; margin-top: 10px;">
                                <i class="fa-solid fa-plus"></i> Thêm tài khoản
                            </button>
                            
                            <script>
                                document.getElementById('add-account-row').addEventListener('click', function() {
                                    const container = document.getElementById('dynamic-account-list');
                                    const row = document.createElement('div');
                                    row.className = 'account-row';
                                    row.style.cssText = 'display: flex; gap: 10px; margin-bottom: 10px; align-items: center; flex-wrap: wrap;';
                                    row.innerHTML = `
                                        <input type="text" name="list_username[]" class="form-control" placeholder="Tài khoản" style="flex: 1; border-color: rgba(6, 182, 212, 0.2); min-width: 150px;">
                                        <input type="text" name="list_password[]" class="form-control" placeholder="Mật khẩu" style="flex: 1; border-color: rgba(6, 182, 212, 0.2); min-width: 150px;">
                                        <input type="file" name="list_image[]" class="form-control" accept="image/*" style="flex: 1; min-width: 150px; padding: 6px;">
                                        <button type="button" class="btn btn-danger btn-sm remove-row" style="padding: 10px 15px;"><i class="fa-solid fa-trash"></i></button>
                                    `;
                                    container.appendChild(row);
                                });
                                
                                document.getElementById('dynamic-account-list').addEventListener('click', function(e) {
                                    if (e.target.classList.contains('remove-row') || e.target.closest('.remove-row')) {
                                        const row = e.target.closest('.account-row');
                                        row.remove();
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="margin-top: 20px; width: 100%;">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Đăng Bán Ngay
                    </button>
                </form>
            </div>

            <!-- Accounts List -->
            <div class="card">
                <div class="card-header-flex">
                    <h2><i class="fa-solid fa-gamepad color-secondary-text"></i> Danh Sách Tài Khoản Game</h2>
                    <div>
                        <span style="font-size: 13px; color: var(--text-muted); margin-right: 15px;">Tổng cộng: <b><?= count($data['accounts']); ?></b> nick game.</span>
                        <button type="button" class="btn btn-danger btn-sm" onclick="submitBulkDelete()" id="btn-bulk-delete" style="display: none;">
                            <i class="fa-solid fa-trash-can"></i> Xóa các mục đã chọn (<span id="bulk-count">0</span>)
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <form id="bulkDeleteForm" action="<?= BASEURL; ?>/admin/bulkDeleteAccounts" method="POST">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 40px; text-align: center;"><input type="checkbox" id="checkAll" onclick="toggleAll(this)"></th>
                                    <th style="width: 50px;">ID</th>
                                    <th>Danh Mục</th>
                                    <th style="width: 80px;">Hình Ảnh</th>
                                    <th>Tiêu đề / Thông tin</th>
                                    <th>Giá</th>
                                    <th>Thông tin tài khoản (Ẩn/Hiện)</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 150px; text-align: center;">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data['accounts'])): ?>
                                    <?php foreach($data['accounts'] as $acc): ?>
                                    <?php 
                                        $img = !empty($acc['image_url']) ? $acc['image_url'] : ($acc['image'] ?? ''); 
                                        $img_src = (strpos($img, 'http') === 0) ? $img : BASEURL . '/uploads/' . $img;
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><input type="checkbox" name="account_ids[]" value="<?= $acc['id']; ?>" class="chk-acc" onclick="updateBulkCount()"></td>
                                        <td><?= $acc['id']; ?></td>
                                        <td>
                                            <span class="badge badge-info" style="font-size:11px;"><?= htmlspecialchars($acc['category_name']); ?></span>
                                        </td>
                                        <td>
                                            <?php if(!empty($img)): ?>
                                                <img src="<?= $img_src; ?>" class="img-rounded" width="60" height="45" style="object-fit: cover;">
                                            <?php else: ?>
                                                <div style="width: 60px; height: 45px; background: rgba(255,255,255,0.05); border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa-solid fa-gamepad" style="color: var(--text-muted);"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div style="display: flex; flex-direction: column; max-width: 250px;">
                                                <span style="font-weight: 600; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" title="<?= htmlspecialchars($acc['title']); ?>"><?= htmlspecialchars($acc['title']); ?></span>
                                                <span style="font-size: 11px; color: var(--text-muted);">S.lượng: <?= isset($acc['stock']) ? $acc['stock'] : 1; ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; flex-direction: column;">
                                                <b style="color: var(--color-secondary);"><?= number_format($acc['price'], 0, ',', '.'); ?>đ</b>
                                                <?php if($acc['old_price'] > 0): ?>
                                                    <span style="font-size: 11px; text-decoration: line-through; color: var(--text-muted);"><?= number_format($acc['old_price'], 0, ',', '.'); ?>đ</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="acc-details-wrapper" style="margin-top: 0; padding: 8px 12px; display: flex; flex-direction: column; gap: 4px;">
                                                <div>U: <span class="cred-text" data-val="<?= htmlspecialchars($acc['game_username']); ?>">••••••</span></div>
                                                <div>P: <span class="cred-text" data-val="<?= htmlspecialchars($acc['game_password']); ?>">••••••</span></div>
                                                <button type="button" onclick="toggleCredentials(this)" class="btn btn-secondary btn-sm" style="padding: 2px 8px; font-size: 10px; margin-top: 4px; align-self: start;">
                                                    <i class="fa-solid fa-eye"></i> Hiện
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($acc['status'] == 'available'): ?>
                                                <span class="badge badge-success">Còn hàng</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Đã bán</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 8px; justify-content: center;">
                                                <a href="<?= BASEURL; ?>/admin/editAccount/<?= $acc['id']; ?>" class="btn btn-secondary btn-sm" title="Chỉnh sửa">
                                                    <i class="fa-solid fa-pen" style="color: var(--color-secondary);"></i> Sửa
                                                </a>
                                                <a href="<?= BASEURL; ?>/admin/deleteAccount/<?= $acc['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');" title="Xóa">
                                                    <i class="fa-solid fa-trash"></i> Xóa
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" style="text-align: center; color: var(--text-muted); padding: 30px;">Không có tài khoản nào. Hãy click "Đăng Nick Mới" để đăng bán nick đầu tiên!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

            <!-- Page-specific script -->
            <script>
                function toggleAddForm() {
                    const card = document.getElementById('add-account-card');
                    const btn = document.getElementById('btn-toggle-form');
                    if (card.style.display === 'none') {
                        card.style.display = 'block';
                        btn.innerHTML = '<i class="fa-solid fa-minus"></i> Hủy Đăng';
                        btn.classList.replace('btn-primary', 'btn-secondary');
                        card.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        card.style.display = 'none';
                        btn.innerHTML = '<i class="fa-solid fa-plus"></i> Đăng Nick Mới';
                        btn.classList.replace('btn-secondary', 'btn-primary');
                    }
                }

                function toggleCredentials(btn) {
                    const parent = btn.parentElement;
                    const sps = parent.querySelectorAll('.cred-text');
                    const isHidden = btn.innerText.includes('Hiện');
                    
                    sps.forEach(sp => {
                        if (isHidden) {
                            sp.innerText = sp.getAttribute('data-val');
                        } else {
                            sp.innerText = '••••••';
                        }
                    });
                    
                    if (isHidden) {
                        btn.innerHTML = '<i class="fa-solid fa-eye-slash"></i> Ẩn';
                    } else {
                        btn.innerHTML = '<i class="fa-solid fa-eye"></i> Hiện';
                    }
                }

                function toggleAll(source) {
                    const checkboxes = document.querySelectorAll('.chk-acc');
                    checkboxes.forEach(chk => {
                        chk.checked = source.checked;
                    });
                    updateBulkCount();
                }

                function updateBulkCount() {
                    const checkedBoxes = document.querySelectorAll('.chk-acc:checked');
                    const count = checkedBoxes.length;
                    document.getElementById('bulk-count').innerText = count;
                    
                    if (count > 0) {
                        document.getElementById('btn-bulk-delete').style.display = 'inline-block';
                    } else {
                        document.getElementById('btn-bulk-delete').style.display = 'none';
                    }
                }

                function submitBulkDelete() {
                    const checkedBoxes = document.querySelectorAll('.chk-acc:checked');
                    if (checkedBoxes.length === 0) {
                        alert('Vui lòng chọn ít nhất 1 tài khoản để xóa!');
                        return;
                    }
                    if (confirm('Bạn có chắc chắn muốn XÓA VĨNH VIỄN ' + checkedBoxes.length + ' tài khoản đã chọn?')) {
                        document.getElementById('bulkDeleteForm').submit();
                    }
                }
            </script>

        </div> <!-- /content-area -->
    </div> <!-- /main-content -->
</body>
</html>
