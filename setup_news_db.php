<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'shopaccgame';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Create News Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS news (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) NOT NULL UNIQUE,
        image_url VARCHAR(255) DEFAULT NULL,
        summary TEXT,
        content LONGTEXT,
        category VARCHAR(100) DEFAULT 'Uy tín của shop',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Table 'news' created successfully or already exists.<br>";

    // 2. Insert sample news articles if empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM news");
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $articles = [
            [
                'title' => 'ShopMCuong - Chuyên Bán Nick Game Liên Quân và Free Fire Uy Tín',
                'slug' => 'shopmcuong-chuyen-ban-nick-game-lien-quan-va-free-fire-uy-tin',
                'image_url' => 'news_shopmcuong.png',
                'summary' => 'ShopMCuong - Chuyên Bán Nick Game Liên Quân và Free Fire Uy Tín. ShopMCuong.com là nơi bạn có thể tìm thấy những nick game Liên Quân và Free...',
                'content' => '<h3>ShopMCuong - Địa chỉ mua bán nick Liên Quân & Free Fire uy tín hàng đầu</h3><p>ShopMCuong.com tự hào là điểm đến tin cậy của hàng nghìn game thủ trên khắp cả nước. Chúng tôi cung cấp các dịch vụ đa dạng bao gồm:</p><ul><li>Bán nick Liên Quân Mobile giá rẻ, acc có nhiều tướng và skin hot.</li><li>Bán nick Free Fire cực ngon, đầy đủ các loại súng nâng cấp.</li><li>Túi mù thử vận may với cơ hội trúng acc VIP cực cao chỉ với 1.000đ, 20.000đ.</li></ul><p>Đến với ShopMCuong.com, bạn hoàn toàn có thể yên tâm về chất lượng giao dịch tự động, nhanh chóng và chế độ bảo hành tài khoản trọn đời.</p>',
                'category' => 'Uy tín của shop',
                'created_at' => '2026-03-04 14:08:05'
            ],
            [
                'title' => 'Cách Nhận Nick Free Fire Miễn Phí Và Tránh Bị Lừa Đảo',
                'slug' => 'cach-nhan-nick-free-fire-mien-phi-va-tranh-bi-lua-dao',
                'image_url' => 'menugame/Hinh-nen-free-fire-3d-huyen-thoai.jpg',
                'summary' => 'Tìm hiểu các phương pháp nhận tài khoản Free Fire miễn phí an toàn, và cách phòng tránh các website lừa đảo chiếm đoạt tài khoản game của bạn.',
                'content' => '<p>Hiện nay có rất nhiều trang web giả mạo tặng nick Free Fire miễn phí để lừa đảo thông tin người dùng. Hãy cùng ShopGaming tìm hiểu cách bảo vệ tài khoản của bạn khỏi các chiêu trò lừa đảo tinh vi...</p><h4>Cách nhận diện trang web lừa đảo:</h4><ul><li>Yêu cầu nhập mật khẩu tài khoản Garena hoặc Facebook trực tiếp trên các web lạ không thuộc Garena.</li><li>Hứa hẹn tặng vật phẩm, kim cương số lượng lớn miễn phí.</li><li>Giao diện web sơ sài, sai chính tả, không có mã số thuế hoặc thông tin liên hệ rõ ràng.</li></ul>',
                'category' => 'Hướng dẫn',
                'created_at' => '2026-03-05 09:30:15'
            ],
            [
                'title' => 'Bí Quyết Mua Túi Mù Tỷ Lệ Trúng Nick VIP Cao Nhất',
                'slug' => 'bi-quyet-mua-tui-mu-ty-le-trung-nick-vip-cao-nhat',
                'image_url' => 'menugame/3.jpg',
                'summary' => 'Chia sẻ kinh nghiệm săn túi mù Liên Quân và Free Fire tại ShopGaming để dễ dàng nhận được nick có tướng và trang phục giới hạn siêu xịn.',
                'content' => '<p>Túi mù đang là trào lưu cực hot tại ShopGaming với mức giá siêu hạt dẻ chỉ từ 1.000đ. Để gia tăng tỷ lệ mở được tài khoản ngon, bạn nên tham khảo các khung giờ vàng và mẹo lựa chọn dưới đây.</p><h4>Mẹo nhỏ cho game thủ:</h4><ol><li><strong>Mua số lượng lớn cùng lúc:</strong> Thay vì mua lẻ tẻ, hãy mua theo combo từ 5-10 túi để tăng cơ hội trúng acc ngon.</li><li><strong>Săn giờ vàng:</strong> Các khung giờ 12h trưa hoặc 20h tối là thời điểm admin cập nhật thêm acc VIP vào hệ thống.</li><li><strong>Đọc kỹ mô tả:</strong> Mỗi loại túi mù đều có tỷ lệ trúng và danh sách phần quà khác nhau.</li></ol>',
                'category' => 'Kinh nghiệm chơi',
                'created_at' => '2026-03-06 18:24:40'
            ]
        ];

        $ins = $pdo->prepare("INSERT INTO news (title, slug, image_url, summary, content, category, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($articles as $art) {
            $ins->execute([
                $art['title'],
                $art['slug'],
                $art['image_url'],
                $art['summary'],
                $art['content'],
                $art['category'],
                $art['created_at']
            ]);
        }
        echo "Sample news posts inserted successfully!<br>";
    } else {
        echo "News table already contains data.<br>";
    }

    echo "<h3>All done! News database set up successfully.</h3>";
    echo "<a href='public/'>Go to Homepage</a>";

} catch (PDOException $e) {
    die("DB SETUP FAILED: " . $e->getMessage());
}
?>
