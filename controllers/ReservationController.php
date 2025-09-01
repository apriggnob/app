<?php
class ReservationController {
    private $reservationModel;
    private $branchModel;
    private $serviceModel;
    
    public function __construct($conn) {
        $this->reservationModel = new ReservationModel($conn);
        $this->branchModel = new BranchModel($conn);
        $this->serviceModel = new ServiceModel($conn);
    }
    
    public function index() {
        // Get data for reservation page
        $data = [
            'branches' => $this->branchModel->getAllBranches(),
            'services' => $this->serviceModel->getAllServices()
        ];
        
        return $data;
    }
    
    public function processReservation($data) {
        // Process reservation form
        return $this->reservationModel->saveReservation($data);
    }
}
?>