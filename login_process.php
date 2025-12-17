<?php
session_start();
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php"); 
    exit;
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Ambil admin
$stmt = $pdo->prepare("SELECT id, username, email, password FROM admin WHERE email=?");
$stmt->execute([$email]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin && $password === $admin['password']) {
    $_SESSION['admin_id']  = $admin['id'];
    $_SESSION['username']  = $admin['username'];
    $_SESSION['email']     = $admin['email'];
    $_SESSION['role']      = 'admin';
    
   header("Location: index_admin/index.php");
   exit;
} else {
    echo "<script>
            alert('Email atau password salah!');
            window.location.href='login.php';
          </script>";
}
?>
