<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Kelola Reservasi</h4>
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
        <?php if (empty($reservations)): ?>
        <div class="text-center py-5">
            <i class="fas fa-calendar-check fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada reservasi</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Cabang</th>
                        <th>Layanan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $reservation['name']; ?></td>
                        <td><?php echo $reservation['phone']; ?></td>
                        <td><?php echo $reservation['branch']; ?></td>
                        <td><?php echo $reservation['service']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($reservation['reservation_date'])); ?></td>
                        <td><?php echo date('H:i', strtotime($reservation['reservation_time'])); ?></td>
                        <td>
                            <?php
                            $statusClass = '';
                            switch ($reservation['status']) {
                                case 'pending':
                                    $statusClass = 'bg-warning';
                                    break;
                                case 'confirmed':
                                    $statusClass = 'bg-info';
                                    break;
                                case 'completed':
                                    $statusClass = 'bg-success';
                                    break;
                                case 'cancelled':
                                    $statusClass = 'bg-danger';
                                    break;
                            }
                            ?>
                            <span class="badge <?php echo $statusClass; ?>">
                                <?php echo ucfirst($reservation['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="update-status.php?id=<?php echo $reservation['id']; ?>&status=confirmed">
                                            <i class="fas fa-check text-info me-2"></i> Confirm
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="update-status.php?id=<?php echo $reservation['id']; ?>&status=completed">
                                            <i class="fas fa-check-circle text-success me-2"></i> Complete
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="update-status.php?id=<?php echo $reservation['id']; ?>&status=cancelled">
                                            <i class="fas fa-times-circle text-danger me-2"></i> Cancel
                                        </a>
                                    </li>
                                </ul>
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