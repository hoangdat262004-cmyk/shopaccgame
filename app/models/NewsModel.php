<?php
class NewsModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllNews() {
        $this->db->query("SELECT * FROM news ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function searchNews($keyword) {
        $this->db->query("SELECT * FROM news WHERE title LIKE :keyword OR summary LIKE :keyword OR category LIKE :keyword ORDER BY created_at DESC");
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function getNewsBySlug($slug) {
        $this->db->query("SELECT * FROM news WHERE slug = :slug");
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    public function getNewsByCategory($category) {
        $this->db->query("SELECT * FROM news WHERE category = :category ORDER BY created_at DESC");
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    public function getCategoriesWithCount() {
        $this->db->query("SELECT category, COUNT(id) as news_count FROM news GROUP BY category ORDER BY category ASC");
        return $this->db->resultSet();
    }
}
