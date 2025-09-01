<?php
class AdminModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Get dashboard statistics
    public function getDashboardStats() {
        $stats = [];
        
        // Total promotions
        $result = $this->conn->query("SELECT COUNT(*) as total FROM promotions");
        $stats['total_promotions'] = $result->fetch_assoc()['total'];
        
        // Active promotions
        $today = date('Y-m-d');
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM promotions WHERE valid_until >= ? AND is_active = 1");
        $stmt->bind_param("s", $today);
        $stmt->execute();
        $result = $stmt->get_result();
        $stats['active_promotions'] = $result->fetch_assoc()['total'];
        
        // Total blogs
        $result = $this->conn->query("SELECT COUNT(*) as total FROM blogs");
        $stats['total_blogs'] = $result->fetch_assoc()['total'];
        
        // Published blogs
        $result = $this->conn->query("SELECT COUNT(*) as total FROM blogs WHERE is_published = 1");
        $stats['published_blogs'] = $result->fetch_assoc()['total'];
        
        // Total testimonials
        $result = $this->conn->query("SELECT COUNT(*) as total FROM testimonials");
        $stats['total_testimonials'] = $result->fetch_assoc()['total'];
        
        // Approved testimonials
        $result = $this->conn->query("SELECT COUNT(*) as total FROM testimonials WHERE is_approved = 1");
        $stats['approved_testimonials'] = $result->fetch_assoc()['total'];
        
        // Total reservations
        $result = $this->conn->query("SELECT COUNT(*) as total FROM reservations");
        $stats['total_reservations'] = $result->fetch_assoc()['total'];
        
        // Pending reservations
        $result = $this->conn->query("SELECT COUNT(*) as total FROM reservations WHERE status = 'pending'");
        $stats['pending_reservations'] = $result->fetch_assoc()['total'];
        
        // Recent reservations
        $result = $this->conn->query("SELECT * FROM reservations ORDER BY created_at DESC LIMIT 5");
        $stats['recent_reservations'] = [];
        while ($row = $result->fetch_assoc()) {
            $stats['recent_reservations'][] = $row;
        }
        
        return $stats;
    }
}
?>