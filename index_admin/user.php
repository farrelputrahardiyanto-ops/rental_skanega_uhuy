<?php
include '../config/koneksi.php';
include '../templates/header.php';

$stmt = $pdo->query("SELECT * FROM user");
?>

<div class="d-flex justify-content-between mb-3">
    <h4>Data User</h4>
    <a href="tambah_user.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Alamat</th>
            <th>Tlp</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($u = $stmt->fetch()) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $u['user_nama']; ?></td>
            <td><?= $u['username']; ?></td>
            <td><?= $u['user_alamat']; ?></td>
            <td><?= $u['user_phone']; ?></td>
            <td>
                <a href="edit_user.php?id=<?= $u['user_id']; ?>"
                   class="btn btn-warning btn-sm">
                   <i class="bi bi-pencil"></i> Edit
                </a>

                <a href="hapus_user.php?id=<?= $u['user_id']; ?>"
                   onclick="return confirm('Yakin hapus user?')"
                   class="btn btn-danger btn-sm">
                   <i class="bi bi-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php include '../templates/footer.php'; ?>
