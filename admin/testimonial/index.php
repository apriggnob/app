<?php
require_once '../config.php';
require_once '../auth/check_auth.php';

// Include models and controllers
require_once '../models/TestimonialModel.php';
require_once '../controllers/TestimonialController.php';

$testimonialController = new TestimonialController($conn);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $data = [
            'customer_name' => $_POST['customer_name'],
            'rating' => $_POST['rating'],
            'testimonial_text' => $_POST['testimonial_text'],
            'is_approved' => isset($_POST['is_approved']) ? 1 : 0
        ];
        
        if ($testimonialController->create($data)) {
            $_SESSION['success'] = 'Testimonial berhasil ditambahkan';
        } else {
            $_SESSION['error'] = 'Gagal menambah testimonial';
        }
        
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $data = [
            'customer_name' => $_POST['customer_name'],
            'rating' => $_POST['rating'],
            'testimonial_text' => $_POST['testimonial_text'],
            'is_approved' => isset($_POST['is_approved']) ? 1 : 0
        ];
        
        if ($testimonialController->update($id, $data)) {
            $_SESSION['success'] = 'Testimonial berhasil diupdate';
        } else {
            $_SESSION['error'] = 'Gagal update testimonial';
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
            if ($testimonialController->delete($id)) {
                $_SESSION['success'] = 'Testimonial berhasil dihapus';
            } else {
                $_SESSION['error'] = 'Gagal hapus testimonial';
            }
            header("Location: index.php");
            exit();
            break;
            
        case 'toggle-approval':
            if ($testimonialController->toggleApproval($id)) {
                $_SESSION['success'] = 'Status testimonial berhasil diupdate';
            } else {
                $_SESSION['error'] = 'Gagal update status testimonial';
            }
            header("Location: index.php");
            exit();
            break;
    }
}

// Get all testimonials
$testimonials = $testimonialController->index();

// Set page title
$pageTitle = 'Kelola Testimonial';
$currentPage = 'testimonial';

// Include layout header
require_once '../views/layout/header.php';

// Include testimonial index view
require_once '../views/testimonial/index.php';

// Include layout footer
require_once '../views/layout/footer.php';
?>