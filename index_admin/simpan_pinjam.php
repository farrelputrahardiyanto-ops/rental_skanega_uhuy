<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data dari form
    $kendaraan_nomor = $_POST['kendaraan_nomor'];
    $user_id = $_POST['user_id'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $pinjam_status = $_POST['pinjam_status'];

    try {
        $pdo->beginTransaction();

        // 1. Simpan ke tabel pinjam
        $stmt = $pdo->prepare("INSERT INTO pinjam (kendaraan_nomer, user_id, tgl_pinjam, tgl_kembali, pinjam_status)
                               VALUES (:kendaraan_nomer, :user_id, :tgl_pinjam, :tgl_kembali, :pinjam_status)");
        $stmt->execute([
            ':kendaraan_nomer' => $kendaraan_nomor,
            ':user_id' => $user_id,
            ':tgl_pinjam' => $tgl_pinjam,
            ':tgl_kembali' => $tgl_kembali,
            ':pinjam_status' => $pinjam_status
        ]);

        // 2. Update status kendaraan jadi 'disewa' kalau status pinjam 'dipinjam'
        if ($pinjam_status === 'dipinjam') {
            $updateKendaraan = $pdo->prepare("UPDATE kendaraan SET kendaraan_status='disewa' WHERE kendaraan_nomer=:nomer");
            $updateKendaraan->execute([':nomer' => $kendaraan_nomor]);
        }

        $pdo->commit();

        // Redirect ke halaman pinjam
        header("Location: pinjam.php?success=1");
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }

} else {
    // Kalau diakses langsung tanpa form
    header("Location: pinjam.php");
    exit;
}
