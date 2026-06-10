<?php
$brainDir = 'C:\Users\thanh\.gemini\antigravity\brain\2d8f076f-a74c-4fee-83c8-7bba1fb1bb11\\';
$mockImage = $brainDir . 'media__1779332842870.png';

if (!file_exists($mockImage)) {
    // try the other one if this doesn't exist
    $mockImage = $brainDir . 'media__1779333074361.png';
}

echo "Using image: $mockImage\n";

$img = imagecreatefrompng($mockImage);
if (!$img) {
    die("Failed to open image\n");
}

$width = imagesx($img);
$height = imagesy($img);

// Let's find the bounding box of the colorful thumbnail on the left
// The search bar is at the top, thumbnail is below it (y > 70) and on the left (x < 500)
// Thumbnail is dark/colorful, surrounded by white/light gray background (#f5f5f5 or #ffffff)
$min_x = $width;
$max_x = 0;
$min_y = $height;
$max_y = 0;

for ($y = 70; $y < $height; $y++) {
    for ($x = 100; $x < 400; $x++) {
        $rgb = imagecolorat($img, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        
        // If the pixel is NOT white/light-gray (background is typically > 240, 240, 240)
        // AND it's not pure black text (r,g,b < 50)
        // Let's check for colorful/dark gaming banner pixels
        if (!($r > 240 && $g > 240 && $b > 240) && !($r < 50 && $g < 50 && $b < 50)) {
            if ($x < $min_x) $min_x = $x;
            if ($x > $max_x) $max_x = $x;
            if ($y < $min_y) $min_y = $y;
            if ($y > $max_y) $max_y = $y;
        }
    }
}

echo "Detected thumbnail bounding box: X: $min_x to $max_x, Y: $min_y to $max_y\n";

// Let's adjust bounding box to be realistic
// If detection failed or was too broad, let's use standard coordinates
if ($max_x - $min_x < 50 || $max_y - $min_y < 50) {
    echo "Detection too small, using fallback coordinates\n";
    $min_x = 138;
    $min_y = 80;
    $max_x = 288;
    $max_y = 180;
}

$crop_w = $max_x - $min_x + 1;
$crop_h = $max_y - $min_y + 1;

echo "Cropping dimensions: {$crop_w}x{$crop_h} at ($min_x, $min_y)\n";

$thumb = imagecreatetruecolor($crop_w, $crop_h);
imagecopy($thumb, $img, 0, 0, $min_x, $min_y, $crop_w, $crop_h);

$destPath = 'd:\XAmpp\htdocs\shopaccgame\public\uploads\news_shopmcuong.png';
imagepng($thumb, $destPath);
imagedestroy($thumb);
imagedestroy($img);

echo "Successfully saved cropped thumbnail to: $destPath\n";
?>
