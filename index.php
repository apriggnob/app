<?php
// Start session
session_start();

// Include configuration
require_once 'config.php';

// Include models
require_once 'models/PromoModel.php';
require_once 'models/BlogModel.php';
require_once 'models/ServiceModel.php';
require_once 'models/BranchModel.php';
require_once 'models/TestimonialModel.php';
require_once 'models/ReservationModel.php';

// Include controllers
require_once 'controllers/HomeController.php';
require_once 'controllers/PromoController.php';
require_once 'controllers/BlogController.php';
require_once 'controllers/AboutController.php';
require_once 'controllers/ServiceController.php';
require_once 'controllers/ReservationController.php';

// Proses form reservasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservasi'])) {
    // Validasi input
    $required_fields = ['name', 'phone', 'branch', 'service', 'date', 'time'];
    $errors = [];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Field " . ucfirst($field) . " wajib diisi";
        }
    }
    
    // Validasi tanggal (tidak boleh di masa lalu)
    if (!empty($_POST['date']) && $_POST['date'] < date('Y-m-d')) {
        $errors[] = "Tanggal reservasi tidak boleh di masa lalu";
    }
    
    // Validasi nomor telepon
    if (!empty($_POST['phone']) && !preg_match('/^[0-9]{10,13}$/', $_POST['phone'])) {
        $errors[] = "Nomor telepon tidak valid";
    }
    
    if (empty($errors)) {
        $name = htmlspecialchars($_POST['name']);
        $phone = htmlspecialchars($_POST['phone']);
        $branch = htmlspecialchars($_POST['branch']);
        $service = htmlspecialchars($_POST['service']);
        $date = htmlspecialchars($_POST['date']);
        $time = htmlspecialchars($_POST['time']);
        $message = htmlspecialchars($_POST['message']);
        
        // Get branch phone number based on selected branch
        $branchModel = new BranchModel($conn);
        $branchData = $branchModel->getBranchByName($branch);
        $branch_phone = $branchData ? $branchData['phone'] : '';
        
        // Save to database
        $reservationModel = new ReservationModel($conn);
        $reservationData = [
            'name' => $name,
            'phone' => $phone,
            'branch' => $branch,
            'service' => $service,
            'date' => $date,
            'time' => $time,
            'message' => $message
        ];
        $reservationModel->saveReservation($reservationData);
        
        // Format pesan WhatsApp
        $whatsapp_message = "Halo, saya ingin melakukan reservasi di Arumsari Auto Care%0A%0A" .
                            "*Nama:* " . $name . "%0A" .
                            "*Telepon:* " . $phone . "%0A" .
                            "*Cabang:* " . $branch . "%0A" .
                            "*Layanan:* " . $service . "%0A" .
                            "*Tanggal:* " . $date . "%0A" .
                            "*Waktu:* " . $time . "%0A" .
                            "*Pesan Tambahan:* " . $message;
        
        // Use branch phone number if available, otherwise use default
        $whatsapp_phone = !empty($branch_phone) ? str_replace('-', '', $branch_phone) : '6282325519998';
        
        // Redirect ke WhatsApp
        header("Location: https://api.whatsapp.com/send?phone=" . $whatsapp_phone . "&text=" . $whatsapp_message);
        exit();
    } else {
        // Simpan error di session untuk ditampilkan
        $_SESSION['reservation_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=reservasi");
        exit();
    }
}

// Determine current page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$currentPage = $page;

// Initialize controllers
$homeController = new HomeController($conn);
$promoController = new PromoController($conn);
$blogController = new BlogController($conn);
$aboutController = new AboutController($conn);
$serviceController = new ServiceController($conn);
$reservationController = new ReservationController($conn);

// Get data based on current page
switch ($page) {
    case 'home':
        $data = $homeController->index();
        $featuredPromotions = $data['featuredPromotions'];
        $services = $data['services'];
        $promotions = $data['promotions'];
        $testimonials = $data['testimonials'];
        $recentBlogs = $data['recentBlogs'];
        break;
        
    case 'promo':
        $data = $promoController->index();
        $featuredPromotions = $data['featuredPromotions'];
        $promotions = $data['promotions'];
        break;
        
    case 'promo-detail':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $data = $promoController->detail($id);
        $promo = $data['promo'];
        break;
        
    case 'blog':
        $data = $blogController->index();
        $blogs = $data['blogs'];
        break;
        
    case 'blog-detail':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $data = $blogController->detail($id);
        $blog = $data['blog'];
        break;
        
    case 'about':
        $data = $aboutController->index();
        $branches = $data['branches'];
        $testimonials = $data['testimonials'];
        break;
        
    case 'layanan':
        $data = $serviceController->index();
        $services = $data['services'];
        $testimonials = $data['testimonials'];
        $branches = $data['branches'];
        break;
        
    case 'reservasi':
        $data = $reservationController->index();
        $branches = $data['branches'];
        $services = $data['services'];
        break;
        
    default:
        $data = $homeController->index();
        $featuredPromotions = $data['featuredPromotions'];
        $services = $data['services'];
        $promotions = $data['promotions'];
        $testimonials = $data['testimonials'];
        $recentBlogs = $data['recentBlogs'];
        $page = 'home';
        break;
}

// Include header
require_once 'views/header.php';

// Include content based on current page
switch ($page) {
    case 'home':
        require_once 'views/home.php';
        break;
        
    case 'promo':
        require_once 'views/promo.php';
        break;
        
    case 'promo-detail':
        require_once 'views/promo-detail.php';
        break;
        
    case 'blog':
        require_once 'views/blog.php';
        break;
        
    case 'blog-detail':
        require_once 'views/blog-detail.php';
        break;
        
    case 'about':
        require_once 'views/about.php';
        break;
        
    case 'layanan':
        require_once 'views/layanan.php';
        break;
        
    case 'reservasi':
        require_once 'views/reservasi.php';
        break;
}

// Include footer
require_once 'views/footer.php';
?>