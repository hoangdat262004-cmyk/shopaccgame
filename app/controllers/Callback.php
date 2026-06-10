<?php
class Callback extends Controller {
    public function gachthe1s() {
        // Gachthe1s thường trả về qua GET hoặc POST
        $status = isset($_REQUEST['status']) ? (int)$_REQUEST['status'] : 0;
        $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : '';
        $request_id = isset($_REQUEST['request_id']) ? $_REQUEST['request_id'] : '';
        $declared_value = isset($_REQUEST['declared_value']) ? (int)$_REQUEST['declared_value'] : 0;
        $value = isset($_REQUEST['value']) ? (int)$_REQUEST['value'] : 0;
        $amount = isset($_REQUEST['amount']) ? (int)$_REQUEST['amount'] : 0; // Tiền nhận được (đã trừ chiết khấu)
        $code = isset($_REQUEST['code']) ? $_REQUEST['code'] : '';
        $serial = isset($_REQUEST['serial']) ? $_REQUEST['serial'] : '';
        $callback_sign = isset($_REQUEST['callback_sign']) ? $_REQUEST['callback_sign'] : '';

        // Có thể check signature ở đây nếu cần: md5(PARTNER_KEY . $code . $serial)
        // $my_sign = md5(PARTNER_KEY . $code . $serial);
        // if ($my_sign !== $callback_sign) { exit('Invalid signature'); }

        if (empty($request_id)) {
            exit('No request_id');
        }

        $transactionModel = $this->model('TransactionModel');
        $trans = $transactionModel->getTransactionByTransId($request_id);

        if (!$trans) {
            exit('Transaction not found');
        }

        // Nếu giao dịch đã được xử lý trước đó rồi thì bỏ qua
        if ($trans['status'] !== 'pending') {
            exit('Already processed');
        }

        if ($status == 1) { // Thẻ thành công đúng mệnh giá
            $actual_amount = $amount > 0 ? $amount : ($value * 0.8); // Nhận 80% nếu hệ thống gạch thẻ không gửi amount
            
            // Cập nhật trạng thái
            $transactionModel->updateTransactionStatusByTransId($request_id, 'completed', $actual_amount);
            
            // Cộng tiền user
            $userModel = $this->model('UserModel');
            $user = $userModel->getUserById($trans['user_id']);
            if ($user) {
                $userModel->updateBalance($trans['user_id'], $user['balance'] + $actual_amount);
            }
        } elseif ($status == 2) { // Thành công nhưng sai mệnh giá
            // Tuỳ chính sách: Phạt 50% hoặc nhận đúng mệnh giá trị thực x 80%
            $actual_amount = $amount > 0 ? $amount : ($value * 0.8); 
            
            $transactionModel->updateTransactionStatusByTransId($request_id, 'completed', $actual_amount);
            
            $userModel = $this->model('UserModel');
            $user = $userModel->getUserById($trans['user_id']);
            if ($user) {
                $userModel->updateBalance($trans['user_id'], $user['balance'] + $actual_amount);
            }
        } elseif ($status == 3 || $status == 4 || $status == 100) { // Thẻ lỗi, bảo trì, thẻ ảo...
            $transactionModel->updateTransactionStatusByTransId($request_id, 'error', 0);
        }

        echo 'OK';
    }

    public function sepay() {
        // SePay thường gọi Webhook với tham số GET token để bảo mật, ví dụ: /callback/sepay?token=...
        $token = isset($_GET['token']) ? $_GET['token'] : '';
        if ($token !== SEPAY_WEBHOOK_TOKEN) {
            http_response_code(403);
            exit('Invalid token');
        }

        // Đọc dữ liệu JSON từ SePay
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data || !isset($data['transferAmount']) || !isset($data['content'])) {
            http_response_code(400);
            exit('Invalid data');
        }

        // Chỉ xử lý giao dịch nhận tiền (in)
        if (isset($data['transferType']) && $data['transferType'] !== 'in') {
            exit('Not a deposit');
        }

        $amount = (int)$data['transferAmount'];
        $content = strtoupper(trim($data['content']));
        $trans_id = isset($data['referenceCode']) ? $data['referenceCode'] : (isset($data['id']) ? $data['id'] : time()); // Mã giao dịch ngân hàng

        // Tìm kiếm username trong nội dung chuyển khoản (VD: "NAP THANHHAI", "NAP ADMIN", ...)
        // Dùng Regex bóc tách chữ "NAP " và lấy username phía sau
        if (preg_match('/NAP\s+([A-Z0-9_]+)/', $content, $matches)) {
            $username = strtolower($matches[1]); // CSDL thường lưu username chữ thường
            
            $userModel = $this->model('UserModel');
            
            // Viết thêm hàm getUserByUsername vào UserModel hoặc dùng query trực tiếp
            // Ở đây tôi dùng PDO trực tiếp để nhanh gọn nếu chưa có hàm, nhưng tốt nhất gọi UserModel
            // Tạm thời gọi Database trực tiếp:
            require_once '../app/core/Database.php';
            $db = new Database();
            $db->query("SELECT * FROM users WHERE LOWER(username) = :username");
            $db->bind(':username', $username);
            $user = $db->single();

            if ($user) {
                // Kiểm tra xem mã giao dịch này đã cộng tiền chưa để tránh duplicate
                $transactionModel = $this->model('TransactionModel');
                $existing = $transactionModel->getTransactionByTransId('BANK_' . $trans_id);
                
                if (!$existing) {
                    // Cộng tiền
                    $new_balance = $user['balance'] + $amount;
                    $userModel->updateBalance($user['id'], $new_balance);

                    // Lưu lịch sử giao dịch nạp ngân hàng
                    // Tận dụng hàm addCardTransaction hoặc tạo addBankTransaction. Ở đây lưu dùng chung:
                    $db->query("INSERT INTO transactions (user_id, amount, type, status, trans_id, network, declared_value) 
                                VALUES (:user_id, :amount, 'deposit', 'completed', :trans_id, 'ATM/MOMO', :amount)");
                    $db->bind(':user_id', $user['id']);
                    $db->bind(':amount', $amount);
                    $db->bind(':trans_id', 'BANK_' . $trans_id);
                    $db->execute();
                }
            }
        }

        echo json_encode(['success' => true]);
    }
}
