<?php
class ReservationModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Get all reservations
    public function getAllReservations() {
        $query = "SELECT * FROM reservations ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        $reservations = [];
        
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
        
        return $reservations;
    }
    
    // Get reservation by ID
    public function getReservationById($id) {
        $query = "SELECT * FROM reservations WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
    
    // Update reservation status
    public function updateReservationStatus($id, $status) {
        $query = "UPDATE reservations SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $status, $id);
        
        return $stmt->execute();
    }
}
?>