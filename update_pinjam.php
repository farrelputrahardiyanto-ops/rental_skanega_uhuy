<?php
include 'config/koneksi.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pinjam_id = $_POST['pinjam_id'];
    $kendaraan_nomer = $_POST['kendaraan_nomer'];
    $user_id = $_POST['user_id'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $pinjam_status = $_POST['pinjam_status'];

    try {
        $pdo->beginTransaction();

        // Ambil status pinjaman lama dan kendaraan lama
        $stmtOld = $pdo->prepare("SELECT kendaraan_nomer, pinjam_status FROM pinjam WHERE pinjam_id=:id");
        $stmtOld->execute([':id' => $pinjam_id]);
        $old = $stmtOld->fetch(PDO::FETCH_ASSOC);

        // Update tabel pinjam
        $stmt = $pdo->prepare("
            UPDATE pinjam SET 
                kendaraan_nomer=:kendaraan_nomer,
                user_id=:user_id,
                tgl_pinjam=:tgl_pinjam,
                tgl_kembali=:tgl_kembali,
                pinjam_status=:pinjam_status
            WHERE pinjam_id=:pinjam_id
        ");
        $stmt->execute([
            ':kendaraan_nomer' => $kendaraan_nomer,
            ':user_id' => $user_id,
            ':tgl_pinjam' => $tgl_pinjam,
            ':tgl_kembali' => $tgl_kembali,
            ':pinjam_status' => $pinjam_status,
            ':pinjam_id' => $pinjam_id
        ]);

        // Update status kendaraan lama
        if($old['pinjam_status'] == 'dipinjam' && $old['kendaraan_nomer'] != $kendaraan_nomer){
            // Kendaraan lama jadi tersedia
            $pdo->prepare("UPDATE kendaraan SET kendaraan_status='tersedia' WHERE kendaraan_nomer=:nomer")
                ->execute([':nomer' => $old['kendaraan_nomer']]);
        }

        // Update kendaraan baru sesuai status pinjam
        $status_kendaraan_baru = ($pinjam_status == 'dipinjam') ? 'disewa' : 'tersedia';
        $pdo->prepare("UPDATE kendaraan SET kendaraan_status=:status WHERE kendaraan_nomer=:nomer")
            ->execute([':status' => $status_kendaraan_baru, ':nomer' => $kendaraan_nomer]);

        $pdo->commit();

        header("Location: pinjam.php?success=1");
        exit;

    } catch(PDOException $e){
        $pdo->rollBack();
        echo "Error: ".$e->getMessage();
    }

} else {
    header("Location: pinjam.php");
    exit;
}
