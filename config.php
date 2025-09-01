<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'u1544385_admin-app-asac');
define('DB_PASS', 'qWe4tyUUU123');
define('DB_NAME', 'u1544385_ASAC_APP');
define('BASE_URL', 'https://arumsariautocare.com/');
define('ADMIN_URL', 'https://arumsariautocare.com/admin/');

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

// Initialize database tables
function initializeDatabase($conn) {
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
    insertDefaultData($conn);
}

// Function to insert default data
function insertDefaultData($conn) {
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
                "Musim hujan telah tiba, tentunya kita perlu mempersiapkan kendaraan kita agar tetap prima dan aman saat digunakan. Berikut beberapa tips merawat mobil saat musim hujan yang bisa Anda lakukan. Pertama, periksa kondisi wiper dan pastikan karet masih elastis. Kedua, periksa sistem rem untuk memastikan berfungsi dengan baik. Ketiga, pastikan ban memiliki kedalaman alur yang cukup. Keempat, periksa sistem kelistrikan untuk mencegah konsleting. Kelima, aplikasikan pelindung cat untuk mencegah karat akibat air hujan. Dengan melakukan perawatan ini, mobil Anda akan tetap aman dan nyaman saat digunakan di musim hujan.",
                "https://images.unsplash.com/photo-1554224712-d8560f709cbe?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
            ],
            [
                "Pentingnya Mengganti Oli Secara Berkala", 
                "Oli mesin memiliki peran yang sangat vital dalam performa kendaraan Anda. Mengganti oli secara berkala adalah salah satu perawatan paling penting yang harus dilakukan untuk menjaga kondisi mesin mobil tetap prima.", 
                "Oli mesin memiliki peran yang sangat vital dalam performa kendaraan Anda. Mengganti oli secara berkala adalah salah satu perawatan paling penting yang harus dilakukan untuk menjaga kondisi mesin mobil tetap prima. Oli berfungsi sebagai pelumas komponen mesin, pendingin, pembersih, dan peredam getaran. Tanpa oli yang baik, mesin akan mengalami keausan yang cepat dan performa akan menurun drastis. Sebaiknya ganti oli setiap 5.000-10.000 km tergantung jenis oli dan kondisi penggunaan. Pilih oli yang sesuai dengan rekomendasi pabrikan untuk hasil optimal.",
                "https://images.unsplash.com/photo-1551524160-7559127343a0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
            ],
            [
                "Tanda-Tanda AC Mobil Perlu Diperbaiki", 
                "AC mobil yang tidak berfungsi dengan baik tentunya akan membuat perjalanan Anda menjadi tidak nyaman, terutama di cuaca yang panas. Berikut beberapa tanda-tanda AC mobil Anda perlu diperbaiki.", 
                "AC mobil yang tidak berfungsi dengan baik tentunya akan membuat perjalanan Anda menjadi tidak nyaman, terutama di cuaca yang panas. Berikut beberapa tanda-tanda AC mobil Anda perlu diperbaiki. Pertama, AC tidak dingin sama sekali. Kedua, ada bau tidak sedap saat AC dinyalakan. Ketiga, suara berisik dari kompresor AC. Keempat, AC bocor dan meneteskan air. Kelima, pendinginan tidak merata. Jika Anda mengalami salah satu tanda ini, segera bawa mobil ke bengkel AC terpercaya untuk diperiksa.",
                "https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
            ]
        ];
        
        foreach ($blogs as $blog) {
            $stmt = $conn->prepare("INSERT INTO blogs (title, content, excerpt, image_url) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $blog[0], $blog[1], $blog[2], $blog[3]);
            $stmt->execute();
        }
    }
}

// Initialize database
initializeDatabase($conn);
?>