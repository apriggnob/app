<?php
class ReservationModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Function to save reservation
    public function saveReservation($data) {
        // Check if status column exists
        $hasStatus = $this->columnExists('reservations', 'status');
        
        if ($hasStatus) {
            $query = "INSERT INTO reservations (name, phone, branch, service, reservation_date, reservation_time, message, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";
        } else {
            $query = "INSERT INTO reservations (name, phone, branch, service, reservation_date, reservation_time, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssss", 
            $data['name'], 
            $data['phone'], 
            $data['branch'], 
            $data['service'], 
            $data['date'], 
            $data['time'], 
            $data['message']
        );
        
        return $stmt->execute();
    }
    
    // Function to check if column exists
    private function columnExists($tableName, $columnName) {
        $result = $this->conn->query("SHOW COLUMNS FROM `$tableName` LIKE '$columnName'");
        return $result->num_rows > 0;
    }
}
?>