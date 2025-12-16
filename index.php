<?php
include 'config/koneksi.php';
include 'templates/header.php';

$stmt = $pdo->query("SELECT * FROM kendaraan");
?>

<div class="row">
<?php while ($k = $stmt->fetch()) { ?>
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm">
            <img src="<?= $k['kendaraan_img']; ?>" class="card-img-top">

            <div class="card-body">
                <h6 class="fw-bold"><?= $k['kendaraan_nama']; ?></h6>
                <p class="text-muted small"><?= $k['kendaraan_type']; ?></p>

                <p class="fw-bold text-danger">
                    Rp<?= number_format($k['kendaraan_harga_perhari']); ?>/hari
                </p>

                <?php if ($k['kendaraan_status'] == 'tersedia') { ?>
                    <a href="sewa.php?id=<?= $k['kendaraan_nomer']; ?>" 
                       class="btn btn-sewa w-100">
                        Sewa
                    </a>
                <?php } else { ?>
                    <button class="btn btn-secondary w-100" disabled>
                        Disewa
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
</div>

<?php include 'templates/footer.php'; ?>
