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
            <div class="promo-card" onclick="showPage('promo')">
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
        <div class="blog-card" onclick="window.location.href='index.php?page=blog-detail&id=<?php echo $blog['id']; ?>'">
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