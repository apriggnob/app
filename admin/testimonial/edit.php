<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/TestimonialModel.php';
require_once '../controllers/TestimonialController.php';

$testimonialController = new TestimonialController($conn);

// Get testimonial ID
$id = $_GET['id'] ?? 0;

// Get testimonial data
$testimonial = $testimonialController->edit($id);

// Set page title
$pageTitle = 'Edit Testimonial';
$currentPage = 'testimonial';

// Include layout header
require_once '../views/layout/header.php';

// Include testimonial edit view
require_once '../views/testimonial/edit.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>