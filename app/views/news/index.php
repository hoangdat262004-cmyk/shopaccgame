<div class="news-page-container">
    <div class="news-main-content">
        <h2 class="page-title">TIN TỨC</h2>
        
        <!-- Search bar layout -->
        <div class="news-search-box">
            <form action="<?= BASEURL; ?>/news" method="GET" style="display: flex; width: 100%; gap: 0;">
                <input type="text" name="search" placeholder="Nhập từ khóa..." value="<?= htmlspecialchars($data['current_search']); ?>" class="search-input">
                <button type="submit" class="btn-search-blue">Tìm kiếm</button>
                <a href="<?= BASEURL; ?>/news" class="btn-all-red">Tất cả</a>
            </form>
        </div>

        <!-- News list -->
        <div class="news-list">
            <?php if (empty($data['news'])): ?>
                <div class="no-news-found">
                    <p>Không tìm thấy tin tức nào khớp với từ khóa của bạn.</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['news'] as $post): ?>
                    <?php 
                        $img = htmlspecialchars($post['image_url']);
                        $imgSrc = (strpos($img, 'http') === 0 || empty($img)) ? $img : BASEURL . '/uploads/' . $img;
                        if (empty($imgSrc)) {
                            $imgSrc = 'https://picsum.photos/400/200?random=' . $post['id'];
                        }
                    ?>
                    <div class="news-card">
                        <div class="news-card-img">
                            <a href="<?= BASEURL; ?>/news/detail/<?= $post['slug']; ?>">
                                <img src="<?= $imgSrc; ?>" alt="Thumbnail">
                            </a>
                        </div>
                        <div class="news-card-body">
                            <h3 class="news-card-title">
                                <a href="<?= BASEURL; ?>/news/detail/<?= $post['slug']; ?>">
                                    <?= htmlspecialchars($post['title']); ?>
                                </a>
                            </h3>
                            <p class="news-card-summary">
                                <?= htmlspecialchars($post['summary']); ?>
                            </p>
                            <span class="news-card-date">
                                <?= htmlspecialchars($post['created_at']); ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar column -->
    <div class="news-sidebar">
        <h3 class="sidebar-title">DANH MỤC</h3>
        <ul class="sidebar-list">
            <?php foreach ($data['categories'] as $cat): ?>
                <li>
                    <a href="<?= BASEURL; ?>/news?category=<?= urlencode($cat['category']); ?>" class="<?= $data['current_category'] == $cat['category'] ? 'active' : ''; ?>">
                        » <?= htmlspecialchars($cat['category']); ?> (<?= $cat['news_count']; ?>)
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
