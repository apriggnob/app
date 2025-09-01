    </div>
    
    <footer>
        <div class="container">
            <p class="copyright">© 1995 - 2025 Arumsari Auto Care. All Rights Reserved.</p>
        </div>
    </footer>
    
    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="nav-item <?php echo $currentPage == 'home' ? 'active' : ''; ?>" onclick="showPage('home')">
            <i class="fas fa-home"></i>
            <div class="nav-text">Home</div>
        </div>
        <div class="nav-item <?php echo $currentPage == 'about' ? 'active' : ''; ?>" onclick="showPage('about')">
            <i class="fas fa-info-circle"></i>
            <div class="nav-text">About</div>
        </div>
        <div class="nav-item <?php echo $currentPage == 'reservasi' ? 'active' : ''; ?>" onclick="showPage('reservasi')">
            <i class="fas fa-calendar-check"></i>
            <div class="nav-text">Reservasi</div>
        </div>
        <div class="nav-item <?php echo $currentPage == 'promo' ? 'active' : ''; ?>" onclick="showPage('promo')">
            <i class="fas fa-tag"></i>
            <div class="nav-text">Promo</div>
        </div>
        <div class="nav-item <?php echo $currentPage == 'layanan' ? 'active' : ''; ?>" onclick="showPage('layanan')">
            <i class="fas fa-concierge-bell"></i>
            <div class="nav-text">Layanan</div>
        </div>
        <div class="nav-item <?php echo $currentPage == 'blog' ? 'active' : ''; ?>" onclick="showPage('blog')">
            <i class="fas fa-newspaper"></i>
            <div class="nav-text">Blog</div>
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
        if (document.getElementById('date')) {
            document.getElementById('date').setAttribute('min', today);
        }
        
        // Toggle FAQ
        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            const isActive = element.classList.contains('active');
            
            // Tutup semua FAQ
            document.querySelectorAll('.faq-question').forEach(q => {
                q.classList.remove('active');
            });
            document.querySelectorAll('.faq-answer').forEach(a => {
                a.classList.remove('active');
            });
            
            // Buka FAQ yang diklik jika sebelumnya tidak aktif
            if (!isActive) {
                element.classList.add('active');
                answer.classList.add('active');
            }
        }
        
        // Form validation
        if (document.getElementById('reservation-form')) {
            document.getElementById('reservation-form').addEventListener('submit', function(e) {
                const phone = document.getElementById('phone').value;
                const phoneRegex = /^[0-9]{10,13}$/;
                
                if (!phoneRegex.test(phone)) {
                    e.preventDefault();
                    alert('Nomor telepon harus terdiri dari 10-13 digit angka');
                    return false;
                }
                
                // Show loading state
                const submitBtn = document.querySelector('.btn-whatsapp');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;
                
                // Reset button after 3 seconds in case form doesn't submit
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });
        }
        
        // Service Worker Registration for PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('data:text/javascript;base64,' + btoa(`
                    self.addEventListener('install', event => {
                        console.log('Service Worker installing.');
                    });
                    
                    self.addEventListener('fetch', event => {
                        event.respondWith(
                            fetch(event.request).catch(() => {
                                return caches.match(event.request);
                            })
                        );
                    });
                `))
                .then(registration => {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                })
                .catch(error => {
                    console.log('ServiceWorker registration failed: ', error);
                });
            });
        }
    </script>
</body>
</html>