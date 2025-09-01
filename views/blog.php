<!-- Blog Page -->
<div id="blog" class="page">
    <div class="card">
        <h3><i class="fas fa-newspaper"></i> Artikel Terbaru</h3>
        <?php foreach ($blogs as $blog): ?>
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