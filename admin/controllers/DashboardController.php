<?php
class DashboardController {
    private $adminModel;
    
    public function __construct($conn) {
        $this->adminModel = new AdminModel($conn);
    }
    
    public function index() {
        return $this->adminModel->getDashboardStats();
    }
}
?>