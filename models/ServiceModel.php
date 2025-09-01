<?php
class ServiceModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllServices() {
        $query = "SELECT * FROM services ORDER BY name ASC";
        $result = $this->conn->query($query);
        
        $services = [];
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
        
        return $services;
    }

    public function getServiceById($id) {
        $query = "SELECT * FROM services WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>