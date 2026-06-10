<?php
class TransactionModel {
    private $db;
    public function __construct() { $this->db = new Database; }

    public function addTransaction($user_id, $amount, $type) {
        $this->db->query("INSERT INTO transactions (user_id, amount, type, status) VALUES (:user_id, :amount, :type, 'completed')");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':amount', $amount);
        $this->db->bind(':type', $type);
        return $this->db->execute();
    }

    public function addCardTransaction($user_id, $trans_id, $amount, $network, $pin, $serial) {
        $this->db->query("INSERT INTO transactions (user_id, amount, type, status, trans_id, network, pin, serial, declared_value) 
                          VALUES (:user_id, 0, 'deposit', 'pending', :trans_id, :network, :pin, :serial, :amount)");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':trans_id', $trans_id);
        $this->db->bind(':network', $network);
        $this->db->bind(':pin', $pin);
        $this->db->bind(':serial', $serial);
        $this->db->bind(':amount', $amount);
        return $this->db->execute();
    }

    public function updateTransactionStatusByTransId($trans_id, $status, $real_amount = 0) {
        $this->db->query("UPDATE transactions SET status = :status, amount = :amount WHERE trans_id = :trans_id");
        $this->db->bind(':status', $status);
        $this->db->bind(':amount', $real_amount);
        $this->db->bind(':trans_id', $trans_id);
        return $this->db->execute();
    }

    public function getTransactionByTransId($trans_id) {
        $this->db->query("SELECT * FROM transactions WHERE trans_id = :trans_id");
        $this->db->bind(':trans_id', $trans_id);
        return $this->db->single();
    }

    public function getUserTransactions($user_id, $limit = 20) {
        $this->db->query("SELECT * FROM transactions WHERE user_id = :user_id AND type = 'deposit' ORDER BY id DESC LIMIT :limit");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTopDepositors($limit = 5) {
        $this->db->query("SELECT u.username, SUM(t.amount) as total_deposit FROM transactions t JOIN users u ON t.user_id = u.id WHERE t.type = 'deposit' GROUP BY t.user_id ORDER BY total_deposit DESC LIMIT :limit");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getAllTransactions() {
        $this->db->query("SELECT t.*, u.username FROM transactions t JOIN users u ON t.user_id = u.id ORDER BY t.id DESC");
        return $this->db->resultSet();
    }

    public function getTotalRevenue() {
        $this->db->query("SELECT SUM(amount) as total FROM transactions WHERE type = 'purchase' AND status = 'completed'");
        $row = $this->db->single();
        return $row ? $row['total'] : 0;
    }

    public function getRecentTransactions($limit = 5) {
        $this->db->query("SELECT t.*, u.username FROM transactions t JOIN users u ON t.user_id = u.id ORDER BY t.id DESC LIMIT :limit");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
}

