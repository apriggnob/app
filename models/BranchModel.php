<?php
class BranchModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Function to get all branches from database
    public function getAllBranches() {
        $query = "SELECT * FROM branches ORDER BY id ASC";
        $result = $this->conn->query($query);
        $branches = [];
        
        while ($row = $result->fetch_assoc()) {
            $branches[] = $row;
        }
        
        return $branches;
    }
    
    // Function to get branch by name
    public function getBranchByName($name) {
        $query = "SELECT * FROM branches WHERE name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
}
?>