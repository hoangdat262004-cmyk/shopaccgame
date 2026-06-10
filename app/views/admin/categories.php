            <div style="display: grid; grid-template-columns: 1fr 1.8fr; gap: 30px;" class="form-row">
                
                <!-- Add Category Form -->
                <div class="card" style="align-self: start;">
                    <h2><i class="fa-solid fa-folder-plus color-accent-text"></i> Thêm Danh Mục</h2>
                    <p style="margin-bottom: 20px; font-size: 13px;">Tạo danh mục game mới cho shop.</p>
                    
                    <form action="<?= BASEURL; ?>/admin/categories" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tên Danh Mục</label>
                            <input type="text" name="name" class="form-control" placeholder="vd: Liên Quân Mobile" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Thư mục cha (Tùy chọn)</label>
                            <select name="parent_id" class="form-control">
                                <option value="">-- Không có (Thư mục gốc) --</option>
                                <?php foreach($data['parentCategories'] as $pCat): ?>
                                    <option value="<?= $pCat['id'] ?>"><?= htmlspecialchars($pCat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Đường dẫn tĩnh (Slug)</label>
                            <input type="text" name="slug" class="form-control" placeholder="vd: lien-quan" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Hình Ảnh</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">
                            <i class="fa-solid fa-plus"></i> Thêm Mới
                        </button>
                    </form>
                </div>

                <!-- Categories List -->
                <div class="card">
                    <h2><i class="fa-solid fa-folder-open color-secondary-text"></i> Danh Sách Danh Mục</h2>
                    <p style="margin-bottom: 20px; font-size: 13px;">Tất cả các tựa game hiện đang hiển thị trên trang chủ của shop.</p>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 60px;">ID</th>
                                    <th style="width: 100px;">Hình Ảnh</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Slug</th>
                                    <th style="width: 160px; text-align: center;">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data['categories'])): ?>
                                    <?php foreach($data['categories'] as $cat): ?>
                                    <?php 
                                        $img = !empty($cat['image_url']) ? $cat['image_url'] : ($cat['image'] ?? ''); 
                                        $img_src = (strpos($img, 'http') === 0) ? $img : BASEURL . '/uploads/' . $img;
                                    ?>
                                    <tr>
                                        <td><?= $cat['id']; ?></td>
                                        <td>
                                            <?php if(!empty($img)): ?>
                                                <img src="<?= $img_src; ?>" class="img-rounded" width="60" height="40" style="object-fit: cover;">
                                            <?php else: ?>
                                                <div style="width: 60px; height: 40px; background: rgba(255,255,255,0.05); border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa-solid fa-image" style="color: var(--text-muted);"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td style="font-weight: 500; font-size: 15px;">
                                            <?= htmlspecialchars($cat['name']); ?>
                                            <?php if (!empty($cat['parent_id'])): ?>
                                                <div style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">
                                                    <i class="fa-solid fa-turn-up fa-rotate-90"></i> Mục con
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><span style="color: var(--text-muted); font-size: 13px;"><?= htmlspecialchars($cat['slug']); ?></span></td>
                                        <td>
                                            <div style="display: flex; gap: 8px; justify-content: center;">
                                                <a href="<?= BASEURL; ?>/admin/editCategory/<?= $cat['id']; ?>" class="btn btn-secondary btn-sm" title="Chỉnh sửa">
                                                    <i class="fa-solid fa-pen" style="color: var(--color-secondary);"></i> Sửa
                                                </a>
                                                <a href="<?= BASEURL; ?>/admin/deleteCategory/<?= $cat['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Việc này sẽ xóa toàn bộ nick thuộc danh mục này.');" title="Xóa">
                                                    <i class="fa-solid fa-trash"></i> Xóa
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">Chưa có danh mục nào. Hãy tạo danh mục đầu tiên của bạn ở cột bên trái!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div> <!-- /content-area -->
    </div> <!-- /main-content -->
</body>
</html>
