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
            cursor: pointer;
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
            cursor: pointer;
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
        
        .blog-detail {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }
        
        .blog-detail-image {
            height: 250px;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .blog-detail-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .blog-detail-content h2 {
            color: var(--primary-dark);
            margin-bottom: 15px;
            font-size: 24px;
        }
        
        .blog-detail-content p {
            color: var(--gray);
            margin-bottom: 15px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        .blog-detail-meta {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: var(--gray);
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            transition: color 0.3s;
        }
        
        .btn-back:hover {
            color: var(--primary-dark);
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