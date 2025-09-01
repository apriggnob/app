<!-- Reservasi Page -->
<div id="reservasi" class="page">
    <div class="card">
        <h3><i class="fas fa-calendar-check"></i> Reservasi Layanan</h3>
        <?php
        if (isset($_SESSION['reservation_errors'])) {
            echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ';
            echo implode('<br>', $_SESSION['reservation_errors']);
            echo '</div>';
            unset($_SESSION['reservation_errors']);
        }
        ?>
        <form method="post" id="reservation-form">
            <input type="hidden" name="reservasi" value="1">
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control" required value="<?php echo isset($_SESSION['form_data']['name']) ? htmlspecialchars($_SESSION['form_data']['name']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required value="<?php echo isset($_SESSION['form_data']['phone']) ? htmlspecialchars($_SESSION['form_data']['phone']) : ''; ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="branch">Pilih Cabang</label>
                    <select id="branch" name="branch" class="form-control" required>
                        <option value="">-- Pilih Cabang --</option>
                        <?php foreach ($branches as $branch): ?>
                        <option value="<?php echo $branch['name']; ?>" <?php echo (isset($_SESSION['form_data']['branch']) && $_SESSION['form_data']['branch'] == $branch['name']) ? 'selected' : ''; ?>><?php echo $branch['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="service">Jenis Layanan</label>
                    <select id="service" name="service" class="form-control" required>
                        <option value="">-- Pilih Layanan --</option>
                        <?php foreach ($services as $service): ?>
                        <option value="<?php echo $service['name']; ?>" <?php echo (isset($_SESSION['form_data']['service']) && $_SESSION['form_data']['service'] == $service['name']) ? 'selected' : ''; ?>><?php echo $service['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="date">Tanggal Reservasi</label>
                    <input type="date" id="date" name="date" class="form-control" required value="<?php echo isset($_SESSION['form_data']['date']) ? htmlspecialchars($_SESSION['form_data']['date']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="time">Waktu Reservasi</label>
                    <input type="time" id="time" name="time" class="form-control" required value="<?php echo isset($_SESSION['form_data']['time']) ? htmlspecialchars($_SESSION['form_data']['time']) : ''; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="message">Pesan Tambahan (Opsional)</label>
                <textarea id="message" name="message" class="form-control" rows="3"><?php echo isset($_SESSION['form_data']['message']) ? htmlspecialchars($_SESSION['form_data']['message']) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-whatsapp"><i class="fab fa-whatsapp"></i> Kirim via WhatsApp</button>
        </form>
    </div>
</div>