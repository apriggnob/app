<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/BlogModel.php';
require_once '../controllers/BlogController.php';

$blogController = new BlogController($conn);

// Get blog ID
$id = $_GET['id'] ?? 0;

// Get blog data
$blog = $blogController->edit($id);

// Set page title
$pageTitle = 'Edit Artikel';
$currentPage = 'blog';

// Include layout header
require_once '../views/layout/header.php';

// Include blog edit view
require_once '../views/blog/edit.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>