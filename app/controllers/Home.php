<?php
class Home extends Controller {
    public function index() {
        $categoryModel = $this->model('CategoryModel');
        $accountModel = $this->model('AccountModel');
        $transactionModel = $this->model('TransactionModel');

        $data['title'] = 'Trang chủ - Shop Acc Game';
        $data['categories'] = $categoryModel->getAllCategoriesWithCount();
        $data['top_depositors'] = $transactionModel->getTopDepositors(5);
        
        // Nhóm accounts (trực tiếp) và sub_categories theo danh mục chính để hiển thị trên trang chủ
        $allAccounts = $accountModel->getAllAccounts();
        $groupedAccounts = [];
        foreach($allAccounts as $acc) {
            $groupedAccounts[$acc['category_id']][] = $acc;
        }
        $data['groupedAccounts'] = $groupedAccounts;

        $groupedSubCategories = [];
        foreach($data['categories'] as $cat) {
            $groupedSubCategories[$cat['id']] = $categoryModel->getSubCategories($cat['id']);
        }
        $data['groupedSubCategories'] = $groupedSubCategories;

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
