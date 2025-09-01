<?php
class ReservationController {
    private $reservationModel;
    
    public function __construct($conn) {
        $this->reservationModel = new ReservationModel($conn);
    }
    
    public function index() {
        return $this->reservationModel->getAllReservations();
    }
    
    public function updateStatus($id, $status) {
        return $this->reservationModel->updateReservationStatus($id, $status);
    }
}
?>