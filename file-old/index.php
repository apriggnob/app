<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'u1544385_admin-app-asac');
define('DB_PASS', 'qWe4tyUUU123');
define('DB_NAME', 'u1544385_ASAC_APP');

// Create database connection with error handling
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    // Display error message in development, log in production
    error_log("Database connection error: " . $e->getMessage());
    
    // For development - show error
    echo "<div style='padding: 20px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin: 20px;'>";
    echo "<h3>Database Connection Error</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration.</p>";
    echo "</div>";
    
    // Stop execution
    die();
}

// Function to check if table exists
function tableExists($conn, $tableName) {
    $result = $conn->query("SHOW TABLES LIKE '$tableName'");
    return $result->num_rows > 0;
}

// Function to check if column exists in table
function columnExists($conn, $tableName, $columnName) {
    $result = $conn->query("SHOW COLUMNS FROM `$tableName` LIKE '$columnName'");
    return $result->num_rows > 0;
}

// Function to add column if not exists
function addColumnIfNotExists($conn, $tableName, $columnName, $columnDefinition) {
    if (!columnExists($conn, $tableName, $columnName)) {
        $conn->query("ALTER TABLE `$tableName` ADD COLUMN `$columnName` $columnDefinition");
        return true;
    }
    return false;
}

// Create tables if they don't exist
// Table for branches
if (!tableExists($conn, 'branches')) {
    $branchesTable = "CREATE TABLE branches (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        address TEXT NOT NULL,
        phone VARCHAR(20) NOT NULL,
        map_url VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($branchesTable);
}

// Table for services
if (!tableExists($conn, 'services')) {
    $servicesTable = "CREATE TABLE services (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        icon VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($servicesTable);
}

// Table for promotions
if (!tableExists($conn, 'promotions')) {
    $promotionsTable = "CREATE TABLE promotions (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        description TEXT NOT NULL,
        image_url VARCHAR(255),
        valid_until DATE NOT NULL,
        is_active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($promotionsTable);
} else {
    // Add is_featured column if not exists
    addColumnIfNotExists($conn, 'promotions', 'is_featured', 'TINYINT(1) DEFAULT 0');
}

// Table for reservations
if (!tableExists($conn, 'reservations')) {
    $reservationsTable = "CREATE TABLE reservations (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        branch VARCHAR(50) NOT NULL,
        service VARCHAR(100) NOT NULL,
        reservation_date DATE NOT NULL,
        reservation_time TIME NOT NULL,
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($reservationsTable);
} else {
    // Add status column if not exists
    addColumnIfNotExists($conn, 'reservations', 'status', "ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending'");
}

// Table for testimonials
if (!tableExists($conn, 'testimonials')) {
    $testimonialsTable = "CREATE TABLE testimonials (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(100) NOT NULL,
        rating INT(1) NOT NULL,
        testimonial_text TEXT NOT NULL,
        is_approved TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($testimonialsTable);
}

// Table for blog/articles
if (!tableExists($conn, 'blogs')) {
    $blogsTable = "CREATE TABLE blogs (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        excerpt TEXT,
        image_url VARCHAR(255),
        author VARCHAR(100) DEFAULT 'Admin',
        is_published TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($blogsTable);
}

