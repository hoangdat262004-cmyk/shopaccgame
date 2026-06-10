<?php
class Category extends Controller {
    public function index($slug = '') {
        if(empty($slug)) {
            header('Location: ' . BASEURL);
            exit;
        }

        $categoryModel = $this->model('CategoryModel');
        $category = $categoryModel->getCategoryBySlug($slug);

        if(!$category) {
            header('Location: ' . BASEURL);
            exit;
        }

        $data['title'] = 'Danh mục ' . $category['name'] . ' - Shop Acc Game';
        $data['category'] = $category;
        
        // Build filters
        $filters = [
            'id' => isset($_GET['id']) ? trim($_GET['id']) : '',
            'price' => isset($_GET['price']) ? $_GET['price'] : '',
            'sort' => isset($_GET['sort']) ? $_GET['sort'] : '',
            'info' => isset($_GET['info']) ? trim($_GET['info']) : ''
        ];
        
        $data['filters'] = $filters;
        $data['accounts'] = $categoryModel->getAccountsByCategorySlug($slug, $filters);

        $this->view('templates/header', $data);
        $this->view('category/view', $data);
        $this->view('templates/footer');
    }
}
