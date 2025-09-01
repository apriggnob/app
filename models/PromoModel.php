<?php
class PromoModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getFeaturedPromotions($limit = 3) {
        $query = "SELECT * FROM promotions WHERE is_active = 1 AND is_featured = 1 AND valid_until >= CURDATE() ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $promotions = [];
        while ($row = $result->fetch_assoc()) {
            $promotions[] = $row;
        }
        
        return $promotions;
    }

    public function getActivePromotions() {
        $query = "SELECT * FROM promotions WHERE is_active = 1 AND valid_until >= CURDATE() ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        
        $promotions = [];
        while ($row = $result->fetch_assoc()) {
            $promotions[] = $row;
        }
        
        return $promotions;
    }

    public function getPromotionById($id) {
        $query = "SELECT * FROM promotions WHERE id = ? AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>