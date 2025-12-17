<?php
include '../config/koneksi.php';

$id       = $_POST['user_id'];
$nama     = $_POST['user_nama'];
$username = $_POST['username'];
$alamat   = $_POST['user_alamat'];
$phone    = $_POST['user_phone'];
$password = $_POST['password'];

if (!empty($password)) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("
        UPDATE user SET
        user_nama=?,
        username=?,
        user_alamat=?,
        user_phone=?,
        password=?
        WHERE user_id=?
    ");
    $stmt->execute([$nama,$username,$alamat,$phone,$hash,$id]);
} else {
    $stmt = $pdo->prepare("
        UPDATE user SET
        user_nama=?,
        username=?,
        user_alamat=?,
        user_phone=?
        WHERE user_id=?
    ");
    $stmt->execute([$nama,$username,$alamat,$phone,$id]);
}

header("Location: user.php");
