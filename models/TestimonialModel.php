<?php
class TestimonialModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllTestimonials() {
        $query = "SELECT * FROM testimonials WHERE is_approved = 1 ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        
        $testimonials = [];
        while ($row = $result->fetch_assoc()) {
            $testimonials[] = $row;
        }
        
        return $testimonials;
    }

    public function getFeaturedTestimonials($limit = 3) {
        $query = "SELECT * FROM testimonials WHERE is_approved = 1 ORDER BY rating DESC, created_at DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $testimonials = [];
        while ($row = $result->fetch_assoc()) {
            $testimonials[] = $row;
        }
        
        return $testimonials;
    }
}
?>