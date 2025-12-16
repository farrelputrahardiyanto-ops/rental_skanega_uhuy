<?php
include 'config/koneksi.php';
include 'templates/header.php';

// Ambil data pinjam beserta info kendaraan dan user
$stmt = $pdo->query("
    SELECT p.*, k.kendaraan_nama, u.username 
    FROM pinjam p
    JOIN kendaraan k ON p.kendaraan_nomer = k.kendaraan_nomer
    JOIN user u ON p.user_id = u.user_id
");
?>

<div class="d-flex justify-content-between mb-3">
    <h4>Data Pinjaman</h4>
    <a href="tambah_pinjam.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pinjaman
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Kendaraan</th>
            <th>User</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($p = $stmt->fetch()) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p['kendaraan_nama']; ?></td>
            <td><?= $p['username']; ?></td>
            <td><?= date('d-m-Y', strtotime($p['tgl_pinjam'])); ?></td>
            <td><?= date('d-m-Y', strtotime($p['tgl_kembali'])); ?></td>
            <td><?= $p['pinjam_status']; ?></td>
            <td>
                <a href="edit_pinjam.php?id=<?= $p['pinjam_id']; ?>" 
                   class="btn btn-warning btn-sm">
                   <i class="bi bi-pencil"></i> Edit
                </a>

                <a href="hapus_pinjam.php?id=<?= $p['pinjam_id']; ?>" 
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
        Pinjaman sedang aktif, tidak bisa dihapus.
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<?php include 'templates/footer.php'; ?>
