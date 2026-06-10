<?php
class Account extends Controller {
    private function getCodeImage($accountId, $code, $defaultImage, $accountTitle) {
        // First check if there is an exact match file in uploads like 7652.jpg or 7652.png
        $check_files = [
            "public/uploads/{$code}.jpg",
            "public/uploads/{$code}.png",
            "public/uploads/images/{$code}.jpg",
            "public/uploads/images/{$code}.png",
            "public/uploads/codes/{$code}.jpg",
            "public/uploads/codes/{$code}.png"
        ];
        foreach ($check_files as $f) {
            $abs = $_SERVER['DOCUMENT_ROOT'] . '/shopaccgame/' . $f;
            if (file_exists($abs)) {
                return str_replace('public/uploads/', '', $f);
            }
            $local_abs = __DIR__ . '/../../' . $f;
            if (file_exists($local_abs)) {
                return str_replace('public/uploads/', '', $f);
            }
        }

        // Specific overrides for specific accounts
        if ($accountId == 75) {
            return 'Acc-Blox-Fruit-Vip.jpg';
        }
        if ($accountId == 77) {
            return 'ACC DRACO.jpg';
        }
        if ($accountId == 30) {
            return 'Nick Tự Chọn Siêu Rẻ.jpg';
        }

        // If not, use deterministic fallback based on category / title
        $titleLower = strtolower($accountTitle);
        if (strpos($titleLower, 'liên quân') !== false || $accountId == 32 || $accountId == 31 || $accountId == 30) {
            $lq_pool = [
                'LIENQUANRAMDOM/1.jpg',
                'LIENQUANRAMDOM/2.jpg',
                'LIENQUANRAMDOM/3.jpg',
                'LIENQUANRAMDOM/4.jpg',
                'LIENQUAN.jpg/1.jpg',
                'LIENQUAN.jpg/2.jpg',
                'LIENQUAN.jpg/3.jpg',
                'LIENQUAN.jpg/4.jpg',
                'LIENQUAN.jpg/5.jpg',
                'LIENQUANRAMDOM/50k.jpg',
                'LIENQUANRAMDOM/100k.jpg',
                'LIENQUANRAMDOM/200k.jpg',
                'LIENQUANRAMDOM/20k.jpg'
            ];
            $idx = ($code * 3) % count($lq_pool);
            return $lq_pool[$idx];
        } else if (strpos($titleLower, 'free fire') !== false || strpos($titleLower, 'ff') !== false) {
            return 'random_ff_banner.png';
        } else if (strpos($titleLower, 'roblox') !== false || strpos($titleLower, 'robox') !== false || strpos($titleLower, 'blox fruit') !== false) {
            $rb_pool = [
                'BLOX FRUITS.jpg/1.jpg',
                'BLOX FRUITS.jpg/2.jpg',
                'BLOX FRUITS.jpg/3.jpg',
                'BLOX FRUITS.jpg/4.jpg',
                'BLOX FRUITS.jpg/5.jpg',
                'BLOX FRUITS.jpg/6.jpg',
                'BLOX FRUITS.jpg/7.jpg'
            ];
            $idx = ($code * 3) % count($rb_pool);
            return $rb_pool[$idx];
        } else if (strpos($titleLower, 'liên minh') !== false || strpos($titleLower, 'tft') !== false) {
            $lm_pool = [
                'DTCL_LIENMINH_VALORANT/1.jpg',
                'DTCL_LIENMINH_VALORANT/2.jpg',
                'DTCL_LIENMINH_VALORANT/3.jpg',
                'DTCL_LIENMINH_VALORANT/4.jpg',
                'DTCL_LIENMINH_VALORANT/5.jpg',
                'DTCL_LIENMINH_VALORANT/6.jpg',
                'DTCL_LIENMINH_VALORANT/7.jpg'
            ];
            $idx = ($code * 3) % count($lm_pool);
            return $lm_pool[$idx];
        }

        return $defaultImage;
    }

