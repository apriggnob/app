<!-- About Page -->
<div id="about" class="page">
    <div class="card">
        <h3><i class="fas fa-info-circle"></i> Tentang Kami</h3>
        <p>Arumsari Auto Care telah melayani kebutuhan perawatan dan perbaikan kendaraan sejak tahun 1995. Kami berkomitmen memberikan layanan terbaik dengan teknisi berpengalaman dan peralatan modern.</p>
        <p>Visi kami menjadi bengkel terdepan yang memberikan solusi lengkap untuk semua kebutuhan kendaraan Anda.</p>
        <p>Misi kami adalah memberikan pelayanan berkualitas dengan harga kompetitif, menggunakan suku cadang asli, dan menjamin kepuasan pelanggan.</p>
    </div>
    
    <div class="card">
        <h3><i class="fas fa-map-marker-alt"></i> Cabang Kami</h3>
        <div class="branches">
            <?php foreach ($branches as $branch): ?>
            <div class="branch-card">
                <div class="branch-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="branch-info">
                    <h4><?php echo $branch['name']; ?></h4>
                    <p><i class="fas fa-building"></i> <?php echo $branch['name']; ?></p>
                    <p><i class="fas fa-phone"></i> <?php echo $branch['phone']; ?></p>
                    <p><i class="fas fa-map-pin"></i> <?php echo $branch['address']; ?></p>
                    <a href="<?php echo $branch['map_url']; ?>" target="_blank"><i class="fas fa-location-arrow"></i> Lihat di Google Maps</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="card">
        <h3><i class="fas fa-question-circle"></i> FAQ</h3>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Apakah perlu membuat janji temu sebelum datang?</span>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>Ya, sangat disarankan untuk membuat reservasi terlebih dahulu agar kami dapat menyiapkan peralatan dan teknisi yang sesuai dengan kebutuhan kendaraan Anda.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Apakah suku cadang yang digunakan asli?</span>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>Kami menyediakan pilihan suku cadang asli dan alternatif dengan kualitas terjamin. Tim kami akan memberikan rekomendasi terbaik sesuai kebutuhan dan anggaran Anda.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Berapa lama waktu pengerjaan umumnya?</span>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>Waktu pengerjaan tergantung pada jenis layanan. Untuk perawatan berkala umumnya memakan waktu 1-2 jam, sementara untuk perbaikan khusus bisa memakan waktu lebih lama. Kami akan memberikan estimasi waktu saat pemeriksaan awal.</p>
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