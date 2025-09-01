<?php
class TestimonialModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Get all testimonials
    public function getAllTestimonials() {
        $query = "SELECT * FROM testimonials ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        $testimonials = [];
        
        while ($row = $result->fetch_assoc()) {
            $testimonials[] = $row;
        }
        
        return $testimonials;
    }
    
    // Get testimonial by ID
    public function getTestimonialById($id) {
        $query = "SELECT * FROM testimonials WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
    
    // Create new testimonial
    public function createTestimonial($data) {
        $query = "INSERT INTO testimonials (customer_name, rating, testimonial_text, is_approved) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sisi", 
            $data['customer_name'], 
            $data['rating'], 
            $data['testimonial_text'], 
            $data['is_approved']
        );
        
        return $stmt->execute();
    }
    
    // Update testimonial
    public function updateTestimonial($id, $data) {
        $query = "UPDATE testimonials SET customer_name = ?, rating = ?, testimonial_text = ?, is_approved = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sisi", 
            $data['customer_name'], 
            $data['rating'], 
            $data['testimonial_text'], 
            $data['is_approved'], 
            $id
        );
        
        return $stmt->execute();
    }
    
    // Delete testimonial
    public function deleteTestimonial($id) {
        $query = "DELETE FROM testimonials WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
    
    // Toggle testimonial approval
    public function toggleTestimonialApproval($id) {
        // Get current status
        $query = "SELECT is_approved FROM testimonials WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $newStatus = $row['is_approved'] ? 0 : 1;
        
        // Update status
        $query = "UPDATE testimonials SET is_approved = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $newStatus, $id);
        
        return $stmt->execute();
    }
}
?>