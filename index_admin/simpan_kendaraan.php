<?php
include '../config/koneksi.php';

$nama   = $_POST['nama'];
$kendaraan_nomor = $_POST['nopol'];
$type   = $_POST['type'];
$harga  = $_POST['harga'];
$status = $_POST['status'];
$deskripsi = $_POST['deskripsi'];


$folder = "uploads/";
$nama_file = time() . '_' . $_FILES['gambar']['name'];
move_uploaded_file($_FILES['gambar']['tmp_name'], $folder.$nama_file);

$gambar = "uploads/".$nama_file;

$stmt = $pdo->prepare("
    INSERT INTO kendaraan 
    (kendaraan_nomer, kendaraan_nama, kendaraan_type, kendaraan_harga_perhari, kendaraan_status, kendaraan_deskripsi, kendaraan_img)
    VALUES (?,?,?,?,?,?,?)
");

$stmt->execute([
    $kendaraan_nomor,
    $nama,
    $type,
    $harga,
    $status,
    $deskripsi,
    $gambar
]);

header("Location: kendaraan.php");
