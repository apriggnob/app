<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit Promo</h4>
    <a href="index.php" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<?php if (!$promo): ?>
<div class="alert alert-danger">
    Promo tidak ditemukan
</div>
<?php else: ?>
<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Promo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($promo['title']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($promo['description']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="valid_until" class="form-label">Berlaku Sampai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="valid_until" name="valid_until" value="<?php echo $promo['valid_until']; ?>" required>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image_url" class="form-label">URL Gambar <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($promo['image_url']); ?>" required>
                        <div class="form-text">Masukkan URL gambar promo</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Preview Gambar</label>
                        <div id="image-preview" class="border rounded p-3 text-center">
                            <img src="<?php echo htmlspecialchars($promo['image_url']); ?>" alt="Preview" style="max-width: 100%; max-height: 200px; object-fit: contain;">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" <?php echo $promo['is_active'] ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" <?php echo $promo['is_featured'] ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="is_featured">Featured</label>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Promo
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<script>
    // Image preview
    document.getElementById('image_url').addEventListener('input', function() {
        const url = this.value;
        const preview = document.getElementById('image-preview');
        
        if (url) {
            preview.innerHTML = `<img src="${url}" alt="Preview" style="max-width: 100%; max-height: 200px; object-fit: contain;">`;
        } else {
            preview.innerHTML = `<img src="<?php echo htmlspecialchars($promo['image_url']); ?>" alt="Preview" style="max-width: 100%; max-height: 200px; object-fit: contain;">`;
        }
    });
</script>