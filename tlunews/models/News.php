<?php
class News {
    private $db;

    public function __construct() {
        $this->db = new mysqli("mysql", "root", "123456789", "tintuc");
    }

    public function getAllNews() {
        $result = $this->db->query("SELECT news.*, categories.name AS category_name FROM news INNER JOIN categories ON news.category_id = categories.id");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNewsById($id) {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createNews($title, $content, $image, $category_id) {
        $stmt = $this->db->prepare("INSERT INTO news (title, content, image, category_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $content, $image, $category_id);
        return $stmt->execute();
    }

    public function updateNews($id, $title, $content, $image, $category_id) {
        $stmt = $this->db->prepare("UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?");
        $stmt->bind_param("sssii", $title, $content, $image, $category_id, $id);
        return $stmt->execute();
    }

    public function deleteNews($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
