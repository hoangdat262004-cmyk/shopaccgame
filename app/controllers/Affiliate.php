<?php
class Affiliate extends Controller {
    public function __construct() {
        // Khởi động phiên làm việc nếu chưa có
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Yêu cầu đăng nhập để sử dụng tính năng affiliate
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index() {
        $this->stats();
    }

    public function stats() {
        $data['title'] = 'Thống kê tiếp thị liên kết - Shop Gaming';
        
        // Tạo mã giới thiệu của riêng họ dựa trên ID người dùng
        $data['referral_code'] = 'REF' . str_pad($_SESSION['user_id'], 5, '0', STR_PAD_LEFT);
        $data['referral_link'] = BASEURL . '?ref=' . $data['referral_code'];
        
        $this->view('templates/header', $data);
        $this->view('affiliate/stats', $data);
        $this->view('templates/footer');
    }

    public function history() {
        $data['title'] = 'Lịch sử hoa hồng tiếp thị liên kết';
        $this->view('templates/header', $data);
        $this->view('affiliate/history', $data);
        $this->view('templates/footer');
    }

    public function withdraw() {
        $data['title'] = 'Rút tiền hoa hồng tiếp thị liên kết';
        
        // Giả lập số dư hoa hồng khả dụng để người dùng trải nghiệm
        $data['affiliate_balance'] = 150000; // 150,000 VND
        
        $this->view('templates/header', $data);
        $this->view('affiliate/withdraw', $data);
        $this->view('templates/footer');
    }
}
