<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/TestimonialModel.php';
require_once '../controllers/TestimonialController.php';

$testimonialController = new TestimonialController($conn);

// Get testimonial ID
$id = $_GET['id'] ?? 0;

// Toggle approval
if ($testimonialController->toggleApproval($id)) {
    $_SESSION['success'] = 'Status testimonial berhasil diupdate';
} else {
    $_SESSION['error'] = 'Gagal update status testimonial';
}

header("Location: index.php");
exit();
?>