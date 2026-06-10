<?php
class Profile extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index() {
        $userModel = $this->model('UserModel');
        $accountModel = $this->model('AccountModel');
        $transactionModel = $this->model('TransactionModel');

        $user = $userModel->getUserById($_SESSION['user_id']);
        $purchasedAccounts = $accountModel->getPurchasedAccounts($_SESSION['user_id']);
        
        $transactions = $transactionModel->getUserTransactions($_SESSION['user_id'], 1000);
        $total_deposit = 0;
        foreach($transactions as $t) {
            if($t['status'] == 'completed') {
                $total_deposit += $t['amount'];
            }
        }

        $data = [
            'title' => 'Trang Cá Nhân',
            'user' => $user,
            'purchased' => $purchasedAccounts,
            'total_deposit' => $total_deposit
        ];

        $this->view('templates/header', $data);
        $this->view('profile/index', $data);
        $this->view('templates/footer');
    }

    public function addTestMoney() {
        $userModel = $this->model('UserModel');
        $transactionModel = $this->model('TransactionModel');
        $user_id = $_SESSION['user_id'];
        
        $user = $userModel->getUserById($user_id);
        $new_balance = $user['balance'] + 500000;
        
        $userModel->updateBalance($user_id, $new_balance);
        $_SESSION['balance'] = $new_balance;
        $transactionModel->addTransaction($user_id, 500000, 'deposit');

        header('Location: ' . BASEURL . '/profile');
        exit;
    }

    public function deposit_history() {
        $userModel = $this->model('UserModel');
        $transactionModel = $this->model('TransactionModel');
        
        $user = $userModel->getUserById($_SESSION['user_id']);
        $transactions = $transactionModel->getUserTransactions($_SESSION['user_id'], 50);

        $data = [
            'title' => 'Lịch sử nạp tiền',
            'user' => $user,
            'transactions' => $transactions
        ];

        $this->view('templates/header', $data);
        $this->view('profile/deposit_history', $data);
        $this->view('templates/footer');
    }

    public function minigame_history() {
        $userModel = $this->model('UserModel');
        $user = $userModel->getUserById($_SESSION['user_id']);

        $data = [
            'title' => 'Minigames đã chơi',
            'user' => $user
        ];

        $this->view('templates/header', $data);
        $this->view('profile/minigame_history', $data);
        $this->view('templates/footer');
    }

    public function withdraw_history() {
        $userModel = $this->model('UserModel');
        $user = $userModel->getUserById($_SESSION['user_id']);

        $data = [
            'title' => 'Rút vật phẩm',
            'user' => $user
        ];

        $this->view('templates/header', $data);
        $this->view('profile/withdraw_history', $data);
        $this->view('templates/footer');
    }
}
