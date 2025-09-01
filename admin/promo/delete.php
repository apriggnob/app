<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/PromoModel.php';
require_once '../controllers/PromoController.php';

$promoController = new PromoController($conn);

// Get promo ID
$id = $_GET['id'] ?? 0;

// Delete promo
if ($promoController->delete($id)) {
    $_SESSION['success'] = 'Promo berhasil dihapus';
} else {
    $_SESSION['error'] = 'Gagal hapus promo';
}

header("Location: index.php");
exit();
?>