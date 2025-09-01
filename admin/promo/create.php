<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Set page title
$pageTitle = 'Tambah Promo';
$currentPage = 'promo';

// Include layout header
require_once '../views/layout/header.php';

// Include promo create view
require_once '../views/promo/create.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>