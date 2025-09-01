<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Kelola Promo</h4>
    <a href="create.php" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Promo
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
        <?php if (empty($promotions)): ?>
        <div class="text-center py-5">
            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada promo</p>
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Promo Pertama
            </a>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Valid Until</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($promotions as $promo): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <img src="<?php echo $promo['image_url']; ?>" alt="<?php echo $promo['title']; ?>" width="60" height="40" style="object-fit: cover; border-radius: 5px;">
                        </td>
                        <td><?php echo $promo['title']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($promo['valid_until'])); ?></td>
                        <td>
                            <?php if ($promo['is_active']): ?>
                            <span class="badge bg-success">Active</span>
                            <?php else: ?>
                            <span class="badge bg-secondary">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($promo['is_featured']): ?>
                            <span class="badge bg-warning">Featured</span>
                            <?php else: ?>
                            <span class="badge bg-outline-secondary">No</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="edit.php?id=<?php echo $promo['id']; ?>" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="toggle-status.php?id=<?php echo $promo['id']; ?>" class="btn btn-sm <?php echo $promo['is_active'] ? 'btn-warning' : 'btn-success'; ?>" title="<?php echo $promo['is_active'] ? 'Deactivate' : 'Activate'; ?>">
                                    <i class="fas <?php echo $promo['is_active'] ? 'fa-eye-slash' : 'fa-eye'; ?>"></i>
                                </a>
                                <a href="delete.php?id=<?php echo $promo['id']; ?>" class="btn btn-sm btn-danger btn-delete" title="Delete">
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