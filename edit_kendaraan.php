<?php
include 'config/koneksi.php';
include 'templates/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM kendaraan WHERE kendaraan_nomer=?");
$stmt->execute([$id]);
$k = $stmt->fetch();
?>

<h4>Edit Kendaraan</h4>

<form action="update_kendaraan.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $k['kendaraan_nomer']; ?>">
    <input type="hidden" name="gambar_lama" value="<?= $k['kendaraan_img']; ?>">

    <div class="mb-3">
        <label>Nama Kendaraan</label>
        <input type="text" name="nama" class="form-control"
               value="<?= $k['kendaraan_nama']; ?>" required>
    </div>

    <div class="mb-3">
        <label>Type</label>
        <input type="text" name="type" class="form-control"
               value="<?= $k['kendaraan_type']; ?>" required>
    </div>

    <div class="mb-3">
        <label>Harga / Hari</label>
        <input type="number" name="harga" class="form-control"
               value="<?= $k['kendaraan_harga_perhari']; ?>" required>
    </div>

    <div class="mb-3">
    <label>Status Kendaraan</label>
    <select name="status" class="form-control" required>
        <option value="tersedia" <?= $k['kendaraan_status']=='tersedia'?'selected':''; ?>>
            Tersedia
        </option>
        <option value="disewa" <?= $k['kendaraan_status']=='dipinjam'?'selected':''; ?>>
            Disewa
        </option>
    </select>
    </div>


    <div class="mb-3">
        <label>Deskripsi Kendaraan</label>
        <textarea name="deskripsi" class="form-control" rows="4"><?= $k['kendaraan_deskripsi']; ?></textarea>
    </div>

    <div class="mb-3">
        <label>Gambar Lama</label><br>
        <img src="../<?= $k['kendaraan_img']; ?>" width="120">
    </div>

    <div class="mb-3">
        <label>Ganti Gambar (Opsional)</label>
        <input type="file" name="gambar" class="form-control">
    </div>

    <button class="btn btn-primary">
        <i class="bi bi-save"></i> Update
    </button>
    <a href="kendaraan.php" class="btn btn-secondary">Kembali</a>

</form>

<?php include 'templates/footer.php'; ?>
