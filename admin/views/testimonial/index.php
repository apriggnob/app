<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Kelola Testimonial</h4>
    <a href="create.php" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Testimonial
    </a>
</div>

<?php if (isset($_SESSION['success'])): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['success']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['success']); endif; ?>

<?php if (isset($_SESSION['error'])): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['error']); endif; ?>

<div class="card">
    <div class="card-body">
        <?php if (empty($testimonials)): ?>
        <div class="text-center py-5">
            <i class="fas fa-quote-left fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada testimonial</p>
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Testimonial Pertama
            </a>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Rating</th>
                        <th>Testimonial</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($testimonials as $testimonial): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $testimonial['customer_name']; ?></td>
                        <td>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?php echo $i <= $testimonial['rating'] ? '' : '-o'; ?> text-warning"></i>
                            <?php endfor; ?>
                        </td>
                        <td>
                            <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?php echo $testimonial['testimonial_text']; ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($testimonial['is_approved']): ?>
                            <span class="badge bg-success">Approved</span>
                            <?php else: ?>
                            <span class="badge bg-warning">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="edit.php?id=<?php echo $testimonial['id']; ?>" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="toggle-approval.php?id=<?php echo $testimonial['id']; ?>" class="btn btn-sm <?php echo $testimonial['is_approved'] ? 'btn-warning' : 'btn-success'; ?>" title="<?php echo $testimonial['is_approved'] ? 'Reject' : 'Approve'; ?>">
                                    <i class="fas <?php echo $testimonial['is_approved'] ? 'fa-times' : 'fa-check'; ?>"></i>
                                </a>
                                <a href="delete.php?id=<?php echo $testimonial['id']; ?>" class="btn btn-sm btn-danger btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>