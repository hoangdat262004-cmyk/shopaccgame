<?php
class Admin extends Controller {
    public function __construct() {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url_parts = explode('/', $url);
        $method = isset($url_parts[1]) ? strtolower($url_parts[1]) : 'index';

        if ($method !== 'login') {
            if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                header('Location: ' . BASEURL . '/admin/login');
                exit;
            }
        }
    }

    public function login() {
        if(isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }

        $data = ['title' => 'Đăng nhập Quản Trị', 'username' => '', 'password' => '', 'error' => ''];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);
            
            if(empty($data['username']) || empty($data['password'])) {
                $data['error'] = 'Vui lòng nhập đầy đủ thông tin';
            } else {
                $userModel = $this->model('UserModel');
                $loggedInUser = $userModel->login($data['username'], $data['password']);
                if($loggedInUser && $loggedInUser['role'] === 'admin') {
                    // Create Session
                    $_SESSION['user_id'] = $loggedInUser['id'];
                    $_SESSION['username'] = $loggedInUser['username'];
                    $_SESSION['role'] = $loggedInUser['role'];
                    $_SESSION['balance'] = $loggedInUser['balance'];
                    
                    header('Location: ' . BASEURL . '/admin');
                    exit;
                } else {
                    $data['error'] = 'Sai tài khoản, mật khẩu hoặc không có quyền truy cập';
                }
            }
        }

        $this->view('admin/login', $data);
    }

    public function index() {
        $data['title'] = 'Dashboard Admin | SHOPGAMING';
        
        $accountModel = $this->model('AccountModel');
        $userModel = $this->model('UserModel');
        $transactionModel = $this->model('TransactionModel');
        $categoryModel = $this->model('CategoryModel');

        // Statistics
        $data['total_revenue'] = $transactionModel->getTotalRevenue();
        $data['accounts_sold'] = $accountModel->getAccountsCountByStatus('sold');
        $data['accounts_available'] = $accountModel->getAccountsCountByStatus('available');
        $data['total_users'] = $userModel->getTotalUsersCount();
        $categories = $categoryModel->getAllCategories();
        $data['total_categories'] = count($categories);
        $data['categories'] = $categories;

        // Recent Data
        $data['recent_transactions'] = $transactionModel->getRecentTransactions(5);
        $all_users = $userModel->getAllUsers();
        $data['recent_users'] = array_slice($all_users, 0, 5);

        $this->view('admin/layout', $data);
        $this->view('admin/dashboard', $data);
    }

    // ================= CATEGORIES =================
    public function categories() {
        $categoryModel = $this->model('CategoryModel');
        $data['title'] = 'Quản lý Danh mục | SHOPGAMING';
        $data['categories'] = $categoryModel->getAllCategories();
        $data['parentCategories'] = $categoryModel->getParentCategories();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = [
                'name' => trim($_POST['name']),
                'slug' => trim($_POST['slug']),
                'parent_id' => !empty($_POST['parent_id']) ? $_POST['parent_id'] : null,
                'image' => ''
            ];

            // Image Upload
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = dirname(dirname(__DIR__)) . '/public/uploads/';
                // Create directory if not exists
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $file_name;
                
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $postData['image'] = $file_name;
                }
            }
            
            if(isset($_POST['id']) && !empty($_POST['id'])) {
                $postData['id'] = $_POST['id'];
                $categoryModel->updateCategory($postData);
            } else {
                $categoryModel->addCategory($postData);
            }
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }

        $this->view('admin/layout', $data);
        $this->view('admin/categories', $data);
    }

    public function editCategory($id) {
        $categoryModel = $this->model('CategoryModel');
        $data['title'] = 'Chỉnh sửa Danh mục | SHOPGAMING';
        $data['category'] = $categoryModel->getCategoryById($id);
        $data['parentCategories'] = $categoryModel->getParentCategories();

        if (!$data['category']) {
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'slug' => trim($_POST['slug']),
                'parent_id' => !empty($_POST['parent_id']) ? $_POST['parent_id'] : null,
                'image' => ''
            ];

            // Image Upload
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = dirname(dirname(__DIR__)) . '/public/uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = time() . '_' . basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $file_name)) {
                    $postData['image'] = $file_name;
                }
            }

            $categoryModel->updateCategory($postData);
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }

        $this->view('admin/layout', $data);
        $this->view('admin/edit_category', $data);
    }

    public function deleteCategory($id) {
        $this->model('CategoryModel')->deleteCategory($id);
        header('Location: ' . BASEURL . '/admin/categories');
        exit;
    }

    // ================= ACCOUNTS =================
    public function accounts() {
        $accountModel = $this->model('AccountModel');
        $categoryModel = $this->model('CategoryModel');
        $data['title'] = 'Quản lý Tài khoản Game | SHOPGAMING';
        $data['accounts'] = $accountModel->getAllAccounts();
        $data['categories'] = $categoryModel->getAllCategories();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = [
                'category_id' => $_POST['category_id'],
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'price' => $_POST['price'],
                'old_price' => $_POST['old_price'] ? $_POST['old_price'] : 0,
                'status' => 'available',
                'account_username' => trim($_POST['account_username']),
                'account_password' => trim($_POST['account_password']),
                'stock' => isset($_POST['stock']) ? (int)$_POST['stock'] : 1,
                'image' => ''
            ];

            // Image Upload
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = dirname(dirname(__DIR__)) . '/public/uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = time() . '_' . basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $file_name)) {
                    $postData['image'] = $file_name;
                }
            }
            // Parse account list if provided via dynamic rows
            $details = [];
            if (!empty($_POST['list_username']) && is_array($_POST['list_username'])) {
                foreach ($_POST['list_username'] as $index => $uName) {
                    $uName = trim($uName);
                    $pwd = isset($_POST['list_password'][$index]) ? trim($_POST['list_password'][$index]) : '';
                    $img = '';
                    
                    if (isset($_FILES['list_image']['name'][$index]) && $_FILES['list_image']['error'][$index] == 0) {
                        $target_dir = dirname(dirname(__DIR__)) . '/public/uploads/';
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }
                        $file_name = time() . '_' . rand(100, 999) . '_' . basename($_FILES["list_image"]["name"][$index]);
                        if(move_uploaded_file($_FILES["list_image"]["tmp_name"][$index], $target_dir . $file_name)) {
                            $img = $file_name;
                        }
                    }

                    if (!empty($uName)) {
                        $details[] = [
                            'username' => $uName,
                            'password' => $pwd,
                            'image' => $img
                        ];
                    }
                }
                
                if (count($details) > 0) {
                    $postData['stock'] = count($details);
                }
            }

            $newId = $accountModel->addAccount($postData);
            
            if ($newId && count($details) > 0) {
                $accountModel->addCodeDetails($newId, $details);
            }
            
            header('Location: ' . BASEURL . '/admin/accounts');
            exit;
        }

        $this->view('admin/layout', $data);
        $this->view('admin/accounts', $data);
    }

    public function editAccount($id) {
        $accountModel = $this->model('AccountModel');
        $categoryModel = $this->model('CategoryModel');
        
        $data['title'] = 'Chỉnh sửa Tài khoản Game | SHOPGAMING';
        $data['account'] = $accountModel->getAccountById($id);
        $data['categories'] = $categoryModel->getAllCategories();

        if (!$data['account']) {
            header('Location: ' . BASEURL . '/admin/accounts');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = [
                'category_id' => $_POST['category_id'],
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'price' => $_POST['price'],
                'old_price' => $_POST['old_price'] ? $_POST['old_price'] : 0,
                'status' => $_POST['status'],
                'account_username' => trim($_POST['account_username']),
                'account_password' => trim($_POST['account_password']),
                'stock' => isset($_POST['stock']) ? $_POST['stock'] : 1,
                'image' => ''
            ];

            // Image Upload
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = dirname(dirname(__DIR__)) . '/public/uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = time() . '_' . basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $file_name)) {
                    $postData['image'] = $file_name;
                }
            }

            // Parse account list if provided via dynamic rows
            $details = [];
            if (!empty($_POST['list_username']) && is_array($_POST['list_username'])) {
                foreach ($_POST['list_username'] as $index => $uName) {
                    $uName = trim($uName);
                    $pwd = isset($_POST['list_password'][$index]) ? trim($_POST['list_password'][$index]) : '';
                    $img = isset($_POST['existing_list_image'][$index]) ? $_POST['existing_list_image'][$index] : '';
                    
                    if (isset($_FILES['list_image']['name'][$index]) && $_FILES['list_image']['error'][$index] == 0) {
                        $target_dir = dirname(dirname(__DIR__)) . '/public/uploads/';
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }
                        $file_name = time() . '_' . rand(100, 999) . '_' . basename($_FILES["list_image"]["name"][$index]);
                        if(move_uploaded_file($_FILES["list_image"]["tmp_name"][$index], $target_dir . $file_name)) {
                            $img = $file_name;
                        }
                    }

                    if (!empty($uName)) {
                        $details[] = [
                            'username' => $uName,
                            'password' => $pwd,
                            'image' => $img
                        ];
                    }
                }
                
                if (count($details) > 0) {
                    $postData['stock'] = count($details);
                }
            }

            $accountModel->updateAccount($id, $postData);
            
            if (isset($_POST['list_username'])) {
                $accountModel->deleteCodeDetails($id);
                if (count($details) > 0) {
                    $accountModel->addCodeDetails($id, $details);
                }
            }
            
            header('Location: ' . BASEURL . '/admin/accounts');
            exit;
        }

        // Fetch existing code details
        $data['code_details'] = $accountModel->getCodeDetailsByAccountId($id);

        $this->view('admin/layout', $data);
        $this->view('admin/edit_account', $data);
    }

    public function deleteAccount($id) {
        $this->model('AccountModel')->deleteAccount($id);
        header('Location: ' . BASEURL . '/admin/accounts');
        exit;
    }

    public function bulkDeleteAccounts() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['account_ids'])) {
            $accountModel = $this->model('AccountModel');
            foreach ($_POST['account_ids'] as $id) {
                $accountModel->deleteAccount((int)$id);
            }
        }
        header('Location: ' . BASEURL . '/admin/accounts');
        exit;
    }

    // ================= USERS =================
    public function users() {
        $userModel = $this->model('UserModel');
        $data['title'] = 'Quản lý Thành viên | SHOPGAMING';
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = $_POST['action'];
            $userId = $_POST['user_id'];

            if($action === 'update_balance') {
                $balance = $_POST['balance'];
                $userModel->updateBalance($userId, $balance);
            } elseif ($action === 'update_role') {
                $role = $_POST['role'];
                $userModel->updateUserRole($userId, $role);
            }
            header('Location: ' . BASEURL . '/admin/users');
            exit;
        }

        $data['users'] = $userModel->getAllUsers();
        
        $this->view('admin/layout', $data);
        $this->view('admin/users', $data);
    }

    public function deleteUser($id) {
        // Prevent admin from deleting themselves
        if($id == $_SESSION['user_id']) {
            header('Location: ' . BASEURL . '/admin/users');
            exit;
        }
        $this->model('UserModel')->deleteUser($id);
        header('Location: ' . BASEURL . '/admin/users');
        exit;
    }

    // ================= TRANSACTIONS =================
    public function transactions() {
        $transactionModel = $this->model('TransactionModel');
        $data['title'] = 'Lịch sử Giao dịch | SHOPGAMING';
        $data['transactions'] = $transactionModel->getAllTransactions();

        $this->view('admin/layout', $data);
        $this->view('admin/transactions', $data);
    }
}
