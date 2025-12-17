<?php
include '../config/koneksi.php';

$id    = $_POST['id'];
$nama  = $_POST['nama'];
$type  = $_POST['type'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$status = $_POST['status'];


$gambar_lama = $_POST['gambar_lama'];

if (!empty($_FILES['gambar']['name'])) {

    $folder = "uploads/";
    $nama_file = time() . '_' . $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], $folder.$nama_file);

    // hapus gambar lama
    if (file_exists("../".$gambar_lama)) {
        unlink("../".$gambar_lama);
    }

    $gambar = "uploads/".$nama_file;

    $stmt = $pdo->prepare("
        UPDATE kendaraan SET
        kendaraan_nama=?,
        kendaraan_type=?,
        kendaraan_harga_perhari=?,
        kendaraan_deskripsi=?,
        kendaraan_status=?
    ");

    $stmt->execute([$nama, $type, $harga, $deskripsi, $gambar, $status, $id]);

} else {

    $stmt = $pdo->prepare("
        UPDATE kendaraan SET
        kendaraan_nama=?,
        kendaraan_type=?,
        kendaraan_harga_perhari=?,
        kendaraan_deskripsi=?,
        kendaraan_status=?
        WHERE kendaraan_nomer=?
    ");

    $stmt->execute([$nama, $type, $harga, $deskripsi, $status, $id]);
}

header("Location: kendaraan.php");
