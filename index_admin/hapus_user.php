<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM user WHERE user_id=?");
$stmt->execute([$id]);

header("Location: user.php");
