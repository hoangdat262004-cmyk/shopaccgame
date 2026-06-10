<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':email', $data['email']);
        return $this->db->execute();
    }

    public function login($username, $password) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        $row = $this->db->single();
        if($row) {
            $hashedPassword = $row['password'];
            if(password_verify($password, $hashedPassword)) {
                return $row;
            }
        }
        return false;
    }

    public function checkUsernameExists($username) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    public function checkEmailExists($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    public function getUserById($id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateBalance($id, $new_balance) {
        $this->db->query("UPDATE users SET balance = :balance WHERE id = :id");
        $this->db->bind(':balance', $new_balance);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getAllUsers() {
        $this->db->query("SELECT * FROM users ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function updateUserRole($id, $role) {
        $this->db->query("UPDATE users SET role = :role WHERE id = :id");
        $this->db->bind(':role', $role);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function deleteUser($id) {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getTotalUsersCount() {
        $this->db->query("SELECT COUNT(*) as count FROM users");
        $row = $this->db->single();
        return $row ? $row['count'] : 0;
    }
}

