<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "admin", " ", "tintuc");
    }

    // Lấy tất cả người dùng
    public function getAllUsers() {
        $result = $this->db->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy người dùng theo ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Thêm người dùng mới
    public function createUser($username, $password, $role) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $username, $password, $role);
        return $stmt->execute();
    }

    // Cập nhật người dùng
    public function updateUser($id, $username, $password, $role) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssii", $username, $password, $role, $id);
        return $stmt->execute();
    }

    // Xóa người dùng
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
