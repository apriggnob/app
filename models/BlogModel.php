<?php
class BlogModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getRecentBlogs($limit = 3) {
        $query = "SELECT * FROM blogs WHERE is_published = 1 ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
        
        return $blogs;
    }

    public function getAllBlogs() {
        $query = "SELECT * FROM blogs WHERE is_published = 1 ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        
        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
        
        return $blogs;
    }

    public function getBlogById($id) {
        $query = "SELECT * FROM blogs WHERE id = ? AND is_published = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>