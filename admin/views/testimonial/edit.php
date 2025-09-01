<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit Testimonial</h4>
    <a href="index.php" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<?php if (!$testimonial): ?>
<div class="alert alert-danger">
    Testimonial tidak ditemukan
</div>
<?php else: ?>
<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($testimonial['customer_name']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                        <select class="form-select" id="rating" name="rating" required>
                            <option value="">Pilih Rating</option>
                            <option value="1" <?php echo $testimonial['rating'] == 1 ? 'selected' : ''; ?>>1 Bintang</option>
                            <option value="2" <?php echo $testimonial['rating'] == 2 ? 'selected' : ''; ?>>2 Bintang</option>
                            <option value="3" <?php echo $testimonial['rating'] == 3 ? 'selected' : ''; ?>>3 Bintang</option>
                            <option value="4" <?php echo $testimonial['rating'] == 4 ? 'selected' : ''; ?>>4 Bintang</option>
                            <option value="5" <?php echo $testimonial['rating'] == 5 ? 'selected' : ''; ?>>5 Bintang</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="testimonial_text" class="form-label">Testimonial <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="testimonial_text" name="testimonial_text" rows="6" required><?php echo htmlspecialchars($testimonial['testimonial_text']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_approved" name="is_approved" <?php echo $testimonial['is_approved'] ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="is_approved">Approved</label>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Testimonial
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>