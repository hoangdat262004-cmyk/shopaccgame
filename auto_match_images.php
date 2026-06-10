<?php
require_once __DIR__ . '/app/config/config.php';

function removeVietnameseAccents($str) {
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach($unicode as $nonUnicode=>$uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    return strtolower(trim($str));
}

function getFilesRecursively($dir, &$results = array()) {
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            // Only images
            if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $path)) {
                $results[] = $path;
            }
        } else if ($value != "." && $value != "..") {
            getFilesRecursively($path, $results);
        }
    }
    return $results;
}

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $dbh = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $uploadsDir = __DIR__ . '/public/uploads';
    $allFiles = getFilesRecursively($uploadsDir);
    
    // Create an array of normalized filenames and relative paths
    $filePool = [];
    foreach ($allFiles as $filePath) {
        $relativePath = str_replace($uploadsDir . DIRECTORY_SEPARATOR, '', $filePath);
        $relativePath = str_replace('\\', '/', $relativePath); // normalize slashes
        
        $basename = pathinfo($filePath, PATHINFO_FILENAME);
        // remove common prefixes like numbers "1779355908_"
        $basename = preg_replace('/^\d+(_|-)/', '', $basename);
        
        $normalized = removeVietnameseAccents($basename);
        // Remove spaces and punctuation for strict matching
        $strictNormalized = preg_replace('/[^a-z0-9]/', '', $normalized);
        
        $filePool[] = [
            'path' => $relativePath,
            'basename' => $basename,
            'normalized' => $normalized,
            'strict' => $strictNormalized
        ];
    }

    echo "Found " . count($filePool) . " images in uploads.\n";

    function findBestMatch($searchName, $filePool) {
        $normalizedSearch = removeVietnameseAccents($searchName);
        $strictSearch = preg_replace('/[^a-z0-9]/', '', $normalizedSearch);
        
        // 1. Exact match in strict string
        foreach ($filePool as $f) {
            if ($strictSearch === $f['strict'] || $f['strict'] === $strictSearch) {
                return $f['path'];
            }
        }
        
        // 2. Substring match
        foreach ($filePool as $f) {
            if (strlen($f['strict']) > 3 && strpos($strictSearch, $f['strict']) !== false) {
                return $f['path'];
            }
            if (strlen($strictSearch) > 3 && strpos($f['strict'], $strictSearch) !== false) {
                return $f['path'];
            }
        }

        // 3. Keyword match (highest similarity)
        $bestMatch = null;
        $highestScore = 0;
        foreach ($filePool as $f) {
            similar_text($normalizedSearch, $f['normalized'], $percent);
            if ($percent > $highestScore && $percent > 50) { // at least 50% similar
                $highestScore = $percent;
                $bestMatch = $f['path'];
            }
        }
        
        return $bestMatch;
    }

    // Process Categories
    $stmt = $dbh->query("SELECT id, name FROM categories");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $catUpdated = 0;
    foreach ($categories as $cat) {
        $match = findBestMatch($cat['name'], $filePool);
        if ($match) {
            $dbh->prepare("UPDATE categories SET image_url = ? WHERE id = ?")->execute([$match, $cat['id']]);
            echo "Category: {$cat['name']} => Matched: {$match}\n";
            $catUpdated++;
        } else {
            echo "Category: {$cat['name']} => NO MATCH\n";
        }
    }

    // Process Accounts
    $stmt = $dbh->query("SELECT id, title FROM accounts");
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $accUpdated = 0;
    foreach ($accounts as $acc) {
        $match = findBestMatch($acc['title'], $filePool);
        if ($match) {
            $dbh->prepare("UPDATE accounts SET image_url = ? WHERE id = ?")->execute([$match, $acc['id']]);
            echo "Account [{$acc['id']}]: {$acc['title']} => Matched: {$match}\n";
            $accUpdated++;
        } else {
            echo "Account [{$acc['id']}]: {$acc['title']} => NO MATCH\n";
        }
    }

    echo "\nDone! Updated $catUpdated categories and $accUpdated accounts.\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
