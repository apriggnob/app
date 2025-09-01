<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/BlogModel.php';
require_once '../controllers/BlogController.php';

$blogController = new BlogController($conn);

// Get blog ID
$id = $_GET['id'] ?? 0;

// Toggle status
if ($blogController->toggleStatus($id)) {
    $_SESSION['success'] = 'Status artikel berhasil diupdate';
} else {
    $_SESSION['error'] = 'Gagal update status artikel';
}

header("Location: index.php");
exit();
?>