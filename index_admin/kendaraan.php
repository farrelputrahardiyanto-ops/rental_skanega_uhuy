<?php
include '../config/koneksi.php';
include '../templates/header.php';

$stmt = $pdo->query("SELECT * FROM kendaraan");
?>

<div class="d-flex justify-content-between mb-3">
    <h4>Data Kendaraan</h4>
    <a href="tambah_kendaraan.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kendaraan
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Type</th>
            <th>Harga / Hari</th>
            <th>Status</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($k = $stmt->fetch()) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>
                <img src="../<?= $k['kendaraan_img']; ?>" width="80" style="border-radius:6px;">
            </td>
            <td><?= $k['kendaraan_nama']; ?></td>
            <td><?= $k['kendaraan_type']; ?></td>
            <td>Rp<?= number_format($k['kendaraan_harga_perhari']); ?></td>
            <td><?= $k['kendaraan_status']; ?></td>
            <td>
                <a href="edit_kendaraan.php?id=<?= $k['kendaraan_nomer']; ?>" 
                   class="btn btn-warning btn-sm">
                   <i class="bi bi-pencil"></i> Edit
                </a>

                <a href="hapus_kendaraan.php?id=<?= $k['kendaraan_nomer']; ?>" 
                   onclick="return confirm('Yakin hapus data?')"
                   class="btn btn-danger btn-sm">
                   <i class="bi bi-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal Gagal Hapus -->
<div class="modal fade" id="hapusGagalModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Gagal Menghapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Kendaraan masih dipinjam, tidak bisa dihapus.
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<?php include '../templates/footer.php'; ?>
