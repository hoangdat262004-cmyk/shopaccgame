<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=shopaccgame;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // List of updates: title => [stock, price, old_price] for category_id = 1
    $updates = [
        'Nick Tự Chọn Siêu Rẻ' => [266, 0, 0],
        'Nick VIP'             => [152, 0, 0],
        'Nick Liên Quân REG'   => [52, 0, 0],
        'Túi Mù 1 Nghìn'       => [1183, 1000, 2000],
        'Túi Mù 20K'           => [198, 20000, 40000],
        'Túi Mù 99K'           => [0, 99000, 198000],
        'Túi Mù 299K'          => [16, 299000, 598000],
        'Túi mù 699K'          => [18, 699000, 1398000]
    ];

    $stmt = $pdo->prepare("UPDATE accounts SET stock = ?, price = ?, old_price = ? WHERE category_id = 1 AND title = ?");
    
    foreach ($updates as $title => $data) {
        $stmt->execute([$data[0], $data[1], $data[2], $title]);
        echo "Updated '{$title}': Stock = {$data[0]}, Price = {$data[1]}, Old Price = {$data[2]}\n";
    }

    echo "\nLiên Quân accounts updated successfully!\n";

} catch (PDOException $e) {
    echo "DATABASE ERROR: " . $e->getMessage() . "\n";
}
?>
