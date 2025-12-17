<?php 
include '../config/koneksi.php';
include '../templates/header_user.php'; 

// Ambil ID pinjam dari URL
if(!isset($_GET['id'])){
    header("Location: pinjam.php");
    exit;
}

$pinjam_id = $_GET['id'];

// Ambil data pinjam
$stmt = $pdo->prepare("SELECT * FROM pinjam WHERE pinjam_id = :id");
$stmt->execute([':id' => $pinjam_id]);
$pinjam = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$pinjam){
    echo "Data tidak ditemukan";
    exit;
}
?>

<h4>Edit Pinjaman</h4>

<form action="update_pinjam.php" method="post">
    <input type="hidden" name="pinjam_id" value="<?= $pinjam['pinjam_id']; ?>">

    <!-- Pilih Kendaraan -->
    <div class="mb-3">
        <label>Pilih Kendaraan</label>
        <select name="kendaraan_nomer" class="form-control" required>
            <?php
            $kendaraanList = $pdo->query("SELECT * FROM kendaraan")->fetchAll(PDO::FETCH_ASSOC);
            foreach($kendaraanList as $k){
                $selected = ($k['kendaraan_nomer'] == $pinjam['kendaraan_nomer']) ? "selected" : "";
                echo "<option value='{$k['kendaraan_nomer']}' $selected>{$k['kendaraan_nama']} - {$k['kendaraan_nomer']}</option>";
            }
            ?>
        </select>
    </div>

    <!-- Pilih User -->
    <div class="mb-3">
        <label>Pilih User</label>
        <select name="user_id" class="form-control" required>
            <?php
            $users = $pdo->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
            foreach($users as $u){
                $selected = ($u['user_id'] == $pinjam['user_id']) ? "selected" : "";
                echo "<option value='{$u['user_id']}' $selected>{$u['username']}</option>";
            }
            ?>
        </select>
    </div>

    <!-- Tanggal Pinjam -->
    <div class="mb-3">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" class="form-control" value="<?= $pinjam['tgl_pinjam']; ?>" required>
    </div>

    <!-- Tanggal Kembali -->
    <div class="mb-3">
        <label>Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" class="form-control" value="<?= $pinjam['tgl_kembali']; ?>" required>
    </div>

    <!-- Status Pinjaman -->
    <div class="mb-3">
        <label>Status Pinjaman</label>
        <select name="pinjam_status" class="form-control" required>
            <option value="dipinjam" <?= $pinjam['pinjam_status'] == 'dipinjam' ? 'selected' : ''; ?>>Dipinjam</option>
            <option value="selesai" <?= $pinjam['pinjam_status'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
        </select>
    </div>

    <div class="mt-4">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Update
        </button>
        <a href="pinjam.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

</form>

<?php include '../templates/footer.php'; ?>
