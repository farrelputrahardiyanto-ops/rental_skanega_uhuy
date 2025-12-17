<?php
include '../config/koneksi.php';

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM kendaraan WHERE kendaraan_nomer=?");
    $stmt->execute([$id]);

    header("Location: kendaraan.php?status=deleted");
} catch (PDOException $e) {
    // gagal karena masih dipinjam
    header("Location: kendaraan.php?status=error");
}
