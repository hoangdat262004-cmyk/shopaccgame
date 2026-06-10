<?php
class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllCategories() {
        $this->db->query("SELECT * FROM categories ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function getParentCategories() {
        $this->db->query("SELECT * FROM categories WHERE parent_id IS NULL OR parent_id = 0 ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function getAllCategoriesWithCount() {
        $this->db->query("SELECT c.*, (SELECT COUNT(id) FROM accounts WHERE category_id = c.id AND status = 'available') as acc_count FROM categories c WHERE c.parent_id IS NULL OR c.parent_id = 0 ORDER BY c.id ASC");
        return $this->db->resultSet();
    }

    public function getSubCategories($parent_id) {
        $this->db->query("SELECT c.*, (SELECT COUNT(id) FROM accounts WHERE category_id = c.id AND status = 'available') as stock FROM categories c WHERE c.parent_id = :parent_id ORDER BY c.id ASC");
        $this->db->bind(':parent_id', $parent_id);
        return $this->db->resultSet();
    }

    public function getCategoryById($id) {
        $this->db->query("SELECT * FROM categories WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getCategoryBySlug($slug) {
        $this->db->query("SELECT * FROM categories WHERE slug = :slug");
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    public function getAccountsByCategorySlug($slug, $filters = []) {
        $sql = "SELECT accounts.* FROM accounts JOIN categories ON accounts.category_id = categories.id WHERE categories.slug = :slug";
        
        // Build dynamic WHERE clauses
        if (!empty($filters['id'])) {
            $sql .= " AND accounts.id = :acc_id";
        }
        if (!empty($filters['price'])) {
            if ($filters['price'] == 'under_50') $sql .= " AND accounts.price < 50000";
            elseif ($filters['price'] == '50_200') $sql .= " AND accounts.price >= 50000 AND accounts.price <= 200000";
            elseif ($filters['price'] == '200_500') $sql .= " AND accounts.price > 200000 AND accounts.price <= 500000";
            elseif ($filters['price'] == 'over_500') $sql .= " AND accounts.price > 500000";
        }
        if (!empty($filters['info'])) {
            // Lọc theo "trắng thông tin" hoặc theo nội dung mô tả
            $sql .= " AND accounts.description LIKE :info";
        }
        
        // Sắp xếp
        if (!empty($filters['sort'])) {
            if ($filters['sort'] == 'price_asc') $sql .= " ORDER BY accounts.price ASC";
            elseif ($filters['sort'] == 'price_desc') $sql .= " ORDER BY accounts.price DESC";
            else $sql .= " ORDER BY accounts.id DESC";
        } else {
            $sql .= " ORDER BY accounts.id DESC";
        }

        $this->db->query($sql);
        $this->db->bind(':slug', $slug);
        
        if (!empty($filters['id'])) {
            $this->db->bind(':acc_id', $filters['id']);
        }
        if (!empty($filters['info'])) {
            $this->db->bind(':info', '%' . $filters['info'] . '%');
        }

        return $this->db->resultSet();
    }

    public function addCategory($data) {
        $parent_id = !empty($data['parent_id']) ? $data['parent_id'] : null;
        $this->db->query("INSERT INTO categories (name, slug, image_url, parent_id) VALUES (:name, :slug, :image_url, :parent_id)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':image_url', $data['image']);
        $this->db->bind(':parent_id', $parent_id);
        return $this->db->execute();
    }

    public function updateCategory($data) {
        $parent_id = !empty($data['parent_id']) ? $data['parent_id'] : null;
        if(!empty($data['image'])) {
            $this->db->query("UPDATE categories SET name = :name, slug = :slug, image_url = :image_url, parent_id = :parent_id WHERE id = :id");
            $this->db->bind(':image_url', $data['image']);
        } else {
            $this->db->query("UPDATE categories SET name = :name, slug = :slug, parent_id = :parent_id WHERE id = :id");
        }
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':parent_id', $parent_id);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function deleteCategory($id) {
        $this->db->query("DELETE FROM categories WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
