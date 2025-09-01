<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/ReservationModel.php';
require_once '../controllers/ReservationController.php';

$reservationController = new ReservationController($conn);

// Handle status update
if (isset($_GET['status']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    
    if ($reservationController->updateStatus($id, $status)) {
        $_SESSION['success'] = 'Status reservasi berhasil diupdate';
    } else {
        $_SESSION['error'] = 'Gagal update status reservasi';
    }
    
    header("Location: index.php");
    exit();
}

// Get all reservations
$reservations = $reservationController->index();

// Set page title
$pageTitle = 'Kelola Reservasi';
$currentPage = 'reservation';

// Include layout header
require_once '../views/layout/header.php';

// Include reservation index view
require_once '../views/reservation/index.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>