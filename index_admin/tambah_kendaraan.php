<?php include '../templates/header.php'; ?>

<h4>Tambah Kendaraan</h4>

<form action="simpan_kendaraan.php" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label>Nama Kendaraan</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>No Polisi</label>
        <input type="text" name="nopol" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Type</label>
        <input type="text" name="type" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Harga / Hari</label>
        <input type="number" name="harga" class="form-control" required>
    </div>

    <div class="mb-3">
    <label>Status Kendaraan</label>
     <select name="status" class="form-control" required>
        <option value="tersedia">Tersedia</option>
        <option value="disewa">Disewa</option>
        </select>
    </div>


    <div class="mb-3">
        <label>Deskripsi Kendaraan</label>
        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Kendaraan</label>
        <input type="file" name="gambar" class="form-control" required>
    </div>

     <div class="mt-4">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
        </button>
        <a href="kendaraan.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

</form>

<?php include '../templates/footer.php'; ?>