    private function getCodeDetails($accountId, $code, $basePrice, $accountTitle) {
        $isBlindBag = (stripos($accountTitle, 'Túi Mù') !== false);
        $defaultImg = 'LIENQUANRAMDOM/3.jpg';
        $img = $this->getCodeImage($accountId, $code, $defaultImg, $accountTitle);
        
        if ($isBlindBag) {
            // All codes in blind bag have the same price as the base product price
            return [
                'price' => $basePrice,
                'old_price' => 0,
                'title' => 'Túi Mù May Mắn #' . $code,
                'is_blind_bag' => true,
                'image_url' => $img
            ];
        }

        // If not a blind bag, it's a self-select account list (Tự Chọn)
        // Let's implement the specific presets for Nick Liên Quân REG (ID: 32)
        if ($accountId == 32 || stripos($accountTitle, 'REG') !== false) {
            $reg_preset = [
                7652 => ['price' => 400000, 'old_price' => 0],
                7651 => ['price' => 620000, 'old_price' => 0],
                7650 => ['price' => 600000, 'old_price' => 0],
                4891 => ['price' => 200000, 'old_price' => 0],
                4890 => ['price' => 2300000, 'old_price' => 0],
                4885 => ['price' => 1200000, 'old_price' => 0],
                4694 => ['price' => 840000, 'old_price' => 1200000],
                4693 => ['price' => 617500, 'old_price' => 650000],
                606  => ['price' => 450000, 'old_price' => 600000],
                554  => ['price' => 1620000, 'old_price' => 2000000],
                469  => ['price' => 40000, 'old_price' => 0],
                468  => ['price' => 240000, 'old_price' => 400000],
                467  => ['price' => 400000, 'old_price' => 0],
                466  => ['price' => 180000, 'old_price' => 0],
                465  => ['price' => 200000, 'old_price' => 0],
                464  => ['price' => 200000, 'old_price' => 0]
            ];
            
            if (isset($reg_preset[$code])) {
                return [
                    'price' => $reg_preset[$code]['price'],
                    'old_price' => $reg_preset[$code]['old_price'],
                    'title' => 'Tài khoản REG #' . $code,
                    'is_blind_bag' => false,
                    'image_url' => $img
                ];
            }
            
            // Deterministic generation for other codes in REG
            $seed = ($code * 17) % 100;
            if ($seed < 10) {
                $price = 40000;
                $old_price = 0;
            } else if ($seed < 30) {
                $price = 180000;
                $old_price = 0;
            } else if ($seed < 60) {
                $price = 200000;
                $old_price = 0;
            } else if ($seed < 80) {
                $price = 400000;
                $old_price = 0;
            } else {
                $price = 600000;
                $old_price = 800000;
            }
            return [
                'price' => $price,
                'old_price' => $old_price,
                'title' => 'Tài khoản REG #' . $code,
                'is_blind_bag' => false,
                'image_url' => 'gojo.jpg'
            ];
        }

        // For Nick VIP (ID: 31 or containing 'VIP')
        if ($accountId == 31 || stripos($accountTitle, 'VIP') !== false) {
            $seed = ($code * 31) % 100;
            if ($seed < 20) {
                $price = 300000;
                $old_price = 500000;
            } else if ($seed < 50) {
                $price = 500000;
                $old_price = 800000;
            } else if ($seed < 80) {
                $price = 800000;
                $old_price = 1200000;
            } else {
                $price = 1500000;
                $old_price = 2500000;
            }
            return [
                'price' => $price,
                'old_price' => $old_price,
                'title' => 'Tài khoản VIP #' . $code,
                'is_blind_bag' => false,
                'image_url' => 'nick_vip_skins.jpg'
            ];
        }

        // For Nick Tự Chọn Siêu Rẻ and Free Fire Tự Chọn
        if ($accountId == 30 || stripos($accountTitle, 'Siêu Rẻ') !== false || stripos($accountTitle, 'Tự Chọn') !== false) {
            $seed = ($code * 7) % 100;
            if ($seed < 40) {
                $price = 20000;
                $old_price = 0;
            } else if ($seed < 70) {
                $price = 35000;
                $old_price = 50000;
            } else {
                $price = 50000;
                $old_price = 80000;
            }
            
            $isFF = (stripos($accountTitle, 'Free Fire') !== false || stripos($accountTitle, 'FF') !== false);
            
            return [
                'price' => $price,
                'old_price' => $old_price,
                'title' => $isFF ? 'Tài khoản FF Tự Chọn #' . $code : 'Tài khoản Siêu Rẻ #' . $code,
                'is_blind_bag' => false,
                'image_url' => $img // Use the generic fallback which we'll pass in, or just don't set it and let the view use the parent
            ];
        }

        // General fallback for any other self-select multi-stock product
        $seed = ($code * 13) % 100;
        $price = 100000 + ($seed * 5000); // 100k to 600k
        $old_price = $price + 50000;
        
        // Use anime_dragon.jpg if the title contains Dragon
        if (stripos($accountTitle, 'Dragon') !== false || stripos($accountTitle, 'Anime') !== false) {
            $img = 'anime_dragon.jpg';
        }
        
        return [
            'price' => $price,
            'old_price' => $old_price,
            'title' => 'Tài khoản #' . $code,
            'is_blind_bag' => false,
            'image_url' => $img
        ];
    }

