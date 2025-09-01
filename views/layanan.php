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