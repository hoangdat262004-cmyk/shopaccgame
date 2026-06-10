            <div style="max-width: 600px; margin: 0 auto;">
                <div class="card">
                    <div class="card-header-flex">
                        <h2><i class="fa-solid fa-pen-to-square color-accent-text"></i> Chỉnh Sửa Danh Mục</h2>
                        <a href="<?= BASEURL; ?>/admin/categories" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                    
                    <form action="<?= BASEURL; ?>/admin/editCategory/<?= $data['category']['id']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tên Danh Mục</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['category']['name']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Thư mục cha (Tùy chọn)</label>
                            <select name="parent_id" class="form-control">
                                <option value="">-- Không có (Thư mục gốc) --</option>
                                <?php foreach($data['parentCategories'] as $pCat): ?>
                                    <?php if($pCat['id'] != $data['category']['id']): // Prevent self-parenting ?>
                                        <option value="<?= $pCat['id'] ?>" <?= ($data['category']['parent_id'] == $pCat['id']) ? 'selected' : '' ?>><?= htmlspecialchars($pCat['name']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Đường dẫn tĩnh (Slug)</label>
                            <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($data['category']['slug']); ?>" placeholder="vd: lien-quan" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Hình Ảnh Hiện Tại</label>
                            <div style="margin: 10px 0;">
                                <?php if(!empty($data['category']['image_url'])): ?>
                                    <img src="<?= BASEURL; ?>/uploads/<?= $data['category']['image_url']; ?>" class="img-rounded" height="120" style="border: 2px solid var(--border-glass);">
                                <?php else: ?>
                                    <span style="color: var(--text-muted); font-style: italic;">Chưa có hình ảnh.</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Chọn Hình Ảnh Mới (Để trống nếu giữ nguyên)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        
                        <div style="display: flex; gap: 15px; margin-top: 25px;">
                            <button type="submit" class="btn btn-primary" style="flex: 1;">
                                <i class="fa-solid fa-save"></i> Lưu Thay Đổi
                            </button>
                            <a href="<?= BASEURL; ?>/admin/categories" class="btn btn-secondary" style="flex: 1;">
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
