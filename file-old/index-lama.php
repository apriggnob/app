<?php
// Proses form reservasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservasi'])) {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $branch = htmlspecialchars($_POST['branch']);
    $service = htmlspecialchars($_POST['service']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $message = htmlspecialchars($_POST['message']);
    
    // Format pesan WhatsApp
    $whatsapp_message = "Halo, saya ingin melakukan reservasi di Arumsari Auto Care%0A%0A" .
                        "*Nama:* " . $name . "%0A" .
                        "*Telepon:* " . $phone . "%0A" .
                        "*Cabang:* " . $branch . "%0A" .
                        "*Layanan:* " . $service . "%0A" .
                        "*Tanggal:* " . $date . "%0A" .
                        "*Waktu:* " . $time . "%0A" .
                        "*Pesan Tambahan:* " . $message;
    
    // Redirect ke WhatsApp
    header("Location: https://api.whatsapp.com/send?phone=6282325519998&text=" . $whatsapp_message);
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arumsari Auto Care</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
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
        }
        
        .hero-text p {
            font-size: 14px;
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
                        <li><i class="fas fa-tools"></i> Perawatan Berkala</li>
                        <li><i class="fas fa-cogs"></i> Tune Up</li>
                        <li><i class="fas fa-cog"></i> Kaki Kaki (Understeel)</li>
                        <li><i class="fas fa-fan"></i> AC Mobil</li>
                        <li><i class="fas fa-balance-scale"></i> Shaking Machine</li>
                    </ul>
                    <ul class="service-list">
                        <li><i class="fas fa-compact-disc"></i> Bubut Cakram</li>
                        <li><i class="fas fa-car-brake"></i> Rem</li>
                        <li><i class="fas fa-spray-can"></i> Nano Coating</li>
                        <li><i class="fas fa-oil-can"></i> Ganti Oli</li>
                        <li><i class="fas fa-align-center"></i> Spooring & Balancing</li>
                    </ul>
                </div>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-tag"></i> Promo Spesial</h3>
                <div class="promo-grid">
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1567899378494-47b22b2df511?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo Service">
                        <div class="promo-content">
                            <h4>Service Gratis 5x</h4>
                            <p>Untuk pembelian paket service tahunan</p>
                            <small>Berlaku hingga 30 September 2023</small>
                        </div>
                    </div>
                    
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1551524160-7559127343a0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo Oli">
                        <div class="promo-content">
                            <h4>Diskon Oli 20%</h4>
                            <p>Khusus untuk pelanggan baru</p>
                            <small>Berlaku hingga 31 Agustus 2023</small>
                        </div>
                    </div>
                    
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1567337710282-00832d2155c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo Ban">
                        <div class="promo-content">
                            <h4>Beli 4 Bayar 3</h4>
                            <p>Untuk pembelian ban merek tertentu</p>
                            <small>Berlaku hingga 30 November 2023</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- About Page -->
        <div id="about" class="page">
            <div class="card">
                <h3><i class="fas fa-info-circle"></i> Tentang Kami</h3>
                <p>Arumsari Auto Care telah melayani kebutuhan perawatan dan perbaikan kendaraan sejak tahun 1995. Kami berkomitmen memberikan layanan terbaik dengan teknisi berpengalaman dan peralatan modern.</p>
                <p>Visi kami menjadi bengkel terdepan yang memberikan solusi lengkap untuk semua kebutuhan kendaraan Anda.</p>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-map-marker-alt"></i> Cabang Kami</h3>
                <div class="branches">
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="branch-info">
                            <h4>Purwokerto (Pusat)</h4>
                            <p><i class="fas fa-building"></i> Arumsari Auto Care Purwokerto</p>
                            <p><i class="fas fa-phone"></i> 0823-2551-9998</p>
                            <p><i class="fas fa-map-pin"></i> Jl. Sultan Agung No. 11 B, Karangkelsem Purwokerto Selatan Kab. Banyumas 53144</p>
                            <a href="https://maps.app.goo.gl/xTpYR5Dae48oN74x9" target="_blank"><i class="fas fa-location-arrow"></i> Lihat di Google Maps</a>
                        </div>
                    </div>
                    
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="branch-info">
                            <h4>Tasikmalaya</h4>
                            <p><i class="fas fa-building"></i> Arumsari Auto Care Tasikmalaya</p>
                            <p><i class="fas fa-phone"></i> 0823-2366-1185</p>
                            <p><i class="fas fa-map-pin"></i> Jl. Letjen Mashudi No.102, Mulyasari, Kec. Tamansari, Kab. Tasikmalaya, Jawa Barat 46196</p>
                            <a href="https://maps.app.goo.gl/1Jwfubx6HX8KUzSs7" target="_blank"><i class="fas fa-location-arrow"></i> Lihat di Google Maps</a>
                        </div>
                    </div>
                    
                    <div class="branch-card">
                        <div class="branch-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="branch-info">
                            <h4>Bandung</h4>
                            <p><i class="fas fa-building"></i> Arumsari Auto Care Bandung Express</p>
                            <p><i class="fas fa-phone"></i> 0813-9984-1000</p>
                            <p><i class="fas fa-map-pin"></i> Jl. Raya Soreang-Cipatik No.79, Gajahmekar, Kec. Kutawaringin, Kabupaten Bandung, Jawa Barat 40911</p>
                            <a href="https://maps.app.goo.gl/hyef5Fq419dsFae88" target="_blank"><i class="fas fa-location-arrow"></i> Lihat di Google Maps</a>
                        </div>
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
                <form method="post" id="reservation-form">
                    <input type="hidden" name="reservasi" value="1">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="branch">Pilih Cabang</label>
                            <select id="branch" name="branch" class="form-control" required>
                                <option value="">-- Pilih Cabang --</option>
                                <option value="Purwokerto">Purwokerto</option>
                                <option value="Tasikmalaya">Tasikmalaya</option>
                                <option value="Bandung">Bandung</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="service">Jenis Layanan</label>
                            <select id="service" name="service" class="form-control" required>
                                <option value="">-- Pilih Layanan --</option>
                                <option value="Perawatan Berkala">Perawatan Berkala</option>
                                <option value="Tune Up">Tune Up</option>
                                <option value="Kaki Kaki">Kaki Kaki (Understeel)</option>
                                <option value="AC Mobil">AC Mobil</option>
                                <option value="Shaking Machine">Shaking Machine</option>
                                <option value="Bubut Cakram">Bubut Cakram</option>
                                <option value="Rem">Rem</option>
                                <option value="Nano Coating">Nano Coating</option>
                                <option value="Ganti Oli">Ganti Oli</option>
                                <option value="Spooring & Balancing">Spooring & Balancing</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="date">Tanggal Reservasi</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="time">Waktu Reservasi</label>
                            <input type="time" id="time" name="time" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Pesan Tambahan (Opsional)</label>
                        <textarea id="message" name="message" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-whatsapp"><i class="fab fa-whatsapp"></i> Kirim via WhatsApp</button>
                </form>
            </div>
        </div>
        
        <!-- Promo Page -->
        <div id="promo" class="page">
            <div class="card">
                <h3><i class="fas fa-tags"></i> Promo Terbaru</h3>
                <div class="promo-grid">
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1567899378494-47b22b2df511?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo Service">
                        <div class="promo-content">
                            <h4>Service Gratis 5x</h4>
                            <p>Untuk pembelian paket service tahunan</p>
                            <small>Berlaku hingga 30 September 2023</small>
                        </div>
                    </div>
                    
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1551524160-7559127343a0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo Oli">
                        <div class="promo-content">
                            <h4>Diskon Oli 20%</h4>
                            <p>Khusus untuk pelanggan baru</p>
                            <small>Berlaku hingga 31 Agustus 2023</small>
                        </div>
                    </div>
                    
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1603712610494-7e28343a3cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo Body Repair">
                        <div class="promo-content">
                            <h4>Cashback 15%</h4>
                            <p>Untuk layanan body repair dan pengecatan</p>
                            <small>Berlaku hingga 15 Oktober 2023</small>
                        </div>
                    </div>
                    
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1567337710282-00832d2155c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo Ban">
                        <div class="promo-content">
                            <h4>Beli 4 Bayar 3</h4>
                            <p>Untuk pembelian ban merek tertentu</p>
                            <small>Berlaku hingga 30 November 2023</small>
                        </div>
                    </div>
                    
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo Nano Coating">
                        <div class="promo-content">
                            <h4>Nano Coating 30%</h4>
                            <p>Diskon khusus nano coating</p>
                            <small>Berlaku hingga 31 Desember 2023</small>
                        </div>
                    </div>
                    
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Promo AC">
                        <div class="promo-content">
                            <h4>Service AC 25%</h4>
                            <p>Diskon service AC mobil</p>
                            <small>Berlaku hingga 20 November 2023</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Layanan Page -->
        <div id="layanan" class="page">
            <div class="card">
                <h3><i class="fas fa-concierge-bell"></i> Layanan Kami</h3>
                <div class="service-grid">
                    <ul class="service-list">
                        <li><i class="fas fa-tools"></i> Perawatan Berkala - Perawatan rutin untuk menjaga performa kendaraan</li>
                        <li><i class="fas fa-cogs"></i> Tune Up - Penyetelan mesin untuk performa optimal</li>
                        <li><i class="fas fa-cog"></i> Kaki Kaki (Understeel) - Perbaikan sistem understeel kendaraan</li>
                        <li><i class="fas fa-fan"></i> AC Mobil - Servis dan perbaikan AC kendaraan</li>
                        <li><i class="fas fa-balance-scale"></i> Shaking Machine - Penyeimbangan roda profesional</li>
                    </ul>
                    <ul class="service-list">
                        <li><i class="fas fa-compact-disc"></i> Bubut Cakram - Perbaikan permukaan cakram rem</li>
                        <li><i class="fas fa-car-brake"></i> Rem - Servis dan penggantian sistem pengereman</li>
                        <li><i class="fas fa-spray-can"></i> Nano Coating - Pelapisan nano untuk perlindungan cat</li>
                        <li><i class="fas fa-oil-can"></i> Ganti Oli - Penggantian oli mesin dengan bahan terbaik</li>
                        <li><i class="fas fa-align-center"></i> Spooring & Balancing - Penyeimbangan dan penyetelan roda</li>
                    </ul>
                </div>
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
    </script>
</body>
</html>