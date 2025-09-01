<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Tambah Artikel</h4>
    <a href="index.php" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Ringkasan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required></textarea>
                        <div class="form-text">Ringkasan akan ditampilkan di halaman utama</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image_url" class="form-label">URL Gambar <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="image_url" name="image_url" required>
                        <div class="form-text">Masukkan URL gambar artikel</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Preview Gambar</label>
                        <div id="image-preview" class="border rounded p-3 text-center text-muted" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image fa-3x"></i>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="author" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="author" name="author" value="Admin">
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" checked>
                            <label class="form-check-label" for="is_published">Published</label>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Artikel
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Image preview
    document.getElementById('image_url').addEventListener('input', function() {
        const url = this.value;
        const preview = document.getElementById('image-preview');
        
        if (url) {
            preview.innerHTML = `<img src="${url}" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">`;
        } else {
            preview.innerHTML = `<i class="fas fa-image fa-3x"></i>`;
        }
    });
</script>