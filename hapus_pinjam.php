<?php
include 'config/koneksi.php';

if(!isset($_GET['id'])){
    header("Location: pinjam.php");
    exit;
}

$pinjam_id = $_GET['id'];

try {
    $pdo->beginTransaction();

    // Ambil data pinjaman
    $stmt = $pdo->prepare("SELECT kendaraan_nomer, pinjam_status FROM pinjam WHERE pinjam_id=:id");
    $stmt->execute([':id' => $pinjam_id]);
    $pinjam = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$pinjam){
        throw new Exception("Data pinjaman tidak ditemukan.");
    }

    // Hapus pinjaman
    $delete = $pdo->prepare("DELETE FROM pinjam WHERE pinjam_id=:id");
    $delete->execute([':id' => $pinjam_id]);

    // Update status kendaraan jadi tersedia kalau sebelumnya dipinjam
    if($pinjam['pinjam_status'] == 'dipinjam'){
        $update = $pdo->prepare("UPDATE kendaraan SET kendaraan_status='tersedia' WHERE kendaraan_nomer=:nomer");
        $update->execute([':nomer' => $pinjam['kendaraan_nomer']]);
    }

    $pdo->commit();

    header("Location: pinjam.php?deleted=1");
    exit;

} catch(Exception $e){
    $pdo->rollBack();
    // Bisa juga pakai modal Bootstrap seperti di kendaraan
    echo "<script>alert('Gagal menghapus: ".$e->getMessage()."'); window.location='pinjam.php';</script>";
    exit;
}
