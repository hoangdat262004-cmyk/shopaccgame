<?php
class AccountModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAccounts() {
        $this->db->query("SELECT accounts.*, categories.name as category_name FROM accounts JOIN categories ON accounts.category_id = categories.id ORDER BY accounts.id ASC");
        return $this->db->resultSet();
    }

    public function addAccount($data) {
        $stock = isset($data['stock']) ? (int)$data['stock'] : 1;
        $this->db->query("INSERT INTO accounts (category_id, title, description, image_url, price, old_price, game_username, game_password, stock) VALUES (:category_id, :title, :description, :image_url, :price, :old_price, :game_username, :game_password, :stock)");
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image_url', $data['image']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':old_price', $data['old_price']);
        $this->db->bind(':game_username', $data['account_username']);
        $this->db->bind(':game_password', $data['account_password']);
        $this->db->bind(':stock', $stock);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function deleteAccount($id) {
        $this->db->query("DELETE FROM accounts WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getAccountById($id) {
        $this->db->query("SELECT accounts.*, categories.name as category_name FROM accounts JOIN categories ON accounts.category_id = categories.id WHERE accounts.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function markAsSold($id, $buyer_id) {
        $this->db->query("UPDATE accounts SET status = 'sold', buyer_id = :buyer_id WHERE id = :id");
        $this->db->bind(':buyer_id', $buyer_id);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function decrementStock($id) {
        $this->db->query("UPDATE accounts SET stock = stock - 1 WHERE id = :id AND stock > 0");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function checkAndMarkSold($id) {
        $this->db->query("SELECT stock FROM accounts WHERE id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        if ($row && $row['stock'] <= 0) {
            $this->db->query("UPDATE accounts SET status = 'sold' WHERE id = :id");
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
    }

    public function logPurchasedAccount($data) {
        $this->db->query("INSERT INTO accounts (category_id, title, description, image_url, price, old_price, status, buyer_id, game_username, game_password, stock) VALUES (:category_id, :title, :description, :image_url, :price, :old_price, 'sold', :buyer_id, :game_username, :game_password, 0)");
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image_url', $data['image_url']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':old_price', $data['old_price']);
        $this->db->bind(':buyer_id', $data['buyer_id']);
        $this->db->bind(':game_username', $data['game_username']);
        $this->db->bind(':game_password', $data['game_password']);
        return $this->db->execute();
    }

    public function getPurchasedAccounts($user_id) {
        $this->db->query("SELECT accounts.*, categories.name as category_name FROM accounts JOIN categories ON accounts.category_id = categories.id WHERE accounts.buyer_id = :user_id ORDER BY accounts.id DESC");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function getCodeDetail($accountId, $code) {
        // Try exact account_id first, then fallback to account_id=0 (wildcard)
        $this->db->query("SELECT * FROM account_code_details WHERE (account_id = :account_id OR account_id = 0) AND code = :code ORDER BY account_id DESC LIMIT 1");
        $this->db->bind(':account_id', $accountId);
        $this->db->bind(':code', $code);
        return $this->db->single();
    }

    public function getCodeDetailsBatch($accountId, $codes) {
        if (empty($codes)) return [];
        $placeholders = implode(',', array_fill(0, count($codes), '?'));
        $sql = "SELECT * FROM account_code_details WHERE (account_id = ? OR account_id = 0) AND code IN ($placeholders) ORDER BY account_id DESC";
        $this->db->query($sql);
        $this->db->bind(1, $accountId);
        foreach ($codes as $i => $code) {
            $this->db->bind($i + 2, $code);
        }
        $results = $this->db->resultSet();
        $map = [];
        foreach ($results as $row) {
            if (!isset($map[$row['code']])) {
                $map[$row['code']] = $row;
            }
        }
        return $map;
    }

    public function updateAccount($id, $data) {
        if(!empty($data['image'])) {
            $this->db->query("UPDATE accounts SET category_id = :category_id, title = :title, description = :description, image_url = :image_url, price = :price, old_price = :old_price, status = :status, game_username = :game_username, game_password = :game_password, stock = :stock WHERE id = :id");
            $this->db->bind(':image_url', $data['image']);
        } else {
            $this->db->query("UPDATE accounts SET category_id = :category_id, title = :title, description = :description, price = :price, old_price = :old_price, status = :status, game_username = :game_username, game_password = :game_password, stock = :stock WHERE id = :id");
        }
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':old_price', $data['old_price']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':game_username', $data['account_username']);
        $this->db->bind(':game_password', $data['account_password']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getAccountsCountByStatus($status) {
        $this->db->query("SELECT COUNT(*) as count FROM accounts WHERE status = :status");
        $this->db->bind(':status', $status);
        $row = $this->db->single();
        return $row ? $row['count'] : 0;
    }

    public function getTotalAccountsCount() {
        $this->db->query("SELECT COUNT(*) as count FROM accounts");
        $row = $this->db->single();
        return $row ? $row['count'] : 0;
    }
    public function addCodeDetails($accountId, $details) {
        if (empty($details)) return false;
        
        // Prepare bulk insert
        $values = [];
        $params = [];
        foreach ($details as $idx => $detail) {
            $code = $idx + 1; // 1-based code
            $values[] = "(?, ?, ?, ?, '', ?)";
            $params[] = $accountId;
            $params[] = $code;
            $params[] = $detail['username'];
            $params[] = $detail['password'];
            $params[] = isset($detail['image']) ? $detail['image'] : '';
        }
        
        $sql = "INSERT INTO account_code_details (account_id, code, username, password, info, image_url) VALUES " . implode(", ", $values);
        $this->db->query($sql);
        
        foreach ($params as $idx => $param) {
            $this->db->bind($idx + 1, $param);
        }
        
        return $this->db->execute();
    }

    public function deleteCodeDetails($accountId) {
        $this->db->query("DELETE FROM account_code_details WHERE account_id = :account_id");
        $this->db->bind(':account_id', $accountId);
        return $this->db->execute();
    }

    public function getCodeDetailsByAccountId($accountId) {
        $this->db->query("SELECT * FROM account_code_details WHERE account_id = :account_id ORDER BY code ASC");
        $this->db->bind(':account_id', $accountId);
        return $this->db->resultSet();
    }
}

