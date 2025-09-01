<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/BlogModel.php';
require_once '../controllers/BlogController.php';

$blogController = new BlogController($conn);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $data = [
            'title' => $_POST['title'],
            'excerpt' => $_POST['excerpt'],
            'content' => $_POST['content'],
            'image_url' => $_POST['image_url'],
            'author' => $_POST['author'],
            'is_published' => isset($_POST['is_published']) ? 1 : 0
        ];
        
        if ($blogController->create($data)) {
            $_SESSION['success'] = 'Artikel berhasil ditambahkan';
        } else {
            $_SESSION['error'] = 'Gagal menambah artikel';
        }
        
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $data = [
            'title' => $_POST['title'],
            'excerpt' => $_POST['excerpt'],
            'content' => $_POST['content'],
            'image_url' => $_POST['image_url'],
            'author' => $_POST['author'],
            'is_published' => isset($_POST['is_published']) ? 1 : 0
        ];
        
        if ($blogController->update($id, $data)) {
            $_SESSION['success'] = 'Artikel berhasil diupdate';
        } else {
            $_SESSION['error'] = 'Gagal update artikel';
        }
        
        header("Location: index.php");
        exit();
    }
}

// Handle actions
if (isset($_GET['action'])) {
    $id = $_GET['id'];
    
    switch ($_GET['action']) {
        case 'delete':
            if ($blogController->delete($id)) {
                $_SESSION['success'] = 'Artikel berhasil dihapus';
            } else {
                $_SESSION['error'] = 'Gagal hapus artikel';
            }
            header("Location: index.php");
            exit();
            break;
            
        case 'toggle-status':
            if ($blogController->toggleStatus($id)) {
                $_SESSION['success'] = 'Status artikel berhasil diupdate';
            } else {
                $_SESSION['error'] = 'Gagal update status artikel';
            }
            header("Location: index.php");
            exit();
            break;
    }
}

// Get all blogs
$blogs = $blogController->index();

// Set page title
$pageTitle = 'Kelola Blog';
$currentPage = 'blog';

// Include layout header
require_once '../views/layout/header.php';

// Include blog index view
require_once '../views/blog/index.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>