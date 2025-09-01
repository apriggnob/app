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
            <div class="promo-card" onclick="window.location.href='index.php?page=promo-detail&id=<?php echo $promo['id']; ?>'">
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