    public function detail($id = '') {
        if(empty($id)) {
            header('Location: ' . BASEURL);
            exit;
        }

        $accountModel = $this->model('AccountModel');
        $account = $accountModel->getAccountById($id);

        if(!$account) {
            header('Location: ' . BASEURL);
            exit;
        }

        $isMultipleStock = (stripos($account['title'], 'Túi Mù') !== false || $account['stock'] > 1);

        if ($isMultipleStock) {
            $code = isset($_GET['code']) ? trim($_GET['code']) : '';
            if (empty($code)) {
                // Listing of all items
                $data['title'] = $account['title'] . ' - Chọn mã số tài khoản';
                $data['account'] = $account;
                
                // Get page parameter
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                if ($page < 1) $page = 1;
                $limit = 24;
                
                // Get filter values
                $search_id = isset($_GET['search_id']) ? trim($_GET['search_id']) : '';
                $sort_by = isset($_GET['sort_by']) ? trim($_GET['sort_by']) : 'newest';
                
                $stock = $account['stock'];
                $all_codes = [];

                if ($account['id'] == 32 || stripos($account['title'], 'REG') !== false) {
                    // Nick Liên Quân REG preset codes from user request
                    $presets = [7652, 7651, 7650, 4891, 4890, 4885, 4694, 4693, 606, 554, 469, 468, 467, 466, 465, 464];
                    $all_codes = $presets;
                    
                    // Generate remaining codes to fill up to stock count
                    $base = 6000 + ($account['id'] % 20) * 150 + max($stock, 100) * 2;
                    $count = count($all_codes);
                    for ($i = $base; $i >= 1000; $i--) {
                        if (in_array($i, $presets)) {
                            continue;
                        }
                        if ($i % 13 == 0 || $i % 19 == 0 || $i % 23 == 0) {
                            continue;
                        }
                        $all_codes[] = $i;
                        $count++;
                        if ($count >= max($stock, 100)) {
                            break;
                        }
                    }
                } else {
                    $base = 6000 + ($account['id'] % 20) * 150 + max($stock, 100) * 2;
                    $count = 0;
                    for ($i = $base; $i >= 1000; $i--) {
                        if ($i % 13 == 0 || $i % 19 == 0 || $i % 23 == 0) {
                            continue;
                        }
                        $all_codes[] = $i;
                        $count++;
                        if ($count >= max($stock, 100)) {
                            break;
                        }
                    }
                }
                
                // Apply Search ID filter
                if (!empty($search_id)) {
                    $search_id_int = (int)$search_id;
                    if ($search_id_int > 0) {
                        $all_codes = [$search_id_int];
                    } else {
                        $all_codes = [];
                    }
                }
                
                // Apply Sort
                if ($sort_by == 'oldest') {
                    sort($all_codes);
                } else {
                    rsort($all_codes);
                }
                
                // Pagination
                $total_items = count($all_codes);
                $total_pages = ceil($total_items / $limit);
                if ($total_pages < 1) $total_pages = 1;
                if ($page > $total_pages) $page = $total_pages;
                
                $offset = ($page - 1) * $limit;
                $data['codes'] = array_slice($all_codes, $offset, $limit);
                $data['page'] = $page;
                $data['total_pages'] = $total_pages;
                $data['search_id'] = $search_id;
                $data['sort_by'] = $sort_by;
                
                // Generate details for each code
                $data['codes_details'] = [];
                foreach ($data['codes'] as $c) {
                    $data['codes_details'][$c] = $this->getCodeDetails($account['id'], $c, $account['price'], $account['title']);
                    if (!empty($account['image_url']) && strpos($account['image_url'], 'placeholder.com') === false) {
                        $data['codes_details'][$c]['image_url'] = $account['image_url'];
                    }
                }
                
                // Fetch database code details (rank, skins, heroes, image)
                $data['db_code_details'] = [];
                foreach ($data['codes'] as $c) {
                    $dbDetail = $accountModel->getCodeDetail($account['id'], $c);
                    if ($dbDetail) {
                        $data['db_code_details'][$c] = $dbDetail;
                        // Override image_url from database if available
                        if (!empty($dbDetail['image_url'])) {
                            $data['codes_details'][$c]['image_url'] = $dbDetail['image_url'];
                        }
                    }
                }
                
                $this->view('templates/header', $data);
                $this->view('account/blind_bag', $data);
                $this->view('templates/footer');
            } else {
                // Show single confirmation page
                $data['title'] = 'Mua ' . $account['title'] . ' #' . $code;
                $data['account'] = $account;
                $data['code'] = $code;
                $data['code_detail'] = $this->getCodeDetails($account['id'], $code, $account['price'], $account['title']);
                if (!empty($account['image_url']) && strpos($account['image_url'], 'placeholder.com') === false) {
                    $data['code_detail']['image_url'] = $account['image_url'];
                }
                
                // Fetch database code details (rank, skins, heroes, image)
                $dbDetail = $accountModel->getCodeDetail($account['id'], $code);
                $data['db_code_detail'] = $dbDetail ? $dbDetail : null;
                if ($dbDetail && !empty($dbDetail['image_url'])) {
                    $data['code_detail']['image_url'] = $dbDetail['image_url'];
                }
                
                $this->view('templates/header', $data);
                $this->view('account/blind_bag_detail', $data);
                $this->view('templates/footer');
            }
        } else {
            $data['title'] = 'Chi tiết Nick #' . $account['id'];
            $data['account'] = $account;

            $this->view('templates/header', $data);
            $this->view('account/detail', $data);
            $this->view('templates/footer');
        }
    }

