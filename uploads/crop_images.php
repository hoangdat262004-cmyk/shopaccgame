<?php
$brainDir = 'C:\Users\thanh\.gemini\antigravity\brain\2d8f076f-a74c-4fee-83c8-7bba1fb1bb11\\';
$files = glob($brainDir . '*.png');

echo "Found files:\n";
foreach ($files as $filepath) {
    $filename = basename($filepath);
    $size = getimagesize($filepath);
    if ($size) {
        echo "$filename: {$size[0]}x{$size[1]} (type: {$size['mime']})\n";
    } else {
        echo "$filename: failed to get image size\n";
    }
}
?>
