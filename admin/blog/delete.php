<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/BlogModel.php';
require_once '../controllers/BlogController.php';

$blogController = new BlogController($conn);

// Get blog ID
$id = $_GET['id'] ?? 0;

// Delete blog
if ($blogController->delete($id)) {
    $_SESSION['success'] = 'Artikel berhasil dihapus';
} else {
    $_SESSION['error'] = 'Gagal hapus artikel';
}

header("Location: index.php");
exit();
?>