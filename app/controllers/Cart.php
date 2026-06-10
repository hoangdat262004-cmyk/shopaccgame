<?php
class Cart extends Controller {
    public function index() {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $userModel = $this->model('UserModel');
        $user = $userModel->getUserById($_SESSION['user_id']);

        $data = [
            'title' => 'Giỏ hàng của bạn',
            'user' => $user
        ];
        
        $this->view('templates/header', $data);
        $this->view('cart/index', $data);
        $this->view('templates/footer');
    }

    public function add() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: ' . BASEURL);
            exit;
        }

        if(!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để thêm vào giỏ hàng', 'redirect' => BASEURL . '/auth/login']);
            exit;
        }

        $account_id = isset($_POST['account_id']) ? (int)$_POST['account_id'] : 0;
        $code = isset($_POST['code']) ? trim($_POST['code']) : '';
        
        if ($account_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không hợp lệ']);
            exit;
        }

        $accountModel = $this->model('AccountModel');
        $account = $accountModel->getAccountById($account_id);

        if (!$account || $account['status'] != 'available') {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại hoặc đã bán']);
            exit;
        }

        // Get actual price
        $price = $account['price'];
        $title = $account['title'];
        $isMultipleStock = (stripos($account['title'], 'Túi Mù') !== false || $account['stock'] > 1);
        
        if ($isMultipleStock && !empty($code)) {
            // Find code detail to get specific price
            $codeDetail = $accountModel->getCodeDetail($account_id, $code);
            if ($codeDetail && !empty($codeDetail['price'])) {
                $price = $codeDetail['price'];
            }
            $title .= ' #' . $code;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add to cart
        $_SESSION['cart'][] = [
            'account_id' => $account_id,
            'code' => $code,
            'price' => $price,
            'title' => $title,
            'image' => $account['image_url']
        ];

        echo json_encode([
            'success' => true, 
            'message' => 'Đã thêm vào giỏ hàng thành công',
            'cart_count' => count($_SESSION['cart'])
        ]);
        exit;
    }

    public function remove($index = '') {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        if ($index !== '' && isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            // Re-index array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }

        header('Location: ' . BASEURL . '/cart');
        exit;
    }

    public function checkout() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: ' . BASEURL . '/cart');
            exit;
        }

        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        if (empty($_SESSION['cart'])) {
            header('Location: ' . BASEURL . '/cart');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $userModel = $this->model('UserModel');
        $accountModel = $this->model('AccountModel');
        $transactionModel = $this->model('TransactionModel');

        $user = $userModel->getUserById($user_id);

        // Calculate total
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'];
        }

        if ($user['balance'] < $total) {
            $_SESSION['checkout_error'] = 'Số dư không đủ để thanh toán toàn bộ giỏ hàng. Cần ' . number_format($total, 0, ',', '.') . 'đ.';
            header('Location: ' . BASEURL . '/cart');
            exit;
        }

        // Process checkout
        $new_balance = $user['balance'] - $total;
        $userModel->updateBalance($user_id, $new_balance);
        $_SESSION['balance'] = $new_balance;

        $purchased_items = [];

        foreach ($_SESSION['cart'] as $item) {
            $id = $item['account_id'];
            $code = $item['code'];
            $price = $item['price'];

            $account = $accountModel->getAccountById($id);
            if (!$account) continue;

            $isMultipleStock = (stripos($account['title'], 'Túi Mù') !== false || $account['stock'] > 1);

            if ($isMultipleStock) {
                if ($account['stock'] > 0) {
                    $accountModel->decrementStock($id);
                    $accountModel->checkAndMarkSold($id);
                    $transactionModel->addTransaction($user_id, $price, 'purchase');

                    // Generate random account
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

                    $accountModel->logPurchasedAccount([
                        'category_id' => $account['category_id'],
                        'title' => $account['title'] . ' #' . $code,
                        'description' => 'Được mua từ gói ' . $account['title'],
                        'image_url' => $account['image_url'],
                        'price' => $price,
                        'account_username' => $username,
                        'account_password' => $password,
                        'status' => 'sold',
                        'buyer_id' => $user_id
                    ]);

                    $purchased_items[] = ['title' => $account['title'] . ' #' . $code, 'username' => $username, 'password' => $password];
                }
            } else {
                // Single Account logic
                $transactionModel->addTransaction($user_id, $price, 'purchase');
                $accountModel->updateAccountStatus($id, 'sold');
                $accountModel->setBuyer($id, $user_id);
                $purchased_items[] = ['title' => $account['title'], 'username' => $account['account_username'], 'password' => $account['account_password']];
            }
        }

        // Clear cart
        $_SESSION['cart'] = [];
        $_SESSION['success_purchase_multiple'] = $purchased_items;

        header('Location: ' . BASEURL . '/profile/account_history');
        exit;
    }
}
