<?php
include 'config/koneksi.php';

$nama     = $_POST['user_nama'];
$username = $_POST['username'];
$alamat   = $_POST['user_alamat'];
$phone    = $_POST['user_phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
    INSERT INTO user
    (user_nama, username, user_alamat, user_phone, password)
    VALUES (?,?,?,?,?)
");

$stmt->execute([
    $nama,
    $username,
    $alamat,
    $phone,
    $password
]);

header("Location: user.php");
