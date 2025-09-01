<?php
require_once 'config.php';
require_once 'auth/check_auth.php';

// Include models
require_once 'models/AdminModel.php';
require_once 'models/PromoModel.php';
require_once 'models/BlogModel.php';
require_once 'models/TestimonialModel.php';
require_once 'models/ReservationModel.php';

// Include controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/PromoController.php';
require_once 'controllers/BlogController.php';
require_once 'controllers/TestimonialController.php';
require_once 'controllers/ReservationController.php';

// Initialize controllers
$dashboardController = new DashboardController($conn);
$promoController = new PromoController($conn);
$blogController = new BlogController($conn);
$testimonialController = new TestimonialController($conn);
$reservationController = new ReservationController($conn);

// Get current page
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$currentPage = $page;

// Page title
$pageTitle = 'Dashboard';
switch ($page) {
    case 'promo':
        $pageTitle = 'Kelola Promo';
        break;
    case 'blog':
        $pageTitle = 'Kelola Blog';
        break;
    case 'testimonial':
        $pageTitle = 'Kelola Testimonial';
        break;
    case 'reservation':
        $pageTitle = 'Kelola Reservasi';
        break;
}

// Include layout header
require_once 'views/layout/header.php';

// Include content based on current page
switch ($page) {
    case 'dashboard':
        $stats = $dashboardController->index();
        require_once 'views/dashboard.php';
        break;
        
    case 'promo':
        require_once 'views/promo/index.php';
        break;
        
    case 'blog':
        require_once 'views/blog/index.php';
        break;
        
    case 'testimonial':
        require_once 'views/testimonial/index.php';
        break;
        
    case 'reservation':
        require_once 'views/reservation/index.php';
        break;
        
    default:
        $stats = $dashboardController->index();
        require_once 'views/dashboard.php';
        break;
}

// Include layout footer
require_once 'views/layout/footer.php';
?>