<?php 
include 'config/koneksi.php';
include 'templates/header.php'; 
?>

<h4>Tambah Pinjaman</h4>

<form action="simpan_pinjam.php" method="post">

    <!-- Pilih Kendaraan -->
    <div class="mb-3">
        <label>Pilih Kendaraan</label>
        <select name="kendaraan_nomor" class="form-control" required>
            <option value="">-- Pilih Kendaraan --</option>
            <?php
            try {
                $kendaraan = $pdo->query("SELECT * FROM kendaraan WHERE kendaraan_status='tersedia'")->fetchAll(PDO::FETCH_ASSOC);
                if(count($kendaraan) > 0){
                    foreach($kendaraan as $k){
                        echo "<option value='{$k['kendaraan_nomer']}'>{$k['kendaraan_nama']} - {$k['kendaraan_nomer']}</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada kendaraan tersedia</option>";
                }
            } catch(PDOException $e){
                echo "<option value=''>Error: ".$e->getMessage()."</option>";
            }
            ?>
        </select>
    </div>

    <!-- Pilih User -->
    <div class="mb-3">
        <label>Pilih User</label>
        <select name="user_id" class="form-control" required>
            <option value="">-- Pilih User --</option>
            <?php
            try {
                $users = $pdo->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
                if(count($users) > 0){
                    foreach($users as $u){
                        echo "<option value='{$u['user_id']}'>{$u['username']}</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada user</option>";
                }
            } catch(PDOException $e){
                echo "<option value=''>Error: ".$e->getMessage()."</option>";
            }
            ?>
        </select>
    </div>

    <!-- Tanggal Pinjam -->
    <div class="mb-3">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" class="form-control" required>
    </div>

    <!-- Tanggal Kembali -->
    <div class="mb-3">
        <label>Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" class="form-control" required>
    </div>

    <!-- Status Pinjaman -->
    <div class="mb-3">
        <label>Status Pinjaman</label>
        <select name="pinjam_status" class="form-control" required>
            <option value="dipinjam">Dipinjam</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>

    <!-- Tombol Simpan & Kembali -->
    <div class="mt-4">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
        </button>
        <a href="pinjam.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

</form>

<?php include 'templates/footer.php'; ?>
