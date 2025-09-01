<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'u1544385_admin-app-asac');
define('DB_PASS', 'qWe4tyUUU123');
define('DB_NAME', 'u1544385_ASAC_APP');
define('BASE_URL', 'https://arumsariautocare.com/app/admin/');
define('SITE_URL', 'https://arumsariautocare.com/app');

// Admin credentials
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', password_hash('admin123', PASSWORD_DEFAULT));

// Create database connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("Database connection failed. Please check your configuration.");
}

// Start session
session_start();
?>