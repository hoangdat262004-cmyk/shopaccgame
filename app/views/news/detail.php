<?php $post = $data['post']; ?>
<div class="news-page-container">
    <div class="news-main-content">
        <div class="news-breadcrumb">
            <a href="<?= BASEURL; ?>">Trang chủ</a> / <a href="<?= BASEURL; ?>/news">Tin tức</a> / <span>Chi tiết</span>
        </div>
        
        <h1 class="news-detail-title" style="margin-top: 10px; font-size: 26px; line-height: 1.3; color: #333; font-weight: 700;">
            <?= htmlspecialchars($post['title']); ?>
        </h1>
        
        <div class="news-detail-meta" style="margin: 15px 0 25px 0; font-size: 13px; color: #777; display: flex; gap: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <span>📅 Đăng ngày: <strong><?= htmlspecialchars($post['created_at']); ?></strong></span>
            <span>🏷️ Chuyên mục: <a href="<?= BASEURL; ?>/news?category=<?= urlencode($post['category']); ?>" style="color: #f44336; font-weight: bold;"><?= htmlspecialchars($post['category']); ?></a></span>
        </div>

        <div class="news-detail-body" style="font-size: 16px; line-height: 1.7; color: #444;">
            <?php 
                $img = htmlspecialchars($post['image_url']);
                $imgSrc = (strpos($img, 'http') === 0 || empty($img)) ? $img : BASEURL . '/uploads/' . $img;
            ?>
            <?php if (!empty($imgSrc)): ?>
                <div class="news-detail-img-wrapper" style="text-align: center; margin-bottom: 25px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <img src="<?= $imgSrc; ?>" alt="Article Image" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
                </div>
            <?php endif; ?>

            <div class="news-content-text">
                <?= $post['content']; ?>
            </div>
        </div>
        
        <div class="news-detail-footer" style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
            <a href="<?= BASEURL; ?>/news" class="btn-back-news" style="display: inline-block; background: #333; color: white; padding: 8px 18px; border-radius: 4px; font-weight: 500; font-size: 14px; text-decoration: none; transition: background 0.2s;">
                ← Quay lại danh sách
            </a>
            <div class="news-share-buttons" style="display: flex; gap: 8px; align-items: center;">
                <span style="font-size: 14px; color: #666;">Chia sẻ:</span>
                <a href="#" style="background: #3b5998; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-weight: bold; font-size: 14px;">f</a>
                <a href="#" style="background: #0088cc; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-weight: bold; font-size: 12px;">z</a>
            </div>
        </div>
    </div>

    <!-- Sidebar column -->
    <div class="news-sidebar">
        <h3 class="sidebar-title">DANH MỤC</h3>
        <ul class="sidebar-list">
            <?php foreach ($data['categories'] as $cat): ?>
                <li>
                    <a href="<?= BASEURL; ?>/news?category=<?= urlencode($cat['category']); ?>" class="<?= $post['category'] == $cat['category'] ? 'active' : ''; ?>">
                        » <?= htmlspecialchars($cat['category']); ?> (<?= $cat['news_count']; ?>)
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
