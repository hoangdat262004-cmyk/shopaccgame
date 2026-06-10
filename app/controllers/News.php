<?php
class News extends Controller {
    public function index() {
        $newsModel = $this->model('NewsModel');
        
        $keyword = isset($_GET['search']) ? trim($_GET['search']) : '';
        $categoryFilter = isset($_GET['category']) ? trim($_GET['category']) : '';
        
        if (!empty($keyword)) {
            $data['news'] = $newsModel->searchNews($keyword);
            $data['title'] = 'Tìm kiếm tin tức: "' . htmlspecialchars($keyword) . '" - Shop Acc Game';
        } elseif (!empty($categoryFilter)) {
            $data['news'] = $newsModel->getNewsByCategory($categoryFilter);
            $data['title'] = 'Chuyên mục: ' . htmlspecialchars($categoryFilter) . ' - Shop Acc Game';
        } else {
            $data['news'] = $newsModel->getAllNews();
            $data['title'] = 'Tin tức mới nhất - Shop Acc Game';
        }
        
        $data['categories'] = $newsModel->getCategoriesWithCount();
        $data['current_search'] = $keyword;
        $data['current_category'] = $categoryFilter;

        $this->view('templates/header', $data);
        $this->view('news/index', $data);
        $this->view('templates/footer');
    }

    public function detail($slug = '') {
        if (empty($slug)) {
            header('Location: ' . BASEURL . '/news');
            exit;
        }

        $newsModel = $this->model('NewsModel');
        $post = $newsModel->getNewsBySlug($slug);

        if (!$post) {
            header('Location: ' . BASEURL . '/news');
            exit;
        }

        $data['title'] = $post['title'] . ' - Tin tức Shop Acc Game';
        $data['post'] = $post;
        $data['categories'] = $newsModel->getCategoriesWithCount();

        $this->view('templates/header', $data);
        $this->view('news/detail', $data);
        $this->view('templates/footer');
    }
}
