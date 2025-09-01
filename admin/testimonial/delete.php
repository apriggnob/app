<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/TestimonialModel.php';
require_once '../controllers/TestimonialController.php';

$testimonialController = new TestimonialController($conn);

// Get testimonial ID
$id = $_GET['id'] ?? 0;

// Delete testimonial
if ($testimonialController->delete($id)) {
    $_SESSION['success'] = 'Testimonial berhasil dihapus';
} else {
    $_SESSION['error'] = 'Gagal hapus testimonial';
}

header("Location: index.php");
exit();
?>