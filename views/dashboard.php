<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card primary">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="stat-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-number"><?php echo $stats['total_promotions']; ?></div>
                    <div>Total Promo</div>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-chart-line fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card success">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-number"><?php echo $stats['total_blogs']; ?></div>
                    <div>Total Artikel</div>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-file-alt fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="stat-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="stat-number"><?php echo $stats['total_testimonials']; ?></div>
                    <div>Testimonial</div>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-star fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card danger">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-number"><?php echo $stats['total_reservations']; ?></div>
                    <div>Reservasi</div>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-calendar-alt fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Reservasi Terbaru</h5>
            </div>
            <div class="card-body">
                <?php if (empty($stats['recent_reservations'])): ?>
                <div class="text-center py-4">
                    <p class="text-muted mb-0">Belum ada reservasi</p>
                </div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Cabang</th>
                                <th>Layanan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stats['recent_reservations'] as $reservation): ?>
                            <tr>
                                <td><?php echo $reservation['name']; ?></td>
                                <td><?php echo $reservation['branch']; ?></td>
                                <td><?php echo $reservation['service']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($reservation['reservation_date'])); ?></td>
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
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="<?php echo BASE_URL; ?>reservation/" class="btn btn-sm btn-primary">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Statistik</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Promo Aktif</span>
                        <span class="badge bg-primary"><?php echo $stats['active_promotions']; ?></span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-primary" style="width: <?php echo $stats['total_promotions'] > 0 ? ($stats['active_promotions'] / $stats['total_promotions'] * 100) : 0; ?>%"></div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Artikel Published</span>
                        <span class="badge bg-success"><?php echo $stats['published_blogs']; ?></span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: <?php echo $stats['total_blogs'] > 0 ? ($stats['published_blogs'] / $stats['total_blogs'] * 100) : 0; ?>%"></div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Testimonial Approved</span>
                        <span class="badge bg-warning"><?php echo $stats['approved_testimonials']; ?></span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-warning" style="width: <?php echo $stats['total_testimonials'] > 0 ? ($stats['approved_testimonials'] / $stats['total_testimonials'] * 100) : 0; ?>%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Reservasi Pending</span>
                        <span class="badge bg-danger"><?php echo $stats['pending_reservations']; ?></span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-danger" style="width: <?php echo $stats['total_reservations'] > 0 ? ($stats['pending_reservations'] / $stats['total_reservations'] * 100) : 0; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>