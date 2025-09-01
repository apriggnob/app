<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Set page title
$pageTitle = 'Tambah Artikel';
$currentPage = 'blog';

// Include layout header
require_once '../views/layout/header.php';

// Include blog create view
require_once '../views/blog/create.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>