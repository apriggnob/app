<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/PromoModel.php';
require_once '../controllers/PromoController.php';

$promoController = new PromoController($conn);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'image_url' => $_POST['image_url'],
            'valid_until' => $_POST['valid_until'],
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0
        ];
        
        if ($promoController->create($data)) {
            $_SESSION['success'] = 'Promo berhasil ditambahkan';
        } else {
            $_SESSION['error'] = 'Gagal menambah promo';
        }
        
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'image_url' => $_POST['image_url'],
            'valid_until' => $_POST['valid_until'],
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0
        ];
        
        if ($promoController->update($id, $data)) {
            $_SESSION['success'] = 'Promo berhasil diupdate';
        } else {
            $_SESSION['error'] = 'Gagal update promo';
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
            if ($promoController->delete($id)) {
                $_SESSION['success'] = 'Promo berhasil dihapus';
            } else {
                $_SESSION['error'] = 'Gagal hapus promo';
            }
            header("Location: index.php");
            exit();
            break;
            
        case 'toggle-status':
            if ($promoController->toggleStatus($id)) {
                $_SESSION['success'] = 'Status promo berhasil diupdate';
            } else {
                $_SESSION['error'] = 'Gagal update status promo';
            }
            header("Location: index.php");
            exit();
            break;
    }
}

// Get all promotions
$promotions = $promoController->index();

// Set page title
$pageTitle = 'Kelola Promo';
$currentPage = 'promo';

// Include layout header
require_once '../views/layout/header.php';

// Include promo index view
require_once '../views/promo/index.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>