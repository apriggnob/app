<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/PromoModel.php';
require_once '../controllers/PromoController.php';

$promoController = new PromoController($conn);

// Get promo ID
$id = $_GET['id'] ?? 0;

// Toggle status
if ($promoController->toggleStatus($id)) {
    $_SESSION['success'] = 'Status promo berhasil diupdate';
} else {
    $_SESSION['error'] = 'Gagal update status promo';
}

header("Location: index.php");
exit();
?>