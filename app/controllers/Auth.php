<?php
class Auth extends Controller {
    public function login() {
        if(isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        $data = ['title' => 'Đăng nhập', 'username' => '', 'password' => '', 'username_err' => '', 'password_err' => ''];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);
            
            if(empty($data['username'])) $data['username_err'] = 'Vui lòng nhập tên đăng nhập';
            if(empty($data['password'])) $data['password_err'] = 'Vui lòng nhập mật khẩu';

            if(empty($data['username_err']) && empty($data['password_err'])) {
                $userModel = $this->model('UserModel');
                $loggedInUser = $userModel->login($data['username'], $data['password']);
                if($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Tên đăng nhập hoặc mật khẩu không chính xác';
                }
            }
        }

        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }

    public function register() {
        if(isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
            exit;
        }
        
        $data = [
            'title' => 'Đăng ký', 'username' => '', 'email' => '', 'password' => '', 'confirm_password' => '',
            'username_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['username'] = trim($_POST['username']);
            $data['email'] = trim($_POST['email']);
            $data['password'] = trim($_POST['password']);
            $data['confirm_password'] = trim($_POST['confirm_password']);

            $userModel = $this->model('UserModel');

            if(empty($data['username'])) {
                $data['username_err'] = 'Vui lòng nhập tên đăng nhập';
            } elseif($userModel->checkUsernameExists($data['username'])) {
                $data['username_err'] = 'Tên đăng nhập đã tồn tại';
            }

            if(empty($data['email'])) {
                $data['email_err'] = 'Vui lòng nhập email';
            } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Email không hợp lệ';
            } elseif($userModel->checkEmailExists($data['email'])) {
                $data['email_err'] = 'Email đã được đăng ký, vui lòng chọn email khác';
            }
            if(empty($data['password'])) {
                $data['password_err'] = 'Vui lòng nhập mật khẩu';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Vui lòng xác nhận mật khẩu';
            } elseif($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Mật khẩu xác nhận không khớp';
            }

            if(empty($data['username_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if($userModel->register($data)) {
                    header('Location: ' . BASEURL . '/auth/login');
                    exit;
                }
            }
        }

        $this->view('templates/header', $data);
        $this->view('auth/register', $data);
        $this->view('templates/footer');
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['balance'] = $user['balance'];
        header('Location: ' . BASEURL);
        exit;
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location: ' . BASEURL);
        exit;
    }
}
