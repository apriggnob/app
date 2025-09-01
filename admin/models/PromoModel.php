<?php
class PromoModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Get all promotions
    public function getAllPromotions() {
        $query = "SELECT * FROM promotions ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        $promotions = [];
        
        while ($row = $result->fetch_assoc()) {
            $promotions[] = $row;
        }
        
        return $promotions;
    }
    
    // Get promotion by ID
    public function getPromotionById($id) {
        $query = "SELECT * FROM promotions WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
    
    // Create new promotion
    public function createPromotion($data) {
        $query = "INSERT INTO promotions (title, description, image_url, valid_until, is_active, is_featured) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssii", 
            $data['title'], 
            $data['description'], 
            $data['image_url'], 
            $data['valid_until'], 
            $data['is_active'], 
            $data['is_featured']
        );
        
        return $stmt->execute();
    }
    
    // Update promotion
    public function updatePromotion($id, $data) {
        $query = "UPDATE promotions SET title = ?, description = ?, image_url = ?, valid_until = ?, is_active = ?, is_featured = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssiii", 
            $data['title'], 
            $data['description'], 
            $data['image_url'], 
            $data['valid_until'], 
            $data['is_active'], 
            $data['is_featured'], 
            $id
        );
        
        return $stmt->execute();
    }
    
    // Delete promotion
    public function deletePromotion($id) {
        $query = "DELETE FROM promotions WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
    
    // Toggle promotion status
    public function togglePromotionStatus($id) {
        // Get current status
        $query = "SELECT is_active FROM promotions WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $newStatus = $row['is_active'] ? 0 : 1;
        
        // Update status
        $query = "UPDATE promotions SET is_active = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $newStatus, $id);
        
        return $stmt->execute();
    }
}
?>