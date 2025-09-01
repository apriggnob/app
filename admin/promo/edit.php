<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/PromoModel.php';
require_once '../controllers/PromoController.php';

$promoController = new PromoController($conn);

// Get promo ID
$id = $_GET['id'] ?? 0;

// Get promo data
$promo = $promoController->edit($id);

// Set page title
$pageTitle = 'Edit Promo';
$currentPage = 'promo';

// Include layout header
require_once '../views/layout/header.php';

// Include promo edit view
require_once '../views/promo/edit.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>