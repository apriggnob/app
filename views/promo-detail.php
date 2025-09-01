<!-- Promo Detail Page -->
<div id="promo-detail" class="page">
    <a href="javascript:void(0)" onclick="showPage('promo')" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali ke Promo
    </a>
    
    <?php if ($promo): ?>
    <div class="blog-detail">
        <div class="blog-detail-image">
            <img src="<?php echo $promo['image_url']; ?>" alt="<?php echo $promo['title']; ?>">
        </div>
        <div class="blog-detail-content">
            <h2><?php echo $promo['title']; ?></h2>
            <p><?php echo $promo['description']; ?></p>
            
            <div class="blog-detail-meta">
                <div class="blog-date">
                    <i class="fas fa-calendar-alt"></i> Berlaku hingga <?php echo date('d F Y', strtotime($promo['valid_until'])); ?>
                </div>
                <div class="btn btn-whatsapp" onclick="window.location.href='index.php?page=reservasi'">
                    <i class="fas fa-calendar-check"></i> Reservasi Sekarang
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="card">
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> Promo tidak ditemukan
        </div>
    </div>
    <?php endif; ?>
</div>