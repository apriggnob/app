<!-- Blog Detail Page -->
<div id="blog-detail" class="page">
    <a href="javascript:void(0)" onclick="showPage('blog')" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali ke Blog
    </a>
    
    <?php if ($blog): ?>
    <div class="blog-detail">
        <div class="blog-detail-image">
            <img src="<?php echo $blog['image_url']; ?>" alt="<?php echo $blog['title']; ?>">
        </div>
        <div class="blog-detail-content">
            <h2><?php echo $blog['title']; ?></h2>
            <p><?php echo nl2br($blog['content']); ?></p>
            
            <div class="blog-detail-meta">
                <div class="blog-author">
                    <i class="fas fa-user"></i> <?php echo $blog['author']; ?>
                </div>
                <div class="blog-date">
                    <i class="fas fa-calendar"></i> <?php echo date('d M Y', strtotime($blog['created_at'])); ?>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="card">
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> Artikel tidak ditemukan
        </div>
    </div>
    <?php endif; ?>
</div>