// Insert default data if tables are empty
// Check if branches table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM branches");
if ($result->fetch_assoc()['count'] == 0) {
    // Insert branches
    $branches = [
        ["Purwokerto (Pusat)", "Jl. Sultan Agung No. 11 B, Karangkelsem Purwokerto Selatan Kab. Banyumas 53144", "0823-2551-9998", "https://maps.app.goo.gl/xTpYR5Dae48oN74x9"],
        ["Tasikmalaya", "Jl. Letjen Mashudi No.102, Mulyasari, Kec. Tamansari, Kab. Tasikmalaya, Jawa Barat 46196", "0823-2366-1185", "https://maps.app.goo.gl/1Jwfubx6HX8KUzSs7"],
        ["Bandung", "Jl. Raya Soreang-Cipatik No.79, Gajahmekar, Kec. Kutawaringin, Kabupaten Bandung, Jawa Barat 40911", "0813-9984-1000", "https://maps.app.goo.gl/hyef5Fq419dsFae88"]
    ];
    
    foreach ($branches as $branch) {
        $stmt = $conn->prepare("INSERT INTO branches (name, address, phone, map_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $branch[0], $branch[1], $branch[2], $branch[3]);
        $stmt->execute();
    }
}

// Check if services table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM services");
if ($result->fetch_assoc()['count'] == 0) {
    // Insert services
    $services = [
        ["Perawatan Berkala", "Perawatan rutin untuk menjaga performa kendaraan", "fas fa-tools"],
        ["Tune Up", "Penyetelan mesin untuk performa optimal", "fas fa-cogs"],
        ["Kaki Kaki (Understeel)", "Perbaikan sistem understeel kendaraan", "fas fa-cog"],
        ["AC Mobil", "Servis dan perbaikan AC kendaraan", "fas fa-fan"],
        ["Shaking Machine", "Penyeimbangan roda profesional", "fas fa-balance-scale"],
        ["Bubut Cakram", "Perbaikan permukaan cakram rem", "fas fa-compact-disc"],
        ["Rem", "Servis dan penggantian sistem pengereman", "fas fa-car-brake"],
        ["Nano Coating", "Pelapisan nano untuk perlindungan cat", "fas fa-spray-can"],
        ["Ganti Oli", "Penggantian oli mesin dengan bahan terbaik", "fas fa-oil-can"],
        ["Spooring & Balancing", "Penyeimbangan dan penyetelan roda", "fas fa-align-center"]
    ];
    
    foreach ($services as $service) {
        $stmt = $conn->prepare("INSERT INTO services (name, description, icon) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $service[0], $service[1], $service[2]);
        $stmt->execute();
    }
}

// Check if promotions table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM promotions");
if ($result->fetch_assoc()['count'] == 0) {
    // Check if is_featured column exists
    $hasFeatured = columnExists($conn, 'promotions', 'is_featured');
    
    // Insert promotions including the new Grand Opening
    $promotions = [
        ["Grand Opening Bandung Express", "Diskon 25% untuk semua layanan dan gratis cek kendaraan", "https://images.unsplash.com/photo-1554224712-d8560f709cbe?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", "2025-09-13", $hasFeatured ? 1 : 0],
        ["Service Gratis 5x", "Untuk pembelian paket service tahunan", "https://images.unsplash.com/photo-1567899378494-47b22b2df511?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", "2023-09-30", 0],
        ["Diskon Oli 20%", "Khusus untuk pelanggan baru", "https://images.unsplash.com/photo-1551524160-7559127343a0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", "2023-08-31", 0],
        ["Cashback 15%", "Untuk layanan body repair dan pengecatan", "https://images.unsplash.com/photo-1603712610494-7e28343a3cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", "2023-10-15", 0],
        ["Beli 4 Bayar 3", "Untuk pembelian ban merek tertentu", "https://images.unsplash.com/photo-1567337710282-00832d2155c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", "2023-11-30", 0],
        ["Nano Coating 30%", "Diskon khusus nano coating", "https://images.unsplash.com/photo-1621905252507-b35492cc74b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", "2023-12-31", 0],
        ["Service AC 25%", "Diskon service AC mobil", "https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", "2023-11-20", 0]
    ];
    
    foreach ($promotions as $promo) {
        if ($hasFeatured) {
            $stmt = $conn->prepare("INSERT INTO promotions (title, description, image_url, valid_until, is_featured) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $promo[0], $promo[1], $promo[2], $promo[3], $promo[4]);
        } else {
            $stmt = $conn->prepare("INSERT INTO promotions (title, description, image_url, valid_until) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $promo[0], $promo[1], $promo[2], $promo[3]);
        }
        $stmt->execute();
    }
}

// Check if testimonials table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM testimonials");
if ($result->fetch_assoc()['count'] == 0) {
    // Insert testimonials
    $testimonials = [
        ["Andi Pratama", 5, "Pelayanan sangat memuaskan, teknisi ramah dan profesional. Harga terjangkau dengan kualitas terbaik. Pasti akan kembali lagi!"],
        ["Siti Nurhaliza", 5, "AC mobil saya yang bermasalah langsung diperbaiki dengan cepat. Suhu kembali dingin seperti baru. Terima kasih Arumsari Auto Care!"],
        ["Budi Santoso", 4, "Spooring dan balancing dilakukan dengan teliti. Mobil terasa lebih stabil saat dikendarai. Recommended bengkel!"],
        ["Dewi Lestari", 5, "Ganti oli dengan cepat dan harga bersaing. Pelayanannya ramah dan informatif. Puas sekali!"]
    ];
    
    foreach ($testimonials as $testimonial) {
        $stmt = $conn->prepare("INSERT INTO testimonials (customer_name, rating, testimonial_text, is_approved) VALUES (?, ?, ?, 1)");
        $stmt->bind_param("sis", $testimonial[0], $testimonial[1], $testimonial[2]);
        $stmt->execute();
    }
}

// Check if blogs table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM blogs");
if ($result->fetch_assoc()['count'] == 0) {
    // Insert blogs
    $blogs = [
        [
            "Tips Merawat Mobil Saat Musim Hujan", 
            "Musim hujan telah tiba, tentunya kita perlu mempersiapkan kendaraan kita agar tetap prima dan aman saat digunakan. Berikut beberapa tips merawat mobil saat musim hujan yang bisa Anda lakukan.", 
            "Musim hujan telah tiba, tentunya kita perlu mempersiapkan kendaraan kita agar tetap prima dan aman saat digunakan.",
            "https://images.unsplash.com/photo-1554224712-d8560f709cbe?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
        ],
        [
            "Pentingnya Mengganti Oli Secara Berkala", 
            "Oli mesin memiliki peran yang sangat vital dalam performa kendaraan Anda. Mengganti oli secara berkala adalah salah satu perawatan paling penting yang harus dilakukan untuk menjaga kondisi mesin mobil tetap prima.", 
            "Oli mesin memiliki peran yang sangat vital dalam performa kendaraan Anda.",
            "https://images.unsplash.com/photo-1551524160-7559127343a0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
        ],
        [
            "Tanda-Tanda AC Mobil Perlu Diperbaiki", 
            "AC mobil yang tidak berfungsi dengan baik tentunya akan membuat perjalanan Anda menjadi tidak nyaman, terutama di cuaca yang panas. Berikut beberapa tanda-tanda AC mobil Anda perlu diperbaiki.", 
            "AC mobil yang tidak berfungsi dengan baik tentunya akan membuat perjalanan Anda menjadi tidak nyaman.",
            "https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
        ]
    ];
    
    foreach ($blogs as $blog) {
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, excerpt, image_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $blog[0], $blog[1], $blog[2], $blog[3]);
        $stmt->execute();
    }
}

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
        $branch_phone = '';
        $stmt = $conn->prepare("SELECT phone FROM branches WHERE name = ?");
        $stmt->bind_param("s", $branch);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $branch_phone = $row['phone'];
        }
        
        // Check if status column exists
        $hasStatus = columnExists($conn, 'reservations', 'status');
        
        // Save to database
        if ($hasStatus) {
            $stmt = $conn->prepare("INSERT INTO reservations (name, phone, branch, service, reservation_date, reservation_time, message, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
        } else {
            $stmt = $conn->prepare("INSERT INTO reservations (name, phone, branch, service, reservation_date, reservation_time, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bind_param("sssssss", $name, $phone, $branch, $service, $date, $time, $message);
        $stmt->execute();
        
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
        session_start();
        $_SESSION['reservation_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header("Location: " . $_SERVER['PHP_SELF'] . "#reservasi");
        exit();
    }
}

// Function to get promotions from database
function getPromotions($conn) {
    $today = date('Y-m-d');
    
    // Check if is_featured column exists
    $hasFeatured = columnExists($conn, 'promotions', 'is_featured');
    
    if ($hasFeatured) {
        $query = "SELECT * FROM promotions WHERE valid_until >= ? AND is_active = 1 ORDER BY is_featured DESC, valid_until ASC";
    } else {
        $query = "SELECT * FROM promotions WHERE valid_until >= ? AND is_active = 1 ORDER BY valid_until ASC";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();
    $promotions = [];
    
    while ($row = $result->fetch_assoc()) {
        $promotions[] = $row;
    }
    
    return $promotions;
}

// Function to get featured promotions from database
function getFeaturedPromotions($conn) {
    $today = date('Y-m-d');
    
    // Check if is_featured column exists
    $hasFeatured = columnExists($conn, 'promotions', 'is_featured');
    
    if ($hasFeatured) {
        $query = "SELECT * FROM promotions WHERE valid_until >= ? AND is_active = 1 AND is_featured = 1 ORDER BY valid_until ASC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $today);
        $stmt->execute();
        $result = $stmt->get_result();
        $promotions = [];
        
        while ($row = $result->fetch_assoc()) {
            $promotions[] = $row;
        }
    } else {
        // If is_featured doesn't exist, return empty array
        $promotions = [];
    }
    
    return $promotions;
}

// Function to get services from database
function getServices($conn) {
    $query = "SELECT * FROM services ORDER BY id ASC";
    $result = $conn->query($query);
    $services = [];
    
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
    
    return $services;
}

// Function to get branches from database
function getBranches($conn) {
    $query = "SELECT * FROM branches ORDER BY id ASC";
    $result = $conn->query($query);
    $branches = [];
    
    while ($row = $result->fetch_assoc()) {
        $branches[] = $row;
    }
    
    return $branches;
}

// Function to get testimonials from database
function getTestimonials($conn) {
    $query = "SELECT * FROM testimonials WHERE is_approved = 1 ORDER BY created_at DESC";
    $result = $conn->query($query);
    $testimonials = [];
    
    while ($row = $result->fetch_assoc()) {
        $testimonials[] = $row;
    }
    
    return $testimonials;
}

// Function to get blogs from database
function getBlogs($conn, $limit = 0) {
    $query = "SELECT * FROM blogs WHERE is_published = 1 ORDER BY created_at DESC";
    if ($limit > 0) {
        $query .= " LIMIT " . intval($limit);
    }
    $result = $conn->query($query);
    $blogs = [];
    
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
    
    return $blogs;
}

// Get data from database
$promotions = getPromotions($conn);
$featuredPromotions = getFeaturedPromotions($conn);
$services = getServices($conn);
$branches = getBranches($conn);
$testimonials = getTestimonials($conn);
$blogs = getBlogs($conn);
$recentBlogs = getBlogs($conn, 3);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Arumsari Auto Care - Layanan Bengkel Mobil Profesional Sejak 1995">
    <meta name="keywords" content="bengkel mobil, service mobil, spooring, balancing, ganti oli, AC mobil">
    <meta name="author" content="Arumsari Auto Care">
    <title>Arumsari Auto Care - Layanan Bengkel Mobil Profesional</title>
    
    <!-- Favicon -->
    <link rel="icon" href="https://bengkelkakimobil.com/wp-content/uploads/2023/01/bengkel-kaki-mobil-purwokerto2-bengkelkakimobil.com_.png" type="image/x-icon">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    
    <!-- Manifest for PWA -->
    <link rel="manifest" href="data:application/json;base64,eyJuYW1lIjoiQXJ1bXNhcmkgQXV0byBDYXJlIiwic2hvcnRfbmFtZSI6IkFBQyIsInN0YXJ0X3VybCI6Ii4iLCJkaXNwbGF5Ijoic3RhbmRhbG9uZSIsImJhY2tncm91bmRfY29sb3IiOiIjZmZmZmZmIiwidGhlbWVfY29sb3IiOiIjMWE2ZmM0Iiwib3JpZW50YXRpb24iOiJwb3J0cmFpdCJ9">
    
    <!-- iOS Support -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Arumsari Auto Care">
    
    <style>
        :root {
            --primary: #1a6fc4;
            --primary-dark: #0d4a85;
            --secondary: #ffcc00;
            --accent: #ff6b35;
            --light: #f8f9fa;
            --dark: #333;
            --gray: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: var(--light);
            color: var(--dark);
            padding-bottom: 80px;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 100%;
            padding: 0 15px;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo {
            height: 50px;
            width: auto;
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        .logo-text {
            font-size: 20px;
            font-weight: bold;
        }
        
        .logo-text span {
            color: var(--secondary);
        }
        
        .slogan {
            font-size: 14px;
            opacity: 0.9;
            max-width: 500px;
        }
        
        .page {
            display: none;
            padding: 20px 0;
            animation: fadeIn 0.4s ease;
        }
        
        .active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80') no-repeat center center;
            background-size: cover;
            height: 200px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(26, 111, 196, 0.3), transparent);
        }
        
        .hero-text {
            color: white;
            text-align: center;
            z-index: 1;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
            padding: 0 15px;
        }
        
        .hero-text h2 {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: 600;
            animation: slideDown 0.8s ease;
        }
        
        .hero-text p {
            font-size: 14px;
            animation: slideUp 0.8s ease;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .card h3 {
            color: var(--primary);
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f0f0;
            font-weight: 600;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card h3 i {
            color: var(--accent);
        }
        
        .service-list {
            list-style-type: none;
        }
        
        .service-list li {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            transition: background-color 0.2s;
        }
        
        .service-list li:hover {
            background-color: #f9f9f9;
            padding-left: 8px;
        }
        
        .service-list li:last-child {
            border-bottom: none;
        }
        
        .service-list i {
            color: var(--primary);
            margin-right: 12px;
            font-size: 18px;
            min-width: 24px;
            text-align: center;
        }
        
        .branch-card {
            display: flex;
            margin-bottom: 20px;
            align-items: flex-start;
            background: #f9fafb;
            padding: 16px;
            border-radius: 12px;
            transition: transform 0.3s;
        }
        
        .branch-card:hover {
            transform: translateX(5px);
            background: #f0f4f8;
        }
        
        .branch-icon {
            background: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            flex-shrink: 0;
            font-size: 20px;
        }
        
        .branch-info {
            flex: 1;
        }
        
        .branch-info h4 {
            color: var(--primary-dark);
            margin-bottom: 6px;
            font-weight: 600;
        }
        
        .branch-info p {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 8px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }
        
        .branch-info p i {
            color: var(--primary);
            margin-top: 4px;
        }
        
        .branch-info a {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            transition: color 0.2s;
        }
        
        .branch-info a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .promo-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .promo-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            height: 160px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .promo-card:hover {
            transform: scale(1.03);
        }
        
        .promo-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .promo-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 16px;
        }
        
        .promo-content h4 {
            margin-bottom: 6px;
            font-weight: 600;
        }
        
        .promo-content p {
            font-size: 13px;
            margin-bottom: 6px;
            opacity: 0.9;
        }
        
        .promo-content small {
            font-size: 12px;
            opacity: 0.8;
        }
        
        .featured-promo {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            height: 220px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 24px;
            transition: transform 0.3s;
        }
        
        .featured-promo:hover {
            transform: translateY(-5px);
        }
        
        .featured-promo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .featured-promo-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(26, 111, 196, 0.85), rgba(13, 74, 133, 0.9));
            color: white;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .featured-promo-content h3 {
            font-size: 28px;
            margin-bottom: 12px;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        
        .featured-promo-content p {
            font-size: 16px;
            margin-bottom: 16px;
            opacity: 0.95;
        }
        
        .featured-promo-content .date-badge {
            display: inline-block;
            background: var(--secondary);
            color: var(--primary-dark);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 111, 196, 0.2);
        }
        
        .btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s, transform 0.2s;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-whatsapp {
            background: #25D366;
        }
        
        .btn-whatsapp:hover {
            background: #128C7E;
        }
        
        .contact-info {
            text-align: center;
            padding: 20px 0;
        }
        
        .contact-info h3 {
            color: var(--primary);
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .contact-info p {
            margin-bottom: 12px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .contact-info i {
            color: var(--primary);
            font-size: 20px;
        }
        
        .social-media {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            font-size: 20px;
            transition: transform 0.3s, background 0.3s;
            text-decoration: none;
        }
        
        .social-icon:hover {
            transform: translateY(-5px);
        }
        
        .social-icon.facebook {
            background: #3b5998;
        }
        
        .social-icon.instagram {
            background: #E1306C;
        }
        
        .social-icon.tiktok {
            background: #000000;
        }
        
        .social-icon.youtube {
            background: #FF0000;
        }
        
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            display: flex;
            justify-content: space-around;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 8px 0;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
        
        .nav-item {
            padding: 8px 0;
            text-align: center;
            flex: 1;
            cursor: pointer;
            transition: color 0.3s;
            color: var(--gray);
            position: relative;
        }
        
        .nav-item.active {
            color: var(--primary);
        }
        
        .nav-item.active::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 24px;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
        }
        
        .nav-item i {
            font-size: 20px;
            display: block;
            margin: 0 auto 4px;
            transition: transform 0.3s;
        }
        
        .nav-item.active i {
            transform: scale(1.15);
        }
        
        .nav-text {
            font-size: 12px;
            font-weight: 500;
        }
        
        footer {
            text-align: center;
            padding: 24px;
            color: var(--gray);
            font-size: 14px;
            background: #f0f0f0;
            border-top: 1px solid #ddd;
            margin-top: 40px;
        }
        
        .copyright {
            font-weight: 500;
        }
        
        /* Alert/Notification */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.5s ease;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-danger i {
            color: var(--danger);
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-success i {
            color: var(--success);
        }
        
        /* Testimonial Section */
        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
        }
        
        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .testimonial-info h4 {
            margin: 0;
            font-size: 16px;
            color: var(--primary-dark);
        }
        
        .testimonial-info .rating {
            color: var(--secondary);
            margin-top: 3px;
        }
        
        .testimonial-text {
            font-style: italic;
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* FAQ Section */
        .faq-item {
            margin-bottom: 15px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .faq-question {
            background: white;
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .faq-question:hover {
            background: #f8f9fa;
        }
        
        .faq-question.active {
            background: var(--primary);
            color: white;
        }
        
        .faq-icon {
            transition: transform 0.3s;
        }
        
        .faq-question.active .faq-icon {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            background: white;
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }
        
        .faq-answer.active {
            padding: 15px 20px;
            max-height: 300px;
        }
        
        /* Gallery Section */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .gallery-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            height: 150px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .gallery-item:hover {
            transform: scale(1.03);
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: white;
            padding: 10px;
            font-size: 12px;
            text-align: center;
        }
        
        /* Blog Section */
        .blog-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }
        
        .blog-card:hover {
            transform: translateY(-5px);
        }
        
        .blog-image {
            height: 160px;
            overflow: hidden;
        }
        
        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        
        .blog-card:hover .blog-image img {
            transform: scale(1.05);
        }
        
        .blog-content {
            padding: 20px;
        }
        
        .blog-content h4 {
            color: var(--primary-dark);
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 18px;
        }
        
        .blog-content p {
            color: var(--gray);
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .blog-meta {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--gray);
        }
        
        .blog-author {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .blog-date {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        /* Loading Animation */
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
        
        /* Responsive Design */
        @media (min-width: 480px) {
            .header-content {
                flex-direction: row;
                justify-content: center;
                gap: 15px;
            }
            
            .hero {
                height: 220px;
            }
            
            .hero-text h2 {
                font-size: 28px;
            }
        }
        
        @media (min-width: 768px) {
            .container {
                max-width: 720px;
                margin: 0 auto;
            }
            
            .promo-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .branches {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            
            .service-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
            
            .form-row {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
            
            .hero {
                height: 280px;
            }
            
            .hero-text h2 {
                font-size: 36px;
            }
            
            .promo-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .gallery-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo-container">
                    <img src="https://bengkelkakimobil.com/wp-content/uploads/2023/01/bengkel-kaki-mobil-purwokerto2-bengkelkakimobil.com_.png" alt="Arumsari Auto Care Logo" class="logo">
                    <div class="logo-text">ARUM<span>SARI</span> AUTO CARE</div>
                </div>
                <div class="slogan">Layanan Profesional untuk Kendaraan Anda</div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <!-- Home Page -->
        <div id="home" class="page active">
            <!-- Featured Promo - Grand Opening -->
            <?php if (!empty($featuredPromotions)): ?>
            <?php foreach ($featuredPromotions as $promo): ?>
            <div class="featured-promo">
                <img src="<?php echo $promo['image_url']; ?>" alt="<?php echo $promo['title']; ?>">
                <div class="featured-promo-content">
                    <h3><?php echo $promo['title']; ?></h3>
                    <p><?php echo $promo['description']; ?></p>
                    <div class="date-badge">
                        <i class="fas fa-calendar-alt"></i> <?php echo date('d F Y', strtotime($promo['valid_until'])); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            
            <div class="hero">
                <div class="hero-text">
                    <h2>Selamat Datang</h2>
                    <p>Layanan Bengkel Terpercaya Sejak 1995</p>
                </div>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-concierge-bell"></i> Layanan Kami</h3>
                <div class="service-grid">
                    <ul class="service-list">
                        <?php foreach (array_slice($services, 0, 5) as $service): ?>
                        <li><i class="<?php echo $service['icon']; ?>"></i> <?php echo $service['name']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="service-list">
                        <?php foreach (array_slice($services, 5, 5) as $service): ?>
                        <li><i class="<?php echo $service['icon']; ?>"></i> <?php echo $service['name']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-tag"></i> Promo Spesial</h3>
                <div class="promo-grid">
                    <?php foreach (array_slice($promotions, 0, 3) as $promo): ?>
                    <div class="promo-card">
                        <img src="<?php echo $promo['image_url']; ?>" alt="<?php echo $promo['title']; ?>">
                        <div class="promo-content">
                            <h4><?php echo $promo['title']; ?></h4>
                            <p><?php echo $promo['description']; ?></p>
                            <small>Berlaku hingga <?php echo date('d F Y', strtotime($promo['valid_until'])); ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-quote-left"></i> Testimoni Pelanggan</h3>
                <?php foreach (array_slice($testimonials, 0, 2) as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar"><?php echo substr($testimonial['customer_name'], 0, 1); ?></div>
                        <div class="testimonial-info">
                            <h4><?php echo $testimonial['customer_name']; ?></h4>
                            <div class="rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star<?php echo $i <= $testimonial['rating'] ? '' : '-o'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-text">
                        "<?php echo $testimonial['testimonial_text']; ?>"
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-newspaper"></i> Artikel Terbaru</h3>
                <?php foreach ($recentBlogs as $blog): ?>
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="<?php echo $blog['image_url']; ?>" alt="<?php echo $blog['title']; ?>">
                    </div>
                    <div class="blog-content">
                        <h4><?php echo $blog['title']; ?></h4>
                        <p><?php echo $blog['excerpt']; ?></p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <i class="fas fa-user"></i> <?php echo $blog['author']; ?>
                            </div>
                            <div class="blog-date">
                                <i class="fas fa-calendar"></i> <?php echo date('d M Y', strtotime($blog['created_at'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- About Page -->
        <div id="about" class="page">
            <div class="card">
                <h3><i class="fas fa-info-circle"></i> Tentang Kami</h3>
                <p>Arumsari Auto Care telah melayani kebutuhan perawatan dan perbaikan kendaraan sejak tahun 1995. Kami berkomitmen memberikan layanan terbaik dengan teknisi berpengalaman dan peralatan modern.</p>
                <p>Visi kami menjadi bengkel terdepan yang memberikan solusi lengkap untuk semua kebutuhan kendaraan Anda.</p>
                <p>Misi kami adalah memberikan pelayanan berkualitas dengan harga kompetitif, menggunakan suku cadang asli, dan menjamin kepuasan pelanggan.</p>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-map-marker-alt"></i> Cabang Kami</h3>
                <div class="branches">
                    <?php foreach ($branches as $branch): ?>
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="branch-info">
                            <h4><?php echo $branch['name']; ?></h4>
                            <p><i class="fas fa-building"></i> <?php echo $branch['name']; ?></p>
                            <p><i class="fas fa-phone"></i> <?php echo $branch['phone']; ?></p>
                            <p><i class="fas fa-map-pin"></i> <?php echo $branch['address']; ?></p>
                            <a href="<?php echo $branch['map_url']; ?>" target="_blank"><i class="fas fa-location-arrow"></i> Lihat di Google Maps</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-question-circle"></i> FAQ</h3>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah perlu membuat janji temu sebelum datang?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Ya, sangat disarankan untuk membuat reservasi terlebih dahulu agar kami dapat menyiapkan peralatan dan teknisi yang sesuai dengan kebutuhan kendaraan Anda.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah suku cadang yang digunakan asli?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Kami menyediakan pilihan suku cadang asli dan alternatif dengan kualitas terjamin. Tim kami akan memberikan rekomendasi terbaik sesuai kebutuhan dan anggaran Anda.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Berapa lama waktu pengerjaan umumnya?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Waktu pengerjaan tergantung pada jenis layanan. Untuk perawatan berkala umumnya memakan waktu 1-2 jam, sementara untuk perbaikan khusus bisa memakan waktu lebih lama. Kami akan memberikan estimasi waktu saat pemeriksaan awal.</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="contact-info">
                    <h3><i class="fas fa-share-alt"></i> Media Sosial Kami</h3>
                    <div class="social-media">
                        <a href="https://www.facebook.com/arumsariautocare" target="_blank" class="social-icon facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/arumsariautocare" target="_blank" class="social-icon instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="http://tiktok.com/@arumsariautocare_" target="_blank" class="social-icon tiktok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://youtube.com/@arumsariautocare" target="_blank" class="social-icon youtube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reservasi Page -->
        <div id="reservasi" class="page">
            <div class="card">
                <h3><i class="fas fa-calendar-check"></i> Reservasi Layanan</h3>
                <?php
                if (isset($_SESSION['reservation_errors'])) {
                    echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ';
                    echo implode('<br>', $_SESSION['reservation_errors']);
                    echo '</div>';
                    unset($_SESSION['reservation_errors']);
                }
                ?>
                <form method="post" id="reservation-form">
                    <input type="hidden" name="reservasi" value="1">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" required value="<?php echo isset($_SESSION['form_data']['name']) ? htmlspecialchars($_SESSION['form_data']['name']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required value="<?php echo isset($_SESSION['form_data']['phone']) ? htmlspecialchars($_SESSION['form_data']['phone']) : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="branch">Pilih Cabang</label>
                            <select id="branch" name="branch" class="form-control" required>
                                <option value="">-- Pilih Cabang --</option>
                                <?php foreach ($branches as $branch): ?>
                                <option value="<?php echo $branch['name']; ?>" <?php echo (isset($_SESSION['form_data']['branch']) && $_SESSION['form_data']['branch'] == $branch['name']) ? 'selected' : ''; ?>><?php echo $branch['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="service">Jenis Layanan</label>
                            <select id="service" name="service" class="form-control" required>
                                <option value="">-- Pilih Layanan --</option>
                                <?php foreach ($services as $service): ?>
                                <option value="<?php echo $service['name']; ?>" <?php echo (isset($_SESSION['form_data']['service']) && $_SESSION['form_data']['service'] == $service['name']) ? 'selected' : ''; ?>><?php echo $service['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="date">Tanggal Reservasi</label>
                            <input type="date" id="date" name="date" class="form-control" required value="<?php echo isset($_SESSION['form_data']['date']) ? htmlspecialchars($_SESSION['form_data']['date']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="time">Waktu Reservasi</label>
                            <input type="time" id="time" name="time" class="form-control" required value="<?php echo isset($_SESSION['form_data']['time']) ? htmlspecialchars($_SESSION['form_data']['time']) : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Pesan Tambahan (Opsional)</label>
                        <textarea id="message" name="message" class="form-control" rows="3"><?php echo isset($_SESSION['form_data']['message']) ? htmlspecialchars($_SESSION['form_data']['message']) : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-whatsapp"><i class="fab fa-whatsapp"></i> Kirim via WhatsApp</button>
                </form>
            </div>
        </div>
        
        <!-- Promo Page -->
        <div id="promo" class="page">
            <!-- Featured Promo - Grand Opening -->
            <?php if (!empty($featuredPromotions)): ?>
            <?php foreach ($featuredPromotions as $promo): ?>
            <div class="featured-promo">
                <img src="<?php echo $promo['image_url']; ?>" alt="<?php echo $promo['title']; ?>">
                <div class="featured-promo-content">
                    <h3><?php echo $promo['title']; ?></h3>
                    <p><?php echo $promo['description']; ?></p>
                    <div class="date-badge">
                        <i class="fas fa-calendar-alt"></i> <?php echo date('d F Y', strtotime($promo['valid_until'])); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            
            <div class="card">
                <h3><i class="fas fa-tags"></i> Promo Terbaru</h3>
                <div class="promo-grid">
                    <?php foreach ($promotions as $promo): ?>
                    <div class="promo-card">
                        <img src="<?php echo $promo['image_url']; ?>" alt="<?php echo $promo['title']; ?>">
                        <div class="promo-content">
                            <h4><?php echo $promo['title']; ?></h4>
                            <p><?php echo $promo['description']; ?></p>
                            <small>Berlaku hingga <?php echo date('d F Y', strtotime($promo['valid_until'])); ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Layanan Page -->
        <div id="layanan" class="page">
            <div class="card">
                <h3><i class="fas fa-concierge-bell"></i> Layanan Kami</h3>
                <div class="service-grid">
                    <ul class="service-list">
                        <?php foreach (array_slice($services, 0, 5) as $service): ?>
                        <li><i class="<?php echo $service['icon']; ?>"></i> <?php echo $service['name']; ?> - <?php echo $service['description']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="service-list">
                        <?php foreach (array_slice($services, 5, 5) as $service): ?>
                        <li><i class="<?php echo $service['icon']; ?>"></i> <?php echo $service['name']; ?> - <?php echo $service['description']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-images"></i> Galeri</h3>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1554224712-d8560f709cbe?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Service Area">
                        <div class="gallery-overlay">Area Service</div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Workshop">
                        <div class="gallery-overlay">Workshop</div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1580273916550-e3bdbeff3846?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Equipment">
                        <div class="gallery-overlay">Peralatan Modern</div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1549399542-7e244acb3f9d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Team">
                        <div class="gallery-overlay">Tim Profesional</div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-quote-left"></i> Testimoni Pelanggan</h3>
                <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar"><?php echo substr($testimonial['customer_name'], 0, 1); ?></div>
                        <div class="testimonial-info">
                            <h4><?php echo $testimonial['customer_name']; ?></h4>
                            <div class="rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star<?php echo $i <= $testimonial['rating'] ? '' : '-o'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-text">
                        "<?php echo $testimonial['testimonial_text']; ?>"
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="card">
                <div class="contact-info">
                    <h3><i class="fas fa-phone-alt"></i> Hubungi Kami</h3>
                    <p><i class="fas fa-phone"></i> 0823-2551-9998 (Purwokerto)</p>
                    <p><i class="fas fa-globe"></i> www.arumsariautocare.com</p>
                    <p><i class="fas fa-envelope"></i> info@arumsariautocare.com</p>
                    
                    <h3 style="margin-top: 30px;"><i class="fas fa-share-alt"></i> Media Sosial Kami</h3>
                    <div class="social-media">
                        <a href="https://www.facebook.com/arumsariautocare" target="_blank" class="social-icon facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/arumsariautocare" target="_blank" class="social-icon instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="http://tiktok.com/@arumsariautocare_" target="_blank" class="social-icon tiktok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://youtube.com/@arumsariautocare" target="_blank" class="social-icon youtube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Blog Page -->
        <div id="blog" class="page">
            <div class="card">
                <h3><i class="fas fa-newspaper"></i> Artikel Terbaru</h3>
                <?php foreach ($blogs as $blog): ?>
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="<?php echo $blog['image_url']; ?>" alt="<?php echo $blog['title']; ?>">
                    </div>
                    <div class="blog-content">
                        <h4><?php echo $blog['title']; ?></h4>
                        <p><?php echo $blog['excerpt']; ?></p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <i class="fas fa-user"></i> <?php echo $blog['author']; ?>
                            </div>
                            <div class="blog-date">
                                <i class="fas fa-calendar"></i> <?php echo date('d M Y', strtotime($blog['created_at'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p class="copyright">© 1995 - 2025 Arumsari Auto Care. All Rights Reserved.</p>
        </div>
    </footer>
    
    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="nav-item active" onclick="showPage('home')">
            <i class="fas fa-home"></i>
            <div class="nav-text">Home</div>
        </div>
        <div class="nav-item" onclick="showPage('about')">
            <i class="fas fa-info-circle"></i>
            <div class="nav-text">About</div>
        </div>
        <div class="nav-item" onclick="showPage('reservasi')">
            <i class="fas fa-calendar-check"></i>
            <div class="nav-text">Reservasi</div>
        </div>
        <div class="nav-item" onclick="showPage('promo')">
            <i class="fas fa-tag"></i>
            <div class="nav-text">Promo</div>
        </div>
        <div class="nav-item" onclick="showPage('layanan')">
            <i class="fas fa-concierge-bell"></i>
            <div class="nav-text">Layanan</div>
        </div>
        <div class="nav-item" onclick="showPage('blog')">
            <i class="fas fa-newspaper"></i>
            <div class="nav-text">Blog</div>
        </div>
    </div>
    
    <script>
        function showPage(pageId) {
            // Sembunyikan semua halaman
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });
            
            // Tampilkan halaman yang dipilih
            document.getElementById(pageId).classList.add('active');
            
            // Update navigasi aktif
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Aktifkan item navigasi yang sesuai
            event.currentTarget.classList.add('active');
            
            // Scroll ke atas
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // Set tanggal minimum untuk form reservasi (hari ini)
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);
        
        // Toggle FAQ
        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            const isActive = element.classList.contains('active');
            
            // Tutup semua FAQ
            document.querySelectorAll('.faq-question').forEach(q => {
                q.classList.remove('active');
            });
            document.querySelectorAll('.faq-answer').forEach(a => {
                a.classList.remove('active');
            });
            
            // Buka FAQ yang diklik jika sebelumnya tidak aktif
            if (!isActive) {
                element.classList.add('active');
                answer.classList.add('active');
            }
        }
        
        // Form validation
        document.getElementById('reservation-form').addEventListener('submit', function(e) {
            const phone = document.getElementById('phone').value;
            const phoneRegex = /^[0-9]{10,13}$/;
            
            if (!phoneRegex.test(phone)) {
                e.preventDefault();
                alert('Nomor telepon harus terdiri dari 10-13 digit angka');
                return false;
            }
            
            // Show loading state
            const submitBtn = document.querySelector('.btn-whatsapp');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
            
            // Reset button after 3 seconds in case form doesn't submit
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });
        
        // Service Worker Registration for PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('data:text/javascript;base64,' + btoa(`
                    self.addEventListener('install', event => {
                        console.log('Service Worker installing.');
                    });
                    
                    self.addEventListener('fetch', event => {
                        event.respondWith(
                            fetch(event.request).catch(() => {
                                return caches.match(event.request);
                            })
                        );
                    });
                `))
                .then(registration => {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                })
                .catch(error => {
                    console.log('ServiceWorker registration failed: ', error);
                });
            });
        }
    </script>
</body>
</html>