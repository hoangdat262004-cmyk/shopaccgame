            <div style="max-width: 850px; margin: 0 auto;">
                <div class="card">
                    <div class="card-header-flex">
                        <h2><i class="fa-solid fa-gamepad color-accent-text"></i> Chỉnh Sửa Tài Khoản Game</h2>
                        <a href="<?= BASEURL; ?>/admin/accounts" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                    
                    <form action="<?= BASEURL; ?>/admin/editAccount/<?= $data['account']['id']; ?>" method="POST" enctype="multipart/form-data">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Danh Mục Game</label>
                                <select name="category_id" class="form-control" required>
                                <?php 
                                    $parents = [];
                                    $children = [];
                                    foreach($data['categories'] as $cat) {
                                        if(empty($cat['parent_id'])) {
                                            $parents[$cat['id']] = $cat;
                                        } else {
                                            $children[$cat['parent_id']][] = $cat;
                                        }
                                    }
                                    
                                    foreach($parents as $pid => $pcat): 
                                ?>
                                    <option value="<?= $pcat['id']; ?>" style="font-weight: bold; color: #dc2626;" <?= $pcat['id'] == $data['account']['category_id'] ? 'selected' : ''; ?>>▶ <?= htmlspecialchars($pcat['name']); ?> (Thư mục cha)</option>
                                    <?php if(isset($children[$pid])): ?>
                                        <?php foreach($children[$pid] as $ccat): ?>
                                            <option value="<?= $ccat['id']; ?>" <?= $ccat['id'] == $data['account']['category_id'] ? 'selected' : ''; ?>>&nbsp;&nbsp;&nbsp;&nbsp;↳ <?= htmlspecialchars($ccat['name']); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Trạng Thái</label>
                                <select name="status" class="form-control" required>
                                    <option value="available" <?= $data['account']['status'] === 'available' ? 'selected' : ''; ?>>Còn hàng (Available)</option>
                                    <option value="sold" <?= $data['account']['status'] === 'sold' ? 'selected' : ''; ?>>Đã bán (Sold)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($data['account']['title']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Mô tả / Thông tin chi tiết</label>
                            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($data['account']['description']); ?></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Giá bán (VNĐ)</label>
                                <input type="number" name="price" class="form-control" value="<?= (int)$data['account']['price']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Giá cũ (VNĐ) - Nếu có giảm giá</label>
                                <input type="number" name="old_price" class="form-control" value="<?= (int)$data['account']['old_price']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Số lượng (Stock)</label>
                                <input type="number" name="stock" class="form-control" value="<?= isset($data['account']['stock']) ? $data['account']['stock'] : 1; ?>" min="0" required>
                            </div>
                        </div>

                        <div class="form-row" style="background: rgba(255,255,255,0.02); padding: 20px; border-radius: var(--border-radius-md); border: 1px solid var(--border-glass);">
                            <div class="form-group">
                                <label style="color: var(--color-secondary);"><i class="fa-solid fa-user-lock"></i> Tài Khoản Game (Đăng nhập)</label>
                                <input type="text" name="account_username" class="form-control" value="<?= htmlspecialchars($data['account']['game_username']); ?>" style="border-color: rgba(6, 182, 212, 0.3);">
                            </div>
                            
                            <div class="form-group">
                                <label style="color: var(--color-secondary);"><i class="fa-solid fa-key"></i> Mật Khẩu Game</label>
                                <input type="text" name="account_password" class="form-control" value="<?= htmlspecialchars($data['account']['game_password']); ?>" style="border-color: rgba(6, 182, 212, 0.3);">
                            </div>
                        </div>
                        
                        <div class="form-row" style="background: rgba(255,255,255,0.01); padding: 15px; border-radius: var(--border-radius-md); border: 1px solid var(--border-glass); margin-top: 15px;">
                            <div class="form-group" style="margin-bottom: 0; width: 100%;">
                                <label style="color: var(--color-secondary);"><i class="fa-solid fa-list"></i> Danh sách tài khoản (Dành cho Túi Mù / Random)</label>
                                <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 10px;">
                                    Thêm từng tài khoản vào danh sách bên dưới. Hệ thống sẽ tự động gán vào các mã số Túi mù và cập nhật Số lượng tương ứng.
                                </p>
                                
                                <div id="dynamic-account-list">
                                    <?php if (!empty($data['code_details'])): ?>
                                        <?php foreach ($data['code_details'] as $detail): ?>
                                            <div class="account-row" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: center; flex-wrap: wrap;">
                                                <input type="text" name="list_username[]" class="form-control" value="<?= htmlspecialchars($detail['username']) ?>" placeholder="Tài khoản" style="flex: 1; border-color: rgba(6, 182, 212, 0.2); min-width: 150px;">
                                                <input type="text" name="list_password[]" class="form-control" value="<?= htmlspecialchars($detail['password']) ?>" placeholder="Mật khẩu" style="flex: 1; border-color: rgba(6, 182, 212, 0.2); min-width: 150px;">
                                                <input type="hidden" name="existing_list_image[]" value="<?= htmlspecialchars($detail['image_url'] ?? '') ?>">
                                                <div style="flex: 1; min-width: 150px; display: flex; align-items: center; gap: 5px;">
                                                    <?php if (!empty($detail['image_url'])): ?>
                                                        <img src="<?= BASEURL . '/uploads/' . $detail['image_url'] ?>" width="30" height="30" style="object-fit: cover; border-radius: 4px;">
                                                    <?php endif; ?>
                                                    <input type="file" name="list_image[]" class="form-control" accept="image/*" style="padding: 6px; width: 100%;">
                                                </div>
                                                <button type="button" class="btn btn-danger btn-sm remove-row" style="padding: 10px 15px;"><i class="fa-solid fa-trash"></i></button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <!-- First Row (Empty) -->
                                        <div class="account-row" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: center; flex-wrap: wrap;">
                                            <input type="text" name="list_username[]" class="form-control" placeholder="Tài khoản" style="flex: 1; border-color: rgba(6, 182, 212, 0.2); min-width: 150px;">
                                            <input type="text" name="list_password[]" class="form-control" placeholder="Mật khẩu" style="flex: 1; border-color: rgba(6, 182, 212, 0.2); min-width: 150px;">
                                            <input type="hidden" name="existing_list_image[]" value="">
                                            <input type="file" name="list_image[]" class="form-control" accept="image/*" style="flex: 1; min-width: 150px; padding: 6px;">
                                            <button type="button" class="btn btn-danger btn-sm remove-row" style="padding: 10px 15px;"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    <?php endif; ?>
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
                                            <input type="hidden" name="existing_list_image[]" value="">
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

                        <div class="form-group" style="margin-top: 20px;">
                            <label>Hình Ảnh Hiện Tại</label>
                            <div style="margin: 10px 0;">
                                <?php 
                                    $img = !empty($data['account']['image_url']) ? $data['account']['image_url'] : ($data['account']['image'] ?? ''); 
                                    $img_src = (strpos($img, 'http') === 0 || strpos($img, 'images/') === 0) ? BASEURL . '/../' . $img : BASEURL . '/uploads/' . $img;
                                    if (strpos($img, 'images/') === 0) {
                                        $img_src = BASEURL . '/../' . $img;
                                    }
                                ?>
                                <?php if(!empty($img)): ?>
                                    <img src="<?= $img_src; ?>" class="img-rounded" height="150" style="border: 2px solid var(--border-glass);">
                                <?php else: ?>
                                    <span style="color: var(--text-muted); font-style: italic;">Chưa có hình ảnh.</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Chọn Hình Ảnh Mới (Để trống nếu giữ nguyên)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        
                        <div style="display: flex; gap: 15px; margin-top: 30px;">
                            <button type="submit" class="btn btn-primary" style="flex: 1;">
                                <i class="fa-solid fa-save"></i> Lưu Thay Đổi
                            </button>
                            <a href="<?= BASEURL; ?>/admin/accounts" class="btn btn-secondary" style="flex: 1;">
                                Hủy Bỏ
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div> <!-- /content-area -->
    </div> <!-- /main-content -->
</body>
</html>