    public function buy($id = '') {
        if($_SERVER['REQUEST_METHOD'] != 'POST' || empty($id)) {
            header('Location: ' . BASEURL);
            exit;
        }

        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $accountModel = $this->model('AccountModel');
        $userModel = $this->model('UserModel');
        $transactionModel = $this->model('TransactionModel');

        $account = $accountModel->getAccountById($id);
        $user = $userModel->getUserById($user_id);

        if($account && $account['status'] == 'available') {
            // Is it multiple stock (blind bag or random batch)?
            $isMultipleStock = (stripos($account['title'], 'Túi Mù') !== false || $account['stock'] > 1);
            $code = isset($_GET['code']) ? trim($_GET['code']) : '';

            $price = $account['price'];
            $codeDetail = null;
            if ($isMultipleStock && !empty($code)) {
                $codeDetail = $this->getCodeDetails($account['id'], $code, $account['price'], $account['title']);
                $price = $codeDetail['price'];
            }

            if($user['balance'] >= $price) {
                $new_balance = $user['balance'] - $price;
                $userModel->updateBalance($user_id, $new_balance);
                $_SESSION['balance'] = $new_balance; 

                if ($isMultipleStock) {
                    if ($account['stock'] > 0) {
                        $accountModel->decrementStock($id);
                        $accountModel->checkAndMarkSold($id);
                        $transactionModel->addTransaction($user_id, $price, 'purchase');

                        $_SESSION['success_purchase'] = true;
                        
                        // Generate a randomized account username & password based on Category and Title
                        $catName = strtolower($account['category_name']);
                        $titleLower = strtolower($account['title']);
                        
                        if (strpos($catName, 'liên quân') !== false) {
                            if (strpos($titleLower, 'vip') !== false) {
                                $username = 'lq_vip_' . $code . '_' . rand(10, 99);
                                $password = 'VipLQ' . rand(1000, 9999) . '!';
                            } else if (strpos($titleLower, 'reg') !== false) {
                                $username = 'lq_reg_' . $code . '_' . rand(10, 99);
                                $password = 'regPass' . rand(100, 999) . '!';
                            } else if (strpos($titleLower, 'siêu rẻ') !== false || strpos($titleLower, 'tự chọn') !== false) {
                                $username = 'lq_sr_' . $code . '_' . rand(10, 99);
                                $password = 'srPass' . rand(1000, 9999);
                            } else {
                                // Default/Blind Bag ratio
                                $rand = rand(1, 100);
                                if ($rand <= 3) {
                                    $username = 'lq_vip_' . $code . '_sg';
                                    $password = 'VipLQ' . rand(1000, 9999) . '!';
                                } else if ($rand <= 8) {
                                    $username = 'lq_reg_' . $code;
                                    $password = 'regPass' . rand(100, 999);
                                } else {
                                    $username = 'lq_normal_' . $code . '_' . rand(100, 999);
                                    $password = 'pass' . rand(10000, 99999);
                                }
                            }
                        } else if (strpos($catName, 'free fire') !== false) {
                            if (strpos($titleLower, 'vip') !== false) {
                                $username = 'ff_vip_' . $code . '_' . rand(10, 99);
                                $password = 'VipFF' . rand(1000, 9999) . '!';
                            } else if (strpos($titleLower, 'reg') !== false) {
                                $username = 'ff_reg_' . $code . '_' . rand(10, 99);
                                $password = 'regPass' . rand(100, 999) . '!';
                            } else {
                                $rand = rand(1, 100);
                                if ($rand <= 5) {
                                    $username = 'ff_vip_' . $code . '_sg';
                                    $password = 'VipFF' . rand(1000, 9999) . '!';
                                } else if ($rand <= 15) {
                                    $username = 'ff_reg_' . $code;
                                    $password = 'regPass' . rand(100, 999);
                                } else {
                                    $username = 'ff_normal_' . $code . '_' . rand(100, 999);
                                    $password = 'pass' . rand(10000, 99999);
                                }
                            }
                        } else if (strpos($catName, 'roblox') !== false) {
                            $username = 'rob_' . $code . '_' . rand(10, 99);
                            $password = 'robPass' . rand(10000, 99999);
                        } else if (strpos($catName, 'liên minh') !== false || strpos($catName, 'tft') !== false) {
                            $username = 'lol_' . $code . '_' . rand(10, 99);
                            $password = 'lolPass' . rand(10000, 99999);
                        } else {
                            $username = 'acc_' . strtolower(str_replace(' ', '', $account['title'])) . '_' . $code;
                            $password = 'pass' . rand(100000, 999999);
                        }

                        $_SESSION['purchased_username'] = $username;
                        $_SESSION['purchased_password'] = $password;

                        // Log the purchased account to databases so it shows up on history (profile)
                        $accountModel->logPurchasedAccount([
                            'category_id' => $account['category_id'],
                            'title' => $account['title'] . ' #' . $code,
                            'description' => 'Được mua từ gói ' . $account['title'],
                            'image_url' => $account['image_url'],
                            'price' => $price,
                            'old_price' => $codeDetail ? $codeDetail['old_price'] : 0,
                            'buyer_id' => $user_id,
                            'game_username' => $username,
                            'game_password' => $password
                        ]);

                        $redirectUrl = BASEURL . '/account/detail/' . $id;
                        if (!empty($code)) {
                            $redirectUrl .= '?code=' . urlencode($code);
                        }
                        header('Location: ' . $redirectUrl);
                        exit;
                    } else {
                        $_SESSION['error_purchase'] = "Sản phẩm này đã hết hàng!";
                        $redirectUrl = BASEURL . '/account/detail/' . $id;
                        if (!empty($code)) {
                            $redirectUrl .= '?code=' . urlencode($code);
                        }
                        header('Location: ' . $redirectUrl);
                        exit;
                    }
                } else {
                    $accountModel->markAsSold($id, $user_id);
                    $transactionModel->addTransaction($user_id, $price, 'purchase');

                    $_SESSION['success_purchase'] = true;
                    $_SESSION['purchased_username'] = $account['game_username'];
                    $_SESSION['purchased_password'] = $account['game_password'];

                    header('Location: ' . BASEURL . '/account/detail/' . $id);
                    exit;
                }
            } else {
                $_SESSION['error_purchase'] = "Số dư không đủ. Vui lòng nạp thêm!";
                $redirectUrl = BASEURL . '/account/detail/' . $id;
                if (!empty($code)) {
                    $redirectUrl .= '?code=' . urlencode($code);
                }
                header('Location: ' . $redirectUrl);
                exit;
            }
        }
        header('Location: ' . BASEURL);
    }
}
