<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Set page title
$pageTitle = 'Tambah Testimonial';
$currentPage = 'testimonial';

// Include layout header
require_once '../views/layout/header.php';

// Include testimonial create view
require_once '../views/testimonial/create.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>