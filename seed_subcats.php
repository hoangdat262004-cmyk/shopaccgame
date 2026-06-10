<?php
require 'app/config/config.php';
require 'app/core/Database.php';

$db = new Database();

$sub_cats = [
    ['Nick Tự Chọn Siêu Rẻ', 'nick-tu-chon-sieu-re', 0, 0, '1779355908_Nick VIP.jpg'],
    ['Nick VIP', 'nick-vip', 0, 0, '1779355908_Nick VIP.jpg'],
    ['Nick Liên Quân REG', 'nick-lien-quan-reg', 0, 0, '1779355908_Nick VIP.jpg'],
    ['Túi Mù 1 Nghìn', 'tui-mu-1-nghin', 1000, 2000, 'menugame/Hinh-nen-free-fire-3d-huyen-thoai.jpg'],
    ['Túi Mù 20K', 'tui-mu-20k', 20000, 40000, 'menugame/Hinh-nen-free-fire-3d-huyen-thoai.jpg'],
    ['Túi Mù 99K', 'tui-mu-99k', 99000, 198000, '1779355920_Nick BLOX FRUITS.jpg'],
    ['Túi Mù 299K', 'tui-mu-299k', 299000, 598000, 'menugame/anh-linh-thu-dau-truong-chan-ly-1.jpg'],
    ['Túi mù 699K', 'tui-mu-699k', 699000, 1398000, 'menugame/7.jpg']
];

foreach ($sub_cats as $cat) {
    $db->query("INSERT INTO categories (name, slug, parent_id, price, old_price, image_url) VALUES (:name, :slug, 1, :price, :old_price, :img)");
    $db->bind(':name', $cat[0]);
    $db->bind(':slug', $cat[1]);
    $db->bind(':price', $cat[2]);
    $db->bind(':old_price', $cat[3]);
    $db->bind(':img', $cat[4]);
    $db->execute();
}
echo "Added sub-categories!";
