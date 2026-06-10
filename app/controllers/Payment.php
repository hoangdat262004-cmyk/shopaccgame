<?php
class Payment extends Controller {
    public function index() {
        if(!isset($_SESSION['user_id'])) {
            $_SESSION['error_payment'] = 'Vui lòng đăng nhập để nạp tiền!';
            header('Location: ' . BASEURL);
            exit;
        }

        $transactionModel = $this->model('TransactionModel');
        $history = $transactionModel->getUserTransactions($_SESSION['user_id']);

        $data = [
            'title' => 'Nạp tiền vào tài khoản',
            'history' => $history
        ];
        $this->view('templates/header', $data);
        $this->view('payment/index', $data);
        $this->view('templates/footer');
    }

    public function deposit() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_SESSION['user_id'])) {
                $_SESSION['error_payment'] = 'Vui lòng đăng nhập để nạp thẻ!';
                header('Location: ' . BASEURL);
                exit;
            }

            $amount = isset($_POST['amount']) ? (int)$_POST['amount'] : 0;
            $provider = isset($_POST['provider']) ? $_POST['provider'] : '';
            $pin = isset($_POST['pin']) ? trim($_POST['pin']) : '';
            $serial = isset($_POST['serial']) ? trim($_POST['serial']) : '';
            
            if($amount > 0 && !empty($provider) && !empty($pin) && !empty($serial)) {
                $telco_map = ['viettel' => 'VIETTEL', 'mobi' => 'MOBIFONE', 'vina' => 'VINAPHONE'];
                $telco = isset($telco_map[$provider]) ? $telco_map[$provider] : '';

                if (empty($telco)) {
                    $_SESSION['error_payment'] = 'Nhà mạng không hợp lệ!';
                    header('Location: ' . BASEURL . '/payment');
                    exit;
                }

                $user_id = $_SESSION['user_id'];
                $trans_id = time() . rand(1000, 9999); // Tạo mã giao dịch duy nhất
                $partner_id = PARTNER_ID;
                $partner_key = PARTNER_KEY;
                $command = 'charging';
                $sign = md5($partner_key . $pin . $serial);

                // === CHẾ ĐỘ NẠP TEST TỰ ĐỘNG THÀNH CÔNG ===
                // Tạm ẩn kết nối API Gachthe1s
                /*
                $url = 'https://gachthe1s.com/chargingws/v2';
                $dataPost = [
                    'request_id' => $trans_id,
                    'code' => $pin,
                    'partner_id' => $partner_id,
                    'serial' => $serial,
                    'telco' => $telco,
                    'command' => $command,
                    'amount' => $amount,
                    'sign' => $sign
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataPost));
                $result = curl_exec($ch);
                curl_close($ch);

                $json = json_decode($result, true);
                */

                // Giả lập nạp thành công 100%
                $json = ['status' => 1, 'message' => 'Nạp thẻ TEST thành công!'];

                if (isset($json['status'])) {
                    if ($json['status'] == 99) {
                        // Thẻ đang xử lý
                        $transactionModel = $this->model('TransactionModel');
                        $transactionModel->addCardTransaction($user_id, $trans_id, $amount, $telco, $pin, $serial);
                        $_SESSION['success_payment'] = 'Đã gửi thẻ lên hệ thống. Vui lòng chờ 1-3 phút để xử lý!';
                    } elseif ($json['status'] == 1) {
                        // Thành công luôn (hiếm khi xảy ra ở bước gạch thẻ)
                        $actual_amount = $amount * 0.8;
                        $transactionModel = $this->model('TransactionModel');
                        $transactionModel->addCardTransaction($user_id, $trans_id, $amount, $telco, $pin, $serial);
                        $transactionModel->updateTransactionStatusByTransId($trans_id, 'completed', $actual_amount);
                        
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserById($user_id);
                        $userModel->updateBalance($user_id, $user['balance'] + $actual_amount);
                        
                        $_SESSION['success_payment'] = 'NẠP THẺ TEST THÀNH CÔNG! Đã cộng ' . number_format($actual_amount, 0, ',', '.') . ' VNĐ vào tài khoản.';
                    } else {
                        // Lỗi từ hệ thống gạch thẻ
                        $_SESSION['error_payment'] = 'Lỗi nạp thẻ: ' . $json['message'];
                    }
                } else {
                    $_SESSION['error_payment'] = 'Không thể kết nối đến máy chủ thanh toán!';
                }
            } else {
                $_SESSION['error_payment'] = 'Vui lòng điền đầy đủ thông tin thẻ!';
            }
            header('Location: ' . BASEURL . '/payment');
            exit;
        }
        header('Location: ' . BASEURL);
    }
